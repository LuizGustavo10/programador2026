<?php
  include './backend/conexao.php';
  include './backend/validacao.php';

  if(($_SESSION['tipo'] ?? 'admin') != 'admin'){
    header('Location: ./produto.php');
    exit;
  }

  $destino = "./backend/receita/inserir.php";

  if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM receita WHERE id='$id' ";
    $dados = mysqli_query($conexao, $sql);
    $receitas = mysqli_fetch_assoc($dados);
    $destino = "./backend/receita/alterar.php";
  }
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Ecolote </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />
  </head>
<body>

<?php include './modulos/menu_superior.php' ?>

<div id="escurecer" class="escurecer" onclick="abrirmenu()"></div>

   <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-dark p-0">
              <?php include './modulos/menu_lateral.php'; ?>
            </div>
            <div class="col-md-5">
              <form action="<?=$destino?>" method="post" enctype="multipart/form-data" class="p-3">
                <h3> <i class="fa-solid fa-book-open"></i> Cadastro de receita </h3>
                 <div class="mb-3">
                    <label class="form-label"> id </label>
                    <input value="<?php echo isset($receitas) ? $receitas['id'] : "" ?>" type="text" name="id" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Nome da receita </label>
                    <input value="<?php echo isset($receitas) ? $receitas['nome'] : "" ?>" type="text" name="nome" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Foto </label>
                    <input type="file" name="foto" class="form-control" accept="image/*" onchange="mostrarPreview(this, 'previewReceita')">
                    <input type="hidden" name="foto_atual" value="<?php echo isset($receitas) ? $receitas['foto'] : "" ?>">
                    <small class="text-muted">JPG, PNG ou WEBP ate 4 MB. Imagens grandes serao reduzidas automaticamente.</small>
                    <img id="previewReceita" class="img-thumbnail mt-2 d-none preview-form">
                    <?php if(!empty($receitas['foto'])){ ?>
                      <p class="mb-1 mt-2">Foto atual:</p>
                      <img src="<?php echo $receitas['foto'] ?>" class="img-thumbnail mt-2 preview-form">
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Descricao da receita </label>
                    <textarea name="descricao" class="form-control" rows="6" required><?php echo isset($receitas) ? $receitas['descricao'] : "" ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary"> Salvar </button>
                <button type="reset" class="btn btn-secondary"> Limpar </button>
            </form>
            </div>
            <div class="col-md-5">
              <br>
              <h3> <i class="fa-solid fa-address-book"></i> Listagem </h3>
              <table class="table align-middle" id="tabela">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Foto</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Opcoes</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $sql = 'SELECT * FROM receita ORDER BY nome';
                  $dados = mysqli_query($conexao, $sql);
                  while($coluna = mysqli_fetch_assoc($dados)){
                ?>
                <tr>
                  <th scope="row"> <?php echo $coluna['id'] ?> </th>
                  <td>
                    <?php if(!empty($coluna['foto'])){ ?>
                      <img src="<?php echo $coluna['foto'] ?>" class="miniatura-tabela">
                    <?php } ?>
                  </td>
                  <td> <?php echo $coluna['nome'] ?></td>
                  <td>
                    <a href="./receita.php?id=<?=$coluna['id']?>"> <i class="fa-solid fa-pen-to-square" style="color: rgb(1, 92, 164);"></i> </a>
                    <a href="<?php echo './backend/receita/excluir.php?id='.$coluna['id'] ?>" onclick="return confirm('Deseja realmente excluir?')"> <i class="fa-solid fa-trash" style="color: rgb(255, 0, 0);"></i> </a>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            </div>
        </div>
   </div>

   <script>
        function abrirmenu(){
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('escurecer').classList.toggle('show');
        }
   </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
    <script src="assets/script.js"></script>
</body>
</html>
