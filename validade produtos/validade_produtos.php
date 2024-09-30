<?php
       session_start();
       if(!isset($_SESSION['id']))
       {
           header("location: ../Tela Principal/inicio.php");
           exit;
       }    
         
 
include ("../classes/conexao.php");
$consulta = "SELECT id_produtos, nome, validade, quantidade, REPLACE(peso, '.', ',') AS peso FROM produtos ORDER BY `produtos`.`validade` DESC";
$con = $mysqli->query($consulta) or die($mysqli->error);

?>



<html lang="pt-br">
    <head>

            <meta charset="UTF-8">
            <title>Controle de estoque</title>
             <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" type="text/css" href="../_css/estilo.css">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  
    </head>

    <body>
        <div id="banerprincipal">
           
        </div> 
          
    

        
          
      
        <nav id="menu">
            <h1>Menu Principal</h1>
                <ul type= "disc">
                    <li><a href="../gerenciar produtos/gerenciar.php">Gerenciar Produtos</a></li>
                    <li><a href="../validade produtos/validade_produtos.php">Validade Produtos</a></li>
                    <li><a href="../relatorios/relatorios.php">Relatórios</a></li>
                    <li><a href="../Usuarios/usuarios.php">Usuários</a></li>
                </ul>
        </nav>

        <div id=nomevalidade>
         <h1>Validade <br> dos Produtos</h1>
        </div>

        <div class="table table-hover" id="nova_tabela">
        <table>
            <tr>
                <td>código</td>
                <td>Produto</td>
                <td>Validade</td>
                <td>Quantidade</td>
                <td>Peso Kg</td>

            </tr>
              <?php while($dado = $con->fetch_array()){ ?>
            <tr>
                <td><?php echo $dado["id_produtos"]; ?></td>
                <td><?php echo $dado["nome"]; ?></td>
                <td><?php echo date("d/m/y", strtotime($dado["validade"])); ?></td>
                <td><?php echo $dado["quantidade"]; ?></td>
                <td><?php echo $dado["peso"]; ?></td>
            </tr>
            <?php }?>
        </table>
        </div>

        <div class="botao_sair">
          <a href="../logout.php">Sair</a>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  </body>
</html>