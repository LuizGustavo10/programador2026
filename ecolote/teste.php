<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
</head>
<body>
    <h2> Trabalhando com PHP</h2>

    <?php
        $nome = 'Osnir';
        $operadora = 'Claro';

        if($operadora == 'Claro'){
            echo 'Não usar, operadora problemática! ';
        }else{
            echo 'Vai na fé! ';
        }

        echo "<h1> Olá mundo! Bem-vindo $nome </h1>";

        for($contador=0; $contador < 10; $contador++){
            echo $contador;
            echo '<img src="https://diariodonoroeste.com.br/wp-content/uploads/2021/08/000-a-nova-copiar.jpg">';
            // echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/RKaXl1XVnos?si=hSHayejV6M7FhEoI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
        }

        $numero = 0;
        while($numero < 10){
            echo "<br> Item da lista número: $numero";
            echo "<hr>";
            $numero = $numero + 1;
        }


    ?>


    
</body>
</html>