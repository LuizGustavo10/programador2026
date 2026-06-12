<?php
include './backend/conexao.php';

$id = $_GET['id'] ?? 0;
$dadosMercado = mysqli_query($conexao, "SELECT * FROM mercado WHERE id='$id' ");
$mercado = mysqli_fetch_assoc($dadosMercado);

if(!$mercado){
  echo "Mercado nao encontrado!";
  exit;
}

$produtos = mysqli_query($conexao , "SELECT * FROM produto WHERE mercado_id='$id' AND disponibilidade='ativo' ORDER BY nome");

function telefoneWhatsapp($telefone)
{
  $numero = preg_replace('/\D/', '', $telefone);
  if(substr($numero, 0, 2) != '55'){
    $numero = '55' . $numero;
  }
  return $numero;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $mercado['nome']; ?> - Ecolote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
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
        <li class="nav-item"><a class="nav-link active" href="./index.php">Mercados</a></li>
        <li class="nav-item"><a class="nav-link active" href="./sobre.php">Sobre</a></li>
      </ul>
      <a href="./login_mercado.php" class="btn btn-dark">Login Mercado</a>
    </div>
  </div>
</nav>

<header class="market-hero" style="background-image: linear-gradient(90deg, rgba(51,6,114,.82), rgba(51,6,114,.38)), url('<?php echo !empty($mercado['foto']) ? $mercado['foto'] : 'imagem/mercadinho2.png'; ?>');">
  <div class="container">
    <h1><?php echo $mercado['nome']; ?></h1>
    <p><?php echo $mercado['endereco']; ?></p>
  </div>
</header>

<section class="market-info">
  <div class="container">
    <div class="row g-4 align-items-stretch">
      <div class="col-lg-5">
        <div class="info-panel h-100">
          <h2>Informações do mercado</h2>
          <p><strong>Email:</strong> <?php echo $mercado['email']; ?></p>
          <p><strong>Endereço:</strong> <?php echo $mercado['endereco']; ?></p>
          <p><strong>Telefone:</strong> <?php echo $mercado['telefone']; ?></p>
          <a class="btn btn-success" target="_blank" href="https://wa.me/<?php echo telefoneWhatsapp($mercado['telefone']); ?>">Chamar no WhatsApp</a>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="map-panel h-100">
          <?php if(!empty($mercado['mapa']) && strpos($mercado['mapa'], '<iframe') !== false){ ?>
            <?php echo $mercado['mapa']; ?>
          <?php }elseif(!empty($mercado['mapa'])){ ?>
            <a href="<?php echo $mercado['mapa']; ?>" target="_blank" class="btn btn-outline-dark">Abrir mapa</a>
          <?php }else{ ?>
            <p class="text-muted mb-0">Mapa ainda nao cadastrado.</p>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>

<main class="container py-5">
  <div class="d-flex align-items-end justify-content-between gap-3 flex-wrap mb-4">
    <div>
      <h2 class="mb-1">Produtos disponíveis</h2>
      <p class="text-muted mb-0">Consulte disponibilidade pelo WhatsApp do mercado.</p>
    </div>
  </div>
  <div class="row g-4">
    <?php while($produto = mysqli_fetch_assoc($produtos)){ ?>
      <?php
        $mensagem = urlencode("Olá, gostaria de saber se o produto ".$produto['nome']." está disponível.");
        $receitasProduto = mysqli_query($conexao, "SELECT receita.* FROM receita INNER JOIN produto_receita ON produto_receita.receita_id = receita.id WHERE produto_receita.produto_id='".$produto['id']."' ORDER BY receita.nome");
      ?>
      <div class="col-12 col-sm-6 col-lg-4">
        <article class="product-card h-100">
          <img src="<?php echo !empty($produto['imagem']) ? $produto['imagem'] : 'imagem/mercadinho2.png'; ?>" alt="<?php echo $produto['nome']; ?>">
          <div class="product-card-body">
            <div class="d-flex justify-content-between gap-2 align-items-start">
              <h3><?php echo $produto['nome']; ?></h3>
              <strong>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></strong>
            </div>
            <a target="_blank" class="btn btn-success w-100 my-3" href="https://wa.me/<?php echo telefoneWhatsapp($mercado['telefone']); ?>?text=<?php echo $mensagem; ?>">Perguntar no WhatsApp</a>

            <div class="recipe-list">
              <h4>Receitas com este produto</h4>
              <?php if(mysqli_num_rows($receitasProduto) == 0){ ?>
                <p class="text-muted mb-0">Nenhuma receita vinculada.</p>
              <?php } ?>
              <?php while($receita = mysqli_fetch_assoc($receitasProduto)){ ?>
                <div class="recipe-item">
                  <?php if(!empty($receita['foto'])){ ?>
                    <a href="receita_detalhe.php?id=<?php echo $receita['id']; ?>">
                      <img src="<?php echo $receita['foto']; ?>" alt="<?php echo $receita['nome']; ?>">
                    </a>
                  <?php } ?>
                  <div>
                    <a href="receita_detalhe.php?id=<?php echo $receita['id']; ?>">
                      <strong><?php echo $receita['nome']; ?></strong>
                    </a>
                    <p><?php echo $receita['descricao']; ?></p>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </article>
      </div>
    <?php } ?>
  </div>
</main>

<footer class="public-footer">
  <div class="container d-flex align-items-center justify-content-between gap-3 flex-wrap">
    <div>
      <strong>Ecolote</strong>
      <span><?php echo $mercado['nome']; ?> no consumo consciente.</span>
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
</body>
</html>
