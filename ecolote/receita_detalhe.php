<?php
include './backend/conexao.php';

$id = $_GET['id'] ?? 0;
$dadosReceita = mysqli_query($conexao, "SELECT * FROM receita WHERE id='$id'");
$receita = mysqli_fetch_assoc($dadosReceita);

if(!$receita){
  echo "Receita não encontrada!";
  exit;
}

$produtosReceita = mysqli_query($conexao, "SELECT produto.*, mercado.nome AS mercado_nome, mercado.id AS mercado_id FROM produto INNER JOIN produto_receita ON produto_receita.produto_id = produto.id INNER JOIN mercado ON mercado.id = produto.mercado_id WHERE produto_receita.receita_id='".$receita['id']."' ORDER BY mercado.nome, produto.nome");

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
  <title><?php echo textoSeguro($receita['nome']); ?> - Ecolote</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
<nav class="navbar navbar-expand-lg fundoazul shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="./index.php">Ecolote</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarReceita" aria-controls="navbarReceita" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarReceita">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link active" href="./index.php#mercados">Mercados</a></li>
        <li class="nav-item"><a class="nav-link active" href="./index.php#produtos">Produtos</a></li>
        <li class="nav-item"><a class="nav-link active" href="./index.php#receitas">Receitas</a></li>
        <li class="nav-item"><a class="nav-link active" href="./sobre.php">Sobre</a></li>
      </ul>
      <a href="./login_mercado.php" class="btn btn-dark">Login Mercado</a>
    </div>
  </div>
</nav>

<header class="market-hero" style="background-image: linear-gradient(90deg, rgba(51,6,114,.84), rgba(51,6,114,.35)), url('<?php echo !empty($receita['foto']) ? $receita['foto'] : 'imagem/mercadinho2.png'; ?>');">
  <div class="container">
    <h1><?php echo textoSeguro($receita['nome']); ?></h1>
    <p>Receita cadastrada no Ecolote para aproveitar melhor os produtos disponíveis.</p>
  </div>
</header>

<main class="recipe-detail">
  <div class="container">
    <div class="row g-4 align-items-start">
      <div class="col-lg-5">
        <img class="recipe-detail-photo" src="<?php echo !empty($receita['foto']) ? $receita['foto'] : 'imagem/mercadinho2.png'; ?>" alt="<?php echo textoSeguro($receita['nome']); ?>">
      </div>
      <div class="col-lg-7">
        <section class="recipe-detail-panel">
          <h2>Informações da receita</h2>
          <p><?php echo textoSeguro($receita['descricao']); ?></p>
        </section>

        <section class="recipe-detail-panel mt-4">
          <h2>Produtos vinculados</h2>
          <?php if(mysqli_num_rows($produtosReceita) == 0){ ?>
            <p class="mb-0">Nenhum produto vinculado a esta receita ainda.</p>
          <?php }else{ ?>
            <div class="linked-products">
              <?php while($produto = mysqli_fetch_assoc($produtosReceita)){ ?>
                <a class="linked-product" href="mercado_detalhe.php?id=<?php echo $produto['mercado_id']; ?>">
                  <img src="<?php echo !empty($produto['imagem']) ? $produto['imagem'] : 'imagem/mercadinho2.png'; ?>" alt="<?php echo textoSeguro($produto['nome']); ?>">
                  <div>
                    <strong><?php echo textoSeguro($produto['nome']); ?></strong>
                    <span><?php echo textoSeguro($produto['mercado_nome']); ?> - R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span>
                  </div>
                </a>
              <?php } ?>
            </div>
          <?php } ?>
        </section>
      </div>
    </div>
  </div>
</main>

<footer class="public-footer">
  <div class="container d-flex align-items-center justify-content-between gap-3 flex-wrap">
    <div>
      <strong>Ecolote</strong>
      <span>Receitas para consumo consciente.</span>
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
