<?php
$programadores = [
  [
    'numero' => '001',
    'nome' => 'Programador 1',
    'foto' => '',
    'github' => 'https://github.com/'
  ],
  [
    'numero' => '002',
    'nome' => 'Programador 2',
    'foto' => '',
    'github' => 'https://github.com/'
  ],
  [
    'numero' => '003',
    'nome' => 'Programador 3',
    'foto' => '',
    'github' => 'https://github.com/'
  ],
  [
    'numero' => '004',
    'nome' => 'Programador 4',
    'foto' => '',
    'github' => 'https://github.com/'
  ]
];

function textoSeguro($texto)
{
  return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
}

function iniciaisProgramador($nome)
{
  $partes = preg_split('/\s+/', trim($nome));
  $iniciais = '';
  foreach($partes as $parte){
    if($parte !== ''){
      $iniciais .= strtoupper(substr($parte, 0, 1));
    }
    if(strlen($iniciais) >= 2){
      break;
    }
  }
  return $iniciais ?: 'EC';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sobre - Ecolote</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
<nav class="navbar navbar-expand-lg fundoazul shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="./index.php">Ecolote</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSobre" aria-controls="navbarSobre" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSobre">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link active" href="./index.php#mercados">Mercados</a></li>
        <li class="nav-item"><a class="nav-link active" href="./index.php#produtos">Produtos</a></li>
        <li class="nav-item"><a class="nav-link active" href="./index.php#receitas">Receitas</a></li>
      </ul>
      <a href="./login.php" class="btn btn-outline-dark me-2">Admin</a>
      <a href="./login_mercado.php" class="btn btn-dark">Mercado</a>
    </div>
  </div>
</nav>

<header class="about-hero">
  <div class="container">
    <span class="market-pill">Álbum Copa 2026</span>
    <h1>Time de programadores</h1>
    <p>Uma página em estilo álbum de figurinhas para apresentar quem construiu o Ecolote, com foto, nome e GitHub de cada integrante.</p>
  </div>
</header>

<main class="album-section">
  <div class="container">
    <div class="section-heading">
      <span>Escalação oficial</span>
      <h2>Figurinhas do projeto</h2>
      <p>Edite o array no topo deste arquivo para trocar nomes, fotos e links do GitHub.</p>
    </div>

    <div class="album-grid">
      <?php foreach($programadores as $programador){ ?>
        <article class="sticker-card">
          <div class="sticker-photo">
            <?php if(!empty($programador['foto'])){ ?>
              <img src="<?php echo textoSeguro($programador['foto']); ?>" alt="<?php echo textoSeguro($programador['nome']); ?>">
            <?php }else{ ?>
              <span class="sticker-initials"><?php echo textoSeguro(iniciaisProgramador($programador['nome'])); ?></span>
            <?php } ?>
          </div>
          <div class="sticker-info">
            <small>#<?php echo textoSeguro($programador['numero']); ?> ECOLOTE 2026</small>
            <h2><?php echo textoSeguro($programador['nome']); ?></h2>
            <a href="<?php echo textoSeguro($programador['github']); ?>" target="_blank">
              <i class="fa-brands fa-github"></i> GitHub
            </a>
          </div>
        </article>
      <?php } ?>
    </div>
  </div>
</main>

<footer class="public-footer">
  <div class="container d-flex align-items-center justify-content-between gap-3 flex-wrap">
    <div>
      <strong>Ecolote</strong>
      <span>Álbum dos programadores.</span>
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
