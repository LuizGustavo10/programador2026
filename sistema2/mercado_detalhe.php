<?php
include './backend/conexao.php';

$id = $_GET['id'] ?? 0;
$dadosMercado = mysqli_query($conexao, "SELECT * FROM mercado WHERE id='$id'");
$mercado = mysqli_fetch_assoc($dadosMercado);

if (!$mercado) {
    echo "Mercado nao encontrado.";
    exit;
}

$produtos = mysqli_query($conexao, "SELECT * FROM produto WHERE mercado_id='$id' ORDER BY nome");

function fotoOuPadraoMercado($foto)
{
    if (!empty($foto) && file_exists($foto)) {
        return $foto;
    }

    return 'imagem/1779909443_346b3f2a__imagem2.png';
}

function linkWhatsapp($telefone, $produto)
{
    $numero = preg_replace('/\D/', '', $telefone);

    if (strlen($numero) <= 11) {
        $numero = '55' . $numero;
    }

    $texto = urlencode("Ola, o produto $produto esta disponivel?");

    return "https://wa.me/$numero?text=$texto";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$mercado['nome']?> - Ecolote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<nav class="navbar navbar-expand-lg fundoazul">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Ecolote</a>
    <a href="index.php" class="btn btn-outline-dark">Voltar</a>
  </div>
</nav>

<header class="mercado-topo">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-md-5">
        <img src="<?=fotoOuPadraoMercado($mercado['foto'])?>" class="mercado-foto" alt="<?=$mercado['nome']?>">
      </div>
      <div class="col-md-7">
        <h1><?=$mercado['nome']?></h1>
        <p><?=$mercado['endereco']?></p>
        <p class="mb-0"><?=$mercado['telefone']?></p>
      </div>
    </div>
  </div>
</header>

<main class="container py-5">
  <div class="titulo-secao">
    <h2>Produtos</h2>
    <p>Fale com o mercado para confirmar a disponibilidade antes de comprar.</p>
  </div>

  <div class="row g-4">
    <?php while($produto = mysqli_fetch_assoc($produtos)){ ?>
      <div class="col-12 col-sm-6 col-lg-4">
        <div class="card card-vitrine h-100">
          <img src="<?=fotoOuPadraoMercado($produto['imagem'])?>" class="card-img-top" alt="<?=$produto['nome']?>">
          <div class="card-body">
            <h3 class="card-title h5"><?=$produto['nome']?></h3>
            <p class="card-text">R$ <?=number_format($produto['preco'], 2, ',', '.')?></p>
            <a class="btn btn-success w-100" target="_blank" href="<?=linkWhatsapp($mercado['telefone'], $produto['nome'])?>">Chamar no WhatsApp</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
