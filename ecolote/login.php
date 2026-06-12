<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do Sistema</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/particle.css">
    <link rel="stylesheet" href="assets/estilo.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
</head>
<body class="corpologin">

    <div class="row justify-content-center align-items-center vh-100 painel">
        <div class="col-12 col-sm-10 col-md-6 col-lg-4 card shadow p-4 telalogin animate__animated animate__zoomIn">
            <div class="text-center">
                <i class="fa-solid fa-circle-user fa-2xl" style="color: rgb(116, 192, 252); font-size: 80px; margin-top: 50px;"></i>
                <h3 class="m-4"> Login Administrativo </h3>
            </div>
            <form action="./backend/logar.php" method="post">
                <div class="mb-3">
                    <label class="form-label"> Email </label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label"> Senha </label>
                    <input type="password" name="senha" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Entrar</button>
                <button type="reset" class="btn btn-secondary"> Limpar </button>
                <a href="./login_mercado.php" class="btn btn-outline-secondary mt-2 mt-sm-0"> Login Mercado </a>
            </form>
        </div>
    </div>


    <!-- particles.js container -->
<div id="particles-js"></div> <!-- stats - count particles -->
<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> <!-- stats.js lib -->
<script src="http://threejs.org/examples/js/libs/stats.min.js"></script>

    <script src="./assets/particle.js"></script>
    <script src="./assets/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
