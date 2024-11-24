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
        <a href="index.php">
            <i class="fa-solid fa-book" id="brand-icon" style="display: inline;"></i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto"></ul>
            <div class="navbar-right">
                <a href="carrinho.php" class="me-3">
                    <img src="img/navbar/caixa.png" alt="Carrinho de compras" style="width:25px;height:25px;">
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
											
											<li><a class="dropdown-item" href="carrinho.php">Meu Perfil</a></li>
											<li><a class="dropdown-item" href="logout.php">Sair</a></li>
                                    </li>

                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="cadastro.html">Cadastro</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="upload.html">Venda Conosco</a></li>
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

        <nav class="navbar navbar-expand-lg navbar-dark bg-gray">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#newNavbar" aria-controls="newNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="newNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="categorias/infantil.html">Infantil</a></li>
                    <li class="nav-item"><a class="nav-link" href="categorias/romance.html">Romances</a></li>
                    <li class="nav-item"><a class="nav-link" href="categorias/hq_mangas.html">HQs & Mangás</a></li>
                    <li class="nav-item"><a class="nav-link" href="categorias/fantasia.html">Fantasia</a></li>
                    <li class="nav-item"><a class="nav-link" href="categorias/horror.html">Horror</a></li>
                </ul>
            </div>
        </nav>            
    </header>

    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/crl/mauricio.jpg" class="d-block w-100" alt="Mauricio de Souza">
            </div>
            <div class="carousel-item">
                <img src="img/crl/clarisse.jpg" class="d-block w-100" alt="Clarisse">
            </div>
            <div class="carousel-item">
                <img src="img/crl/machado.jpg" class="d-block w-100" alt="Machado de Assis">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container my-4">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <div class="col">
                <fieldset class="fieldset-container">
                    <img src="img/livros/harry_capa.jpg" alt="Harry Potter">
                    <div class="item">Harry Potter</div>
                    <div class="price">R$ 99,90</div>
                    <form action="comprar.php" method="post">
                        <input type="hidden" name="nome_item" value="Harry Potter">
						<input type="hidden" name="preco_item" value="99.90">
                        <button type="submit" class="btn btn-comprar">Comprar</button>
                    </form>
                </fieldset>
            </div>
            <div class="col">
                <fieldset class="fieldset-container">
                    <img src="img/livros/iracema_capa.jpg" alt="Iracema">
                    <div class="item">Iracema</div>
                    <div class="price">R$ 99,90</div>
                    <form action="comprar.php" method="post">
                        <input type="hidden" name="nome_item" value="Iracema">
						<input type="hidden" name="preco_item" value="99,90">
                        <button type="submit" class="btn btn-comprar">Comprar</button>
                    </form>
                </fieldset>
            </div>
            <div class="col">
                <fieldset class="fieldset-container">
                    <img src="img/livros/senhor_capa.jpg" alt="Senhor dos Aneis">
                    <div class="item">Senhor dos Aneis</div>
                    <div class="price">R$ 99,90</div>
                    <form action="comprar.php" method="post">
                        <input type="hidden" name="nome_item" value="Senhor dos Aneis">
						<input type="hidden" name="preco_item" value="99,90">
                        <button type="submit" class="btn btn-comprar">Comprar</button>
                    </form>
                </fieldset>
            </div>
            <div class="col">
                <fieldset class="fieldset-container">
                    <img src="img/livros/hora_capa.jpg" alt="Hora da Estrela">
                    <div class="item">Hora da Estrela</div>
                    <div class="price">R$ 99,90</div>
                    <form action="comprar.php" method="post">
                        <input type="hidden" name="nome_item" value="Hora da Estrela">
						<input type="hidden" name="preco_item" value="99,90">
                        <button type="submit" class="btn btn-comprar">Comprar</button>
                    </form>
                </fieldset>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <div class="col">
                <fieldset class="fieldset-container">
                    <img src="img/livros/1984_capa.jpg" alt="1984">
                    <div class="item">1984</div>
                    <div class="price">R$ 99,90</div>
                    <form action="comprar.php" method="post">
                        <input type="hidden" name="nome_item" value="1984">
						<input type="hidden" name="preco_item" value="99,90">
                        <button type="submit" class="btn btn-comprar">Comprar</button>
                    </form>
                </fieldset>
            </div>
            <div class="col">
                <fieldset class="fieldset-container">
                    <img src="img/livros/banquete.jpg" alt="O Banquete">
                    <div class="item">O Banquete</div>
                    <div class="price">R$ 99,90</div>
                    <form action="comprar.php" method="post">
                        <input type="hidden" name="nome_item" value="O Banquete">
						<input type="hidden" name="preco_item" value="99,90">
                        <button type="submit" class="btn btn-comprar">Comprar</button>
                    </form>
                </fieldset>
            </div>
            <div class="col">
                <fieldset class="fieldset-container">
                    <img src="img/livros/odisseia.jpg" alt="Odisseia">
                    <div class="item">Odisseia</div>
                    <div class="price">R$ 99,90</div>
                    <form action="comprar.php" method="post">
                        <input type="hidden" name="nome_item" value="Odisseia">
						<input type="hidden" name="preco_item" value="99,90">
                        <button type="submit" class="btn btn-comprar">Comprar</button>
                    </form>
                </fieldset>
            </div>
            <div class="col">
                <fieldset class="fieldset-container">
                    <img src="img/livros/kafka_capa.jpg" alt="Kafka O Processo">
                    <div class="item">Kafka O Processo</div>
                    <div class="price">R$ 99,90</div>
                    <form action="comprar.php" method="post">
                        <input type="hidden" name="nome_item" value="Kafka O Processo">
						<input type="hidden" name="preco_item" value="99,90">
                        <button type="submit" class="btn btn-comprar">Comprar</button>
                    </form>
                </fieldset>
            </div>
			
		<?php
		$host = 'localhost';
		$dbname = 'nextage';
		$username = 'root';
		$password = '';

		try {
			// Conexão com o banco de dados
			$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// Buscar livros no banco de dados
			$query = "SELECT * FROM livros";
			$stmt = $pdo->query($query);

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				echo '<div class="col">';
				echo '<fieldset class="fieldset-container">';
				echo '<img src="' . htmlspecialchars($row['imagem']) . '" alt="' . htmlspecialchars($row['titulo']) . '" class="img-fluid">'; // Adicionando img-fluid
				echo '<div class="item">' . htmlspecialchars($row['titulo']) . '</div>';
				echo '<div class="price">R$ ' . number_format($row['preco'], 2, ',', '.') . '</div>';
				echo '<form action="comprar.php" method="post">';
				echo '<input type="hidden" name="nome_item" value="' . htmlspecialchars($row['titulo']) . '">';
				echo '<input type="hidden" name="preco_item" value="' . number_format($row['preco'], 2, ',', '.') . '">';
				echo '<button type="submit" class="btn btn-comprar">Comprar</button>';
				echo '</form>';
				echo '</fieldset>';
				echo '</div>';
			}
		} catch (PDOException $e) {
			echo "Erro: " . $e->getMessage();
		}
		?>
		
		
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="index.js"></script> <!-- Link para o JavaScript -->
</body>
</html>