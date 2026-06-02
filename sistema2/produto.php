<?php
  include './backend/conexao.php';
  include './backend/validacao.php';

  //destino que o formulário enviará os dados
  $destino = "./backend/produto/inserir.php";
  
  //no caso de estar havendo alguma edição
  //carregará os dados do formulário e mandará para o arquivo alterar
  //Se for diferente de vazio o id
  if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM produto WHERE id='$id' ";
    //executar sql
    $dados = mysqli_query($conexao, $sql);
    $produtos = mysqli_fetch_assoc($dados);
    //destino será alterado, para o caminho do alterar
    $destino = "./backend/produto/alterar.php";
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
            <div class="col-md-2 bg-dark">
                <?php include './modulos/menu_lateral.php' ?>
            </div>
            <div class="col-md-5">
              <form action="<?=$destino?>" method="post" enctype="multipart/form-data" class="p-3">
                <h3> <i class="fa-solid fa-circle-plus"></i> Cadastro </h3>
                 <div class="mb-3">
                    <label class="form-label"> id </label>
                    <input value="<?php echo isset($produtos) ? $produtos['id'] : "" ?>" type="text" name="id" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Nome </label>
                    <input value="<?php echo isset($produtos) ? $produtos['nome'] : "" ?>" type="text" name="nome" class="form-control">
                </div>
                 <div class="mb-3">
                    <label class="form-label"> Preço </label>
                    <input value="<?php echo isset($produtos) ? $produtos['preco'] : "" ?>" type="text" name="preco" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label"> Dispobilidade </label>
                   
                    <select class="form-select" name="disponibilidade">
                      <option value="selecione"> Selecione... </option>
                      <option value="ativo"> 🟢Ativo </option>
                      <option value="inativo"> 🔴Inativo </option>
                    </select>
                  </div>
                <div class="mb-3">
                    <label class="form-label"> Foto do produto </label>
                    <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*" onchange="mostrarPreview(this, 'previewImagem')">
                    <input type="hidden" name="imagem_atual" value="<?php echo isset($produtos) ? $produtos['imagem'] : "" ?>">
                    <small class="text-muted">Escolha uma imagem JPG, PNG ou WEBP.</small>
                    <img id="previewImagem" class="img-thumbnail mt-2 d-none" style="width: 120px; height: 80px; object-fit: cover;">
                    <?php if(!empty($produtos['imagem']) && file_exists($produtos['imagem'])){ ?>
                      <p class="mb-1 mt-2">Foto atual:</p>
                      <img src="<?php echo $produtos['imagem'] ?>" class="img-thumbnail mt-2" style="width: 120px; height: 80px; object-fit: cover;">
                    <?php } ?>
                </div>

                <div class="mb-3">
                  <label class="form-label"> Mercado </label>
                    <select name="mercado" class="form-select">
                      <?php
                        $busca = mysqli_query($conexao, "SELECT * FROM mercado");
                        $mercadoSelecionado = $produtos['mercado_id'] ?? '';
                        
                        while($mercado = $busca->fetch_assoc()){ 
                        $selected = ($mercadoSelecionado == $mercado['id']) ? 'selected' : '';
                      ?>
                      <option value="<?=$mercado['id']?>" <?=$selected ?>>  
                      <?=$mercado['nome']?>
                    </option>

                      <?php } ?>
                    </select>
                </div>
               
                <button type="submit" class="btn btn-primary"> Cadastrar </button>
                <button type="reset" class="btn btn-secondary"> Limpar </button>
            </form>
            </div>
            <div class="col-md-5"> 
              <br>
              <h3> <i class="fa-solid fa-address-book"></i> Listagem </h3>
              <table class="table" id="tabela">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Imagem</th>
                  <th scope="col">Preço</th>
                  <th scope="col">Disponibilidade</th>
                  <th scope="col">Mercado</th>
                  <th scope="col">Opções</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $sql = 'SELECT * FROM produto';
                  $dados = mysqli_query($conexao, $sql);
                  //percoorer todos os registros banco
                  while($coluna = mysqli_fetch_assoc($dados)){
                ?>
                <tr>
                  <th scope="row"> <?php echo $coluna['id'] ?> </th>
                  <td> <?php echo $coluna['nome'] ?></td>
                  <td>
                    <?php if(!empty($coluna['imagem']) && file_exists($coluna['imagem'])){ ?>
                      <img src="<?php echo $coluna['imagem'] ?>" style="width: 60px; height: 45px; object-fit: cover; border-radius: 6px;">
                    <?php } ?>
                  </td>
                  <td> <?php echo $coluna['preco'] ?></td>
                  <td> <?php echo $coluna['disponibilidade'] ?></td>
                  <td>
                  <?php 
                  $buscamercado = mysqli_query($conexao, "SELECT * FROM mercado WHERE id=".$coluna['mercado_id']);
                  $mercado = mysqli_fetch_assoc($buscamercado);
                  echo $mercado['id'];
                  echo " - ";
                  echo $mercado['nome'];
                  ?>
                  </td>
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
        function mostrarPreview(input, idPreview){
            const preview = document.getElementById(idPreview);

            if(input.files && input.files[0]){
                preview.src = URL.createObjectURL(input.files[0]);
                preview.classList.remove('d-none');
            }
        }

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
