<?php
include './backend/conexao.php';

mysqli_query($conexao, "INSERT INTO site_visita(pagina) VALUES ('index')");

$mercados = mysqli_query($conexao, "SELECT * FROM mercado ORDER BY nome");
$mercadosSwiper = mysqli_query($conexao, "SELECT * FROM mercado ORDER BY RAND() LIMIT 10");
$produtosMercados = mysqli_query($conexao, "SELECT produto.*, mercado.nome AS mercado_nome FROM produto INNER JOIN mercado ON mercado.id = produto.mercado_id WHERE produto.disponibilidade='ativo' ORDER BY mercado.nome, produto.nome");
$receitasDisponiveis = mysqli_query($conexao, "SELECT * FROM receita ORDER BY RAND() LIMIT 10");
$totalMercados = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(*) AS total FROM mercado"))['total'];
$totalProdutos = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(*) AS total FROM produto WHERE disponibilidade='ativo'"))['total'];
$totalVisitas = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(*) AS total FROM site_visita WHERE pagina='index'"))['total'];

function textoSeguro($texto)
{
  return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <li class="nav-item"><a class="nav-link active" href="#produtos">Produtos</a></li>
        <li class="nav-item"><a class="nav-link active" href="#receitas">Receitas</a></li>
        <li class="nav-item"><a class="nav-link active" href="./sobre.php">Sobre</a></li>
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
    <p>Encontre mercados e produtos com preços acessíveis, economize dinheiro e ajude a evitar desperdício.</p>
    <div class="social-proof">
      <div><strong><?php echo $totalMercados ?></strong><span>mercados cadastrados</span></div>
      <div><strong><?php echo $totalProdutos ?></strong><span>produtos ativos</span></div>
      <div><strong><?php echo $totalVisitas ?></strong><span>visualizações na página</span></div>
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
          <img src="<?php echo !empty($mercado['foto']) ? $mercado['foto'] : 'imagem/mercadinho2.png'; ?>" alt="<?php echo textoSeguro($mercado['nome']); ?>">
          <div class="public-card-body">
            <h3><?php echo textoSeguro($mercado['nome']); ?></h3>
            <p><?php echo textoSeguro($mercado['endereco']); ?></p>
            <span><?php echo textoSeguro($mercado['telefone']); ?></span>
            <a href="mercado_detalhe.php?id=<?=$mercado['id'] ?>" class="btn btn-primary w-100 mt-3">Ver produtos</a>
          </div>
        </article>
      </div>
    <?php } ?>
  </div>
</main>

<section id="produtos" class="public-section public-section-light">
  <div class="container">
    <div class="section-heading">
      <span>Ofertas em movimento</span>
      <h2>Produtos dos mercados</h2>
      <p>Uma vitrine rápida para descobrir todos os itens ativos dos mercados participantes.</p>
    </div>
    <div class="swiper product-swiper">
      <div class="swiper-wrapper">
        <?php if(mysqli_num_rows($produtosMercados) == 0){ ?>
          <div class="swiper-slide">
            <article class="empty-slide">Nenhum produto ativo cadastrado ainda.</article>
          </div>
        <?php } ?>
        <?php while($produto = mysqli_fetch_assoc($produtosMercados)){ ?>
          <div class="swiper-slide">
            <article class="product-card slider-card h-100">
              <img src="<?php echo !empty($produto['imagem']) ? $produto['imagem'] : 'imagem/mercadinho2.png'; ?>" alt="<?php echo textoSeguro($produto['nome']); ?>">
              <div class="product-card-body">
                <span class="market-pill"><?php echo textoSeguro($produto['mercado_nome']); ?></span>
                <h3><?php echo textoSeguro($produto['nome']); ?></h3>
                <strong>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></strong>
              </div>
            </article>
          </div>
        <?php } ?>
      </div>
      <div class="swiper-pagination product-pagination"></div>
    </div>
  </div>
</section>

<section id="receitas" class="public-section">
  <div class="container">
    <div class="section-heading">
      <span>Cozinha sem desperdício</span>
      <h2>Receitas disponíveis</h2>
      <p>Ideias cadastradas para transformar produtos em refeições simples e econômicas.</p>
    </div>
    <div class="swiper recipe-swiper">
      <div class="swiper-wrapper">
        <?php if(mysqli_num_rows($receitasDisponiveis) == 0){ ?>
          <div class="swiper-slide">
            <article class="empty-slide">Nenhuma receita cadastrada ainda.</article>
          </div>
        <?php } ?>
        <?php while($receita = mysqli_fetch_assoc($receitasDisponiveis)){ ?>
          <div class="swiper-slide">
            <a class="recipe-card h-100" href="receita_detalhe.php?id=<?php echo $receita['id']; ?>">
              <img src="<?php echo !empty($receita['foto']) ? $receita['foto'] : 'imagem/mercadinho2.png'; ?>" alt="<?php echo textoSeguro($receita['nome']); ?>">
              <div>
                <h3><?php echo textoSeguro($receita['nome']); ?></h3>
                <span>Ver receita completa</span>
              </div>
            </a>
          </div>
        <?php } ?>
      </div>
      <div class="swiper-pagination recipe-pagination"></div>
    </div>
  </div>
</section>

<section class="public-section public-section-light market-coverflow-section">
  <div class="container">
    <div class="section-heading">
      <span>Quem já faz parte?</span>
      <h2>Fotos dos mercados participantes</h2>
      <p>Passe pelos mercados cadastrados em formato coverflow.</p>
    </div>
    <div class="swiper market-coverflow">
      <div class="swiper-wrapper">
        <?php if(mysqli_num_rows($mercadosSwiper) == 0){ ?>
          <div class="swiper-slide">
            <article class="empty-slide">Nenhum mercado cadastrado ainda.</article>
          </div>
        <?php } ?>
        <?php while($mercadoSlide = mysqli_fetch_assoc($mercadosSwiper)){ ?>
          <div class="swiper-slide">
            <a class="market-photo-slide" href="mercado_detalhe.php?id=<?php echo $mercadoSlide['id']; ?>">
              <img src="<?php echo !empty($mercadoSlide['foto']) ? $mercadoSlide['foto'] : 'imagem/mercadinho2.png'; ?>" alt="<?php echo textoSeguro($mercadoSlide['nome']); ?>">
              <strong><?php echo textoSeguro($mercadoSlide['nome']); ?></strong>
            </a>
          </div>
        <?php } ?>
      </div>
      <div class="swiper-button-prev market-prev"></div>
      <div class="swiper-button-next market-next"></div>
      <div class="swiper-pagination market-pagination"></div>
    </div>
  </div>
</section>

<section class="faq-section">
  <div class="container">
    <div class="section-heading">
      <span>Dúvidas comuns</span>
      <h2>Perguntas frequentes</h2>
    </div>
    <div class="accordion" id="faqEcolote">
      <div class="accordion-item">
        <h3 class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqUm" aria-expanded="true" aria-controls="faqUm">
            Como vejo os produtos de um mercado?
          </button>
        </h3>
        <div id="faqUm" class="accordion-collapse collapse show" data-bs-parent="#faqEcolote">
          <div class="accordion-body">Clique em "Ver produtos" no card do mercado participante para abrir a página com itens, contato e mapa.</div>
        </div>
      </div>
      <div class="accordion-item">
        <h3 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqDois" aria-expanded="false" aria-controls="faqDois">
            Posso perguntar se um produto ainda está disponível?
          </button>
        </h3>
        <div id="faqDois" class="accordion-collapse collapse" data-bs-parent="#faqEcolote">
          <div class="accordion-body">Sim. Na página do mercado, cada produto tem um botão que abre o WhatsApp com uma mensagem pronta.</div>
        </div>
      </div>
      <div class="accordion-item">
        <h3 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqTres" aria-expanded="false" aria-controls="faqTres">
            De onde vem as receitas?
          </button>
        </h3>
        <div id="faqTres" class="accordion-collapse collapse" data-bs-parent="#faqEcolote">
          <div class="accordion-body">As receitas são cadastradas no painel administrativo e podem ser vinculadas aos produtos.</div>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="public-footer">
  <div class="container d-flex align-items-center justify-content-between gap-3 flex-wrap">
    <div>
      <strong>Ecolote</strong>
      <span>Economia local com menos desperdício.</span>
    </div>
    <div class="footer-social">
      <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
      <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
      <a href="#" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
      <a href="#" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  new Swiper('.product-swiper', {
    loop: true,
    spaceBetween: 22,
    pagination: { el: '.product-pagination', clickable: true },
    breakpoints: {
      0: { slidesPerView: 1.1 },
      576: { slidesPerView: 2 },
      992: { slidesPerView: 3 },
      1200: { slidesPerView: 4 }
    }
  });

  new Swiper('.recipe-swiper', {
    loop: true,
    spaceBetween: 22,
    pagination: { el: '.recipe-pagination', clickable: true },
    breakpoints: {
      0: { slidesPerView: 1.08 },
      768: { slidesPerView: 2 },
      1200: { slidesPerView: 3 }
    }
  });

  new Swiper('.market-coverflow', {
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    loop: true,
    slidesPerView: 'auto',
    coverflowEffect: {
      rotate: 30,
      stretch: 0,
      depth: 130,
      modifier: 1,
      slideShadows: false
    },
    navigation: { nextEl: '.market-next', prevEl: '.market-prev' },
    pagination: { el: '.market-pagination', clickable: true }
  });
</script>
</body>
</html>
