<?php
session_start(); // Start the session

// Database connection parameters
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "nextage"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Você precisa estar logado para cancelar uma compra.'); window.location.href = 'login.php';</script>";
    exit();
}

// Check if the cancel request was made
if (isset($_POST['cancelar'])) {
    $id_compra = $_POST['id_compra'];

    // Prepare and execute the delete statement
    $stmt = $conn->prepare("DELETE FROM compras WHERE id_livro = ? AND id_usuario = ?");
    $stmt->bind_param("ii", $id_compra, $_SESSION['user_id']);
    
    if ($stmt->execute()) {
        echo "<script>alert('Compra cancelada com sucesso!'); window.location.href = 'index.php';</script>";
    } else {
        echo "Erro ao cancelar a compra: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>