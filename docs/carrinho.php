<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Nextage Livros</title>
    <link rel="stylesheet" href="index.css">
</head>
<body class="light-theme">
 <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <a class="navbar-brand logo" href="index.php" id="brand-title">Nextage</a>
        <a href="index.html">
            <i class="fa-solid fa-book" id="brand-icon" style="display: inline;"></i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto"></ul>
            <div class="navbar-right">
                <a href="carrinho.php" class="me-3">
                    <img src="img/navbar/carrinho.png" alt="Carrinho de compras" style="width:25px;height:25px;">
                </a>
                <div class="collapse navbar-collapse" id="navbarNavi">
                    <ul class="navbar-nav me-auto">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">
                                    <i class="fa-solid fa-user" style="font-size: 20px;"></i> <!-- Ícone de usuário -->
                                    Olá, <?php echo htmlspecialchars($_SESSION['user_nome']); ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item">
                                        <strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user_email']); ?>
                                    </li>
                                    <li><a class="dropdown-item" href="carrinho.php">Meu Perfil</a></li>
                                    <li><a class="dropdown-item" href="logout.php">Sair</a></li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="cadastro.html">Cadastro</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="upload.php">Venda Conosco</a></li>
                    </ul>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">
                            <i class="bi bi-brightness-high"></i> Claro
                        </a>
                        <ul class="dropdown-menu themes-list">
                            <li><a class="dropdown-item" href="#" data-theme="light">Claro</a></li>
                            <li><a class="dropdown-item" href="#" data-theme="dark">Escuro</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    </header>

 <?php


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
    echo "<script>alert('Você precisa estar logado para ver suas compras.'); window.location.href = 'login.html';</script>";
    exit();
}

// Fetch purchased books for the logged-in user
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT c.titulo, c.preco, l.id AS id_livro FROM compras c JOIN livros l ON c.id_livro = l.id WHERE c.id_usuario = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Minhas Compras</title>
</head>
<body>
    <div class="container my-4">
        <h1>Livros Comprados</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                            <td>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></td>
                            <td>
                                <form action="cancelar.php" method="post" style="display:inline;">
                                    <input type="hidden" name="id_compra" value="<?php echo $row['id_livro']; ?>">
                                    <button type="submit" name="cancelar" class="btn btn-danger">Cancelar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">Nenhuma compra encontrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
</body>
</html>