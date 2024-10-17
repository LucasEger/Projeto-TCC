<?php

session_start();
if(!isset($_SESSION['id']))
{
    header("location: ../Tela Principal/inicio.php");
    exit;
}    

	require_once "../classes/usuarios.php";
	$u = new Usuario("projeto_tcc", "localhost", "root", "");
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
    <div id="banerprincipal">
      
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
          <h1>Gerenciamento <br> de Usuários</h1>
        </div>
     
      

        
              
      
        <form id="cadastrar_usuario" method="POST">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Nome</label>
              <input type="text" class="form-control" id="inputEmail4" name="nome" size="80">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail5">E-mail</label>
              <input type="text" class="form-control" id="inputEmail5" name="email" size="80">
            </div>
          </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputPassword4">Senha</label>
                <input type="password" name="senha" class="form-control" id="inputPassword4">
              </div>
            </div>
            <input id="botao" type="submit" class="btn btn-primary" value="Gravar" name="Cadastrar">
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
          $email = addslashes($_POST['email']);
          $senha = addslashes($_POST['senha']);
          
          //verificar se está preenchido
          if(!empty($nome) && !empty($senha))
          {
              $u->__construct("projeto_tcc","localhost","root","");
              if($u->msgErro == "")//se está tudo ok 
              {
                    if($u->Cadastrar($nome, $email, $senha))
                      {
                ?>
                  <div id="msg-jacadastrado2">
                        Cadastrado com sucesso!
                    </div>
                    
                <?php
                  sleep(2.5);
                  header("location: http://localhost/Projeto%20TCC/Usuarios/usuarios.php");
                      }
                      else
                      {
                ?>
                  <div id="msg-jacadastrado2">
                    E-mail já cadastrado!
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
          <div id="msg-jacadastrado2">
            Preencha todos os campos!
          </div>

          <?php
          
          }

      }

      ?>

    
  </body>
</html>