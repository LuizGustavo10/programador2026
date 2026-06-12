<?php
  include './backend/conexao.php';
  include './backend/validacao.php';

  $tipoUsuario = $_SESSION['tipo'] ?? 'admin';
  $mercadoLogado = $_SESSION['mercado_id'] ?? '';
  $destino = "./backend/produto/inserir.php";
  $produtos = null;
  $receitasSelecionadas = [];

  if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $filtroMercado = ($tipoUsuario == 'mercado') ? " AND mercado_id='$mercadoLogado' " : "";
    $sql = "SELECT * FROM produto WHERE id='$id' $filtroMercado";
    $dados = mysqli_query($conexao, $sql);
    $produtos = mysqli_fetch_assoc($dados);
    $destino = "./backend/produto/alterar.php";

    if($produtos){
      $buscaReceitasProduto = mysqli_query($conexao, "SELECT receita_id FROM produto_receita WHERE produto_id='".$produtos['id']."'");
      while($itemReceita = mysqli_fetch_assoc($buscaReceitasProduto)){
        $receitasSelecionadas[] = $itemReceita['receita_id'];
      }
    }
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
                <?php include './modulos/menu_lateral.php' ?>
            </div>
            <div class="col-md-5">
              <form action="<?=$destino?>" method="post" enctype="multipart/form-data" class="p-3">
                <h3> <i class="fa-solid fa-circle-plus"></i> Cadastro de produto </h3>
                 <div class="mb-3">
                    <label class="form-label"> id </label>
                    <input value="<?php echo isset($produtos) ? $produtos['id'] : "" ?>" type="text" name="id" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Nome </label>
                    <input value="<?php echo isset($produtos) ? $produtos['nome'] : "" ?>" type="text" name="nome" class="form-control" required>
                </div>
                 <div class="mb-3">
                    <label class="form-label"> Preco </label>
                    <input value="<?php echo isset($produtos) ? number_format($produtos['preco'], 2, ',', '.') : "" ?>" type="text" name="preco" class="form-control mascara-preco" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Disponibilidade </label>
                    <select class="form-select" name="disponibilidade">
                      <?php $disponibilidadeAtual = $produtos['disponibilidade'] ?? 'ativo'; ?>
                      <option value="ativo" <?php echo ($disponibilidadeAtual == 'ativo') ? 'selected' : '' ?>>Ativo</option>
                      <option value="inativo" <?php echo ($disponibilidadeAtual == 'inativo') ? 'selected' : '' ?>>Inativo</option>
                    </select>
                  </div>
                <div class="mb-3">
                    <label class="form-label"> Foto do produto </label>
                    <input type="file" name="imagem" class="form-control" accept="image/*" onchange="mostrarPreview(this, 'previewImagem')">
                    <input type="hidden" name="imagem_atual" value="<?php echo isset($produtos) ? $produtos['imagem'] : "" ?>">
                    <small class="text-muted">JPG, PNG ou WEBP ate 4 MB. Imagens grandes serao reduzidas automaticamente.</small>
                    <img id="previewImagem" class="img-thumbnail mt-2 d-none preview-form">
                    <?php if(!empty($produtos['imagem'])){ ?>
                      <p class="mb-1 mt-2">Foto atual:</p>
                      <img src="<?php echo $produtos['imagem'] ?>" class="img-thumbnail mt-2 preview-form">
                    <?php } ?>
                </div>

                <div class="mb-3">
                  <label class="form-label"> Mercado </label>
                  <?php if($tipoUsuario == 'mercado'){ ?>
                    <input type="hidden" name="mercado" value="<?php echo $mercadoLogado ?>">
                    <input type="text" class="form-control" value="<?php echo $_SESSION['usuario'] ?>" readonly>
                  <?php }else{ ?>
                    <select name="mercado" class="form-select">
                      <?php
                        $busca = mysqli_query($conexao, "SELECT * FROM mercado ORDER BY nome");
                        $mercadoSelecionado = $produtos['mercado_id'] ?? '';
                        while($mercado = $busca->fetch_assoc()){
                        $selected = ($mercadoSelecionado == $mercado['id']) ? 'selected' : '';
                      ?>
                      <option value="<?=$mercado['id']?>" <?=$selected ?>><?=$mercado['nome']?></option>
                      <?php } ?>
                    </select>
                  <?php } ?>
                </div>

                <div class="mb-3">
                  <label class="form-label"> Receitas vinculadas </label>
                  <select name="receitas[]" class="form-select" multiple>
                    <?php
                      $buscaReceitas = mysqli_query($conexao, "SELECT * FROM receita ORDER BY nome");
                      while($receita = mysqli_fetch_assoc($buscaReceitas)){
                        $selected = in_array($receita['id'], $receitasSelecionadas) ? 'selected' : '';
                    ?>
                      <option value="<?php echo $receita['id'] ?>" <?php echo $selected ?>><?php echo $receita['nome'] ?></option>
                    <?php } ?>
                  </select>
                  <small class="text-muted">Segure Ctrl para escolher varias receitas.</small>
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
                  <th scope="col">Imagem</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Preco</th>
                  <th scope="col">Disponibilidade</th>
                  <th scope="col">Mercado</th>
                  <th scope="col">Opcoes</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $filtroListagem = ($tipoUsuario == 'mercado') ? " WHERE produto.mercado_id='$mercadoLogado' " : "";
                  $sql = "SELECT produto.*, mercado.nome AS mercado_nome FROM produto INNER JOIN mercado ON mercado.id = produto.mercado_id $filtroListagem ORDER BY produto.nome";
                  $dados = mysqli_query($conexao, $sql);
                  while($coluna = mysqli_fetch_assoc($dados)){
                ?>
                <tr>
                  <th scope="row"> <?php echo $coluna['id'] ?> </th>
                  <td>
                    <?php if(!empty($coluna['imagem'])){ ?>
                      <img src="<?php echo $coluna['imagem'] ?>" class="miniatura-tabela">
                    <?php } ?>
                  </td>
                  <td> <?php echo $coluna['nome'] ?></td>
                  <td> R$ <?php echo number_format($coluna['preco'], 2, ',', '.') ?></td>
                  <td> <?php echo $coluna['disponibilidade'] ?></td>
                  <td><?php echo $coluna['mercado_nome'] ?></td>
                  <td>
                    <a href="./produto.php?id=<?=$coluna['id']?>"> <i class="fa-solid fa-pen-to-square" style="color: rgb(1, 92, 164);"></i> </a>
                    <a href="<?php echo './backend/produto/excluir.php?id='.$coluna['id'] ?>" onclick="return confirm('Deseja realmente excluir?')"> <i class="fa-solid fa-trash" style="color: rgb(255, 0, 0);"></i> </a>
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
