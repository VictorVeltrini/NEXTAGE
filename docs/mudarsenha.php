<?php
session_start();

// Conexão com o banco de dados
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "nextage"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $nova_senha = $_POST['nova_senha'];

    // Verifica se o e-mail existe na tabela de usuários
    $stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // O e-mail foi encontrado, agora atualiza a senha
        $hashed_password = password_hash($nova_senha, PASSWORD_DEFAULT); // Hash da nova senha

        $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashed_password, $email);
        
        if ($stmt->execute()) {
            echo "<script>alert('Senha redefinida com sucesso!'); window.location.href='login.html';</script>";
        } else {
            echo "<script>alert('Erro ao redefinir a senha.');</script>";
        }
    } else {
        echo "<script>alert('E-mail não encontrado.');</script>";
    }

    $stmt->close();
}

$conn->close();
?>