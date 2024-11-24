<?php
session_start(); // Inicia a sessão

$host = 'localhost';
$dbname = 'nextage';
$username = 'root';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dados enviados pelo formulário
    $titulo = $_POST['nome_item'];
    $preco = $_POST['preco_item'];

    // Verifica se o usuário está logado
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Você precisa estar logado para realizar uma compra.'); window.location.href = 'login.html';</script>";
        exit();
    }

    // Obtém o ID do usuário da sessão
    $usuario_id = $_SESSION['user_id'];

    try {
        // Conexão com o banco de dados
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Busca o id_livro com base no título
        $query_livro = "SELECT id FROM livros WHERE titulo = :titulo";
        $stmt_livro = $pdo->prepare($query_livro);
        $stmt_livro->bindParam(':titulo', $titulo);
        $stmt_livro->execute();

        // Verifica se o livro foi encontrado
        if ($stmt_livro->rowCount() > 0) {
            $livro = $stmt_livro->fetch(PDO::FETCH_ASSOC);
            $id_livro = $livro['id']; // Obtém o id_livro

            // Inserir a compra na tabela `compras`
            $query = "INSERT INTO compras (titulo, preco, id_usuario, id_livro) VALUES (:titulo, :preco, :usuario_id, :id_livro)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->bindParam(':id_livro', $id_livro); // Adiciona o id_livro
            $stmt->execute();

            // Mensagem de sucesso
            echo "<script>alert('Livro comprado com sucesso!'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Livro não encontrado.'); window.location.href = 'index.php';</script>";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Método de requisição inválido.";
}
?>