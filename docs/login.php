<?php
session_start(); // Inicia a sessão

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
    $senha = $_POST['senha'];

    // Prepara e executa a consulta
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        // Verifica se o usuário foi encontrado
        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            
            // Verifica a senha
            if (password_verify($senha, $usuario['senha'])) {
                // Senha correta, inicia a sessão e armazena informações do usuário
                $_SESSION['user_email'] = $usuario['email']; // Armazena o e-mail do usuário

                // Nova consulta para obter o nome e o id_usuario usando o e-mail
                $stmt_nome = $conn->prepare("SELECT nome, id_usuario FROM usuarios WHERE email = ?");
                $stmt_nome->bind_param("s", $email); // Usa o e-mail do usuário encontrado
                $stmt_nome->execute();
                $result_nome = $stmt_nome->get_result();

                if ($result_nome->num_rows > 0) {
                    $usuario_detalhes = $result_nome->fetch_assoc();
                    $_SESSION['user_nome'] = $usuario_detalhes['nome']; // Armazena o nome do usuário
                    $_SESSION['user_id'] = $usuario_detalhes['id_usuario']; // Armazena o id_usuario
                }

                header("Location: index.php"); // Redireciona para a página inicial
                exit();
            } else {
                echo "<script>alert('Email ou senha inválidos.');</script>";
            }
        } else {
            echo "<script>alert('Email ou senha inválidos.');</script>";
        }
    } else {
        die("Erro na execução da consulta: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>