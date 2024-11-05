<?php

    session_start();
    if(!isset($_SESSION['id']))
    {
        header("location: ../Tela Principal/inicio.php");
        exit;
    }    
    
	require_once "../classes/produtos.php";
	$u = new Produto("projeto_tcc", "localhost", "root", "");

  
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

  <body id="pagina">
     
  <div class="baner">
 
        </div>

        
          
      
        <nav id="menu">
            <h1>Menu Principal</h1>
                <ul type= "disc">
                    <li><a href="../gerenciar produtos/gerenciar.php">Gerenciar Produtos</a></li>
                    <li><a href="../validade produtos/validade_produtos.php">Saída de Estoque</a></li>
                    <li><a href="../relatorios/relatorios.php">Relatórios</a></li>
                    <li><a href="../Usuarios/usuarios.php">Usuários</a></li>
                </ul>
        </nav>
        
      <div id=nomeprodutos>
        <h1>Gerenciar Produtos</h1>
      </div>

      <form id="cadastrar" method="POST">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Nome do Produto</label>
              <input type="text" class="form-control" id="inputEmail4" name="nome" size="80">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Validade</label>
              <input type="date" class="form-control" id="inputEmail4" name="data" size="80">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Quantidade</label>
              <input type="number" class="form-control" id="inputEmail4" name="quantidade" size="80">
            </div>
          </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputPassword4">Peso /Kg</label>
                <input type="float" name="peso" class="form-control" id="inputPassword4">
              </div>
            </div>
            <input id="botao" type="submit" class="btn btn-primary" value="Cadastrar" name="Cadastrar">
          </form>
   
          <div class="botao_sair">
          <a href="../logout.php">Sair</a>
        </div>
   
	       
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


        <?php
      if(isset($_POST['nome']))
      {
          $nome = addslashes($_POST['nome']);
          $validade = addslashes($_POST['data']);
          $quantidade = addslashes($_POST['quantidade']);
          $peso = addslashes($_POST['peso']);
          $peso = str_replace(',', '.', $peso);
          
          
          
          if(!empty($nome) && !empty($validade) && !empty($quantidade) && !empty($peso))
          {
              $u->__construct("projeto_tcc","localhost","root","");
              if($u->msgErro == "")
              {
                    if($u->cadastrar($nome, $validade, $quantidade, $peso))
                      {
                ?>
                  <div id="msg-3">
                    Cadastrado com sucesso!
                    </div>
                <?php
                sleep(2); 
                
                
                header("Location: http://localhost/Projeto%20TCC/gerenciar%20produtos/gerenciar.php");
                exit; 
                      }
                      else
                      {
                ?>
                  <div id="msg-jacadastrado">
                    Nome já cadastrado !
                  </div>
                <?php
                      }
                
              ?>
                <div id="msg-conf">
               
                </div>
              <?php
                  
              }
              else
              {
            ?>

              <div id="msg erro">
              <?php echo"Erro: ".$u->msgErro; ?>
              
              </div>
            <?php
            
              }
          }else
          {
          ?>
          <div id="msg-3">
            Preencha todos os campos!
          </div>

          <?php
          
          }

      }

      ?>

     
  </body>
</html>
