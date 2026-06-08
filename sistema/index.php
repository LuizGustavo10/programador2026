<?php
include './backend/conexao.php';

mysqli_query($conexao, "INSERT INTO site_visita(pagina) VALUES ('index')");

$mercados = mysqli_query($conexao, "SELECT * FROM mercado ORDER BY nome");
$totalMercados = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(*) AS total FROM mercado"))['total'];
$totalProdutos = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(*) AS total FROM produto WHERE disponibilidade='ativo'"))['total'];
$totalVisitas = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(*) AS total FROM site_visita WHERE pagina='index'"))['total'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecolote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<nav class="navbar navbar-expand-lg fundoazul shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="./index.php">Ecolote</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link active" href="#mercados">Mercados</a></li>
        <li class="nav-item"><a class="nav-link active" href="#sobre">Sobre</a></li>
      </ul>
      <a href="./login.php" class="btn btn-outline-dark me-2">Admin</a>
      <a href="./login_mercado.php" class="btn btn-dark">Mercado</a>
    </div>
  </div>
</nav>

<div id="carouselExample" class="carousel slide public-carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="imagem/1779909443_346b3f2a__imagem2.png" class="d-block w-100" alt="Produtos em promocao">
    </div>
    <div class="carousel-item">
      <img src="imagem/1779909435_197d16b4__imagem1.png" class="d-block w-100" alt="Economia no mercado">
    </div>
    <div class="carousel-item">
      <img src="imagem/1779910131_b7d13cfb__imagem3.png" class="d-block w-100" alt="Consumo consciente">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<section id="sobre" class="public-intro">
  <div class="container">
    <h1>Bem-vindos ao Ecolote</h1>
    <p>Encontre mercados e produtos com precos acessiveis, economize dinheiro e ajude a evitar desperdicio.</p>
    <div class="social-proof">
      <div><strong><?php echo $totalMercados ?></strong><span>mercados cadastrados</span></div>
      <div><strong><?php echo $totalProdutos ?></strong><span>produtos ativos</span></div>
      <div><strong><?php echo $totalVisitas ?></strong><span>visualizacoes na pagina</span></div>
    </div>
  </div>
</section>

<main id="mercados" class="container py-5">
  <div class="d-flex align-items-end justify-content-between gap-3 flex-wrap mb-4">
    <div>
      <h2 class="mb-1">Mercados participantes</h2>
      <p class="text-muted mb-0">Escolha um mercado para ver produtos, receitas e contato direto.</p>
    </div>
  </div>
  <div class="row g-4">
    <?php while($mercado = mysqli_fetch_assoc($mercados)){ ?>
      <div class="col-12 col-sm-6 col-lg-3">
        <article class="public-card h-100">
          <img src="<?php echo !empty($mercado['foto']) ? $mercado['foto'] : 'imagem/mercadinho2.png'; ?>" alt="<?php echo $mercado['nome']; ?>">
          <div class="public-card-body">
            <h3><?php echo $mercado['nome']; ?></h3>
            <p><?php echo $mercado['endereco']; ?></p>
            <span><?php echo $mercado['telefone']; ?></span>
            <a href="mercado_detalhe.php?id=<?=$mercado['id'] ?>" class="btn btn-primary w-100 mt-3">Ver produtos</a>
          </div>
        </article>
      </div>
    <?php } ?>
  </div>
</main>

<footer class="public-footer">
  <div class="container d-flex justify-content-between gap-3 flex-wrap">
    <strong>Ecolote</strong>
    <span>Economia local com menos desperdicio.</span>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
