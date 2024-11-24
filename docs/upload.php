<?php
// Configuração do banco de dados
$host = 'localhost';
$dbname = 'nextage';
$username = 'root';
$password = '';

try {
    // Conexão com o banco usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Processar o envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['book-title'];
    $autor = $_POST['book-author'];
    $data_lancamento = $_POST['release-date'];
    $preco = $_POST['price'];
    $descricao = $_POST['book-description'];
    $imagem = $_FILES['book-image'];

    // Verificar se o upload da imagem foi bem-sucedido
    if ($imagem['error'] === UPLOAD_ERR_OK) {
        // Gerar um nome único para o arquivo
        $nomeImagem = uniqid() . '-' . basename($imagem['name']);
        $caminhoDestino = 'img/livros/' . $nomeImagem;

        // Mover a imagem para o diretório desejado
        if (move_uploaded_file($imagem['tmp_name'], $caminhoDestino)) {
            // Inserir os dados no banco
            $sql = "INSERT INTO livros (titulo, autor, data_lancamento, preco, descricao, imagem) 
                    VALUES (:titulo, :autor, :data_lancamento, :preco, :descricao, :imagem)";
            $stmt = $pdo->prepare($sql);

            try {
                $stmt->execute([
                    ':titulo' => $titulo,
                    ':autor' => $autor,
                    ':data_lancamento' => $data_lancamento,
                    ':preco' => $preco,
                    ':descricao' => $descricao,
                    ':imagem' => $caminhoDestino
                ]);

                // Redirecionar de volta para o formulário com mensagem de sucesso
                header("Location: upload.html?mensagem=sucesso");
                exit();
            } catch (PDOException $e) {
                echo "<p>Erro ao salvar no banco de dados: " . $e->getMessage() . "</p>";
            }
        } else {
            echo "<p>Erro ao fazer upload da imagem.</p>";
        }
    } else {
        echo "<p>Erro ao enviar o arquivo.</p>";
    }
}
?>
