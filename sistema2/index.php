<?php
include './backend/conexao.php';

$mercados = mysqli_query($conexao, "SELECT * FROM mercado ORDER BY nome");
$produtos = mysqli_query($conexao, "SELECT produto.*, mercado.nome AS mercado_nome FROM produto INNER JOIN mercado ON mercado.id = produto.mercado_id ORDER BY produto.nome");

function fotoOuPadrao($foto)
{
    if (!empty($foto) && file_exists($foto)) {
        return $foto;
    }

    return 'imagem/1779909443_346b3f2a__imagem2.png';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecolote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<nav class="navbar navbar-expand-lg fundoazul">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Ecolote</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link active" href="#mercados">Mercados</a></li>
        <li class="nav-item"><a class="nav-link active" href="#produtos">Produtos</a></li>
      </ul>
      <a href="./login.php" class="btn btn-outline-dark">Login</a>
    </div>
  </div>
</nav>

<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="imagem/1779909443_346b3f2a__imagem2.png" class="d-block w-100 banner-img" alt="Produtos com desconto">
    </div>
    <div class="carousel-item">
      <img src="imagem/1779909435_197d16b4__imagem1.png" class="d-block w-100 banner-img" alt="Economia no mercado">
    </div>
    <div class="carousel-item">
      <img src="imagem/1779910131_b7d13cfb__imagem3.png" class="d-block w-100 banner-img" alt="Compras conscientes">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Proximo</span>
  </button>
</div>

<section class="intro">
  <div class="container">
    <h1>Bem-vindos ao Ecolote</h1>
    <p>Encontre mercados parceiros, veja produtos com preco acessivel e fale direto com o estabelecimento.</p>
  </div>
</section>

<main class="container py-5">
  <section id="mercados">
    <div class="titulo-secao">
      <h2>Mercados</h2>
      <p>Clique em um mercado para ver os produtos disponiveis.</p>
    </div>


   <!-- Linha do Bootstrap para organizar os cards em grade -->
<div class="row g-4">

  <?php 
    // Laço que percorre todos os mercados vindos do banco de dados
    while($mercado = mysqli_fetch_assoc($mercados)){ 
  ?>

    <!-- Coluna responsiva:
         col-12 = ocupa 100% no celular
         col-sm-6 = ocupa metade da tela em telas pequenas
         col-lg-4 = ocupa 1/3 da tela em telas grandes -->
    <div class="col-12 col-sm-6 col-lg-4">

      <a class="card-link" href="mercado_detalhe.php?id=<?= $mercado['id'] ?>">

        <!-- Card do mercado.
             h-100 faz todos os cards terem a mesma altura -->
        <div class="card card-vitrine h-100">
          <img 
            src="<?= fotoOuPadrao($mercado['foto']) ?>" 
            class="card-img-top" 
            alt="<?= $mercado['nome'] ?>"
          >

          <!-- Corpo do card, onde ficam as informações -->
          <div class="card-body">

            <!-- Nome do mercado -->
            <h3 class="card-title h5">
              <?= $mercado['nome'] ?>
            </h3>

            <!-- Endereço do mercado -->
            <p class="card-text">
              <?= $mercado['endereco'] ?>
            </p>

            <!-- Botão visual para acessar os produtos -->
            <span class="btn btn-success w-100">
              Ver produtos
            </span>

          </div>
        </div>
      </a>
    </div>

  <?php 
    // Fim do laço while
    } 
  ?>

</div>
</section>



  <section id="produtos" class="mt-5">
    <div class="titulo-secao">
      <h2>Produtos</h2>
      <p>Veja todos os produtos cadastrados nos mercados.</p>
    </div>

    <div class="swiper produtos-swiper">
      <div class="swiper-wrapper">
        <?php while($produto = mysqli_fetch_assoc($produtos)){ ?>
          <div class="swiper-slide">
            <div class="card card-vitrine h-100">
              <img src="<?=fotoOuPadrao($produto['imagem'])?>" class="card-img-top" alt="<?=$produto['nome']?>">
              <div class="card-body">
                <h3 class="card-title h5"><?=$produto['nome']?></h3>
                <p class="card-text mb-1"><?=$produto['mercado_nome']?></p>
                <strong>R$ <?=number_format($produto['preco'], 2, ',', '.')?></strong>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
  </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  new Swiper('.produtos-swiper', {
    slidesPerView: 1,
    spaceBetween: 18,
    pagination: {
      el: '.swiper-pagination',
      clickable: true
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    },
    breakpoints: {
      576: { slidesPerView: 2 },
      992: { slidesPerView: 3 }
    }
  });
</script>
</body>
</html>
