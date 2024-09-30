<?php

session_start();
if(!isset($_SESSION['id']))
{
    header("location: ../Tela Principal/inicio.php");
    exit;
}    

	require_once "../classes/usuarios.php";
	$p = new Usuario("projeto_tcc", "localhost", "root", "");
 

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

    <?php
      if(isset($_GET['id_up']))
        {
          $id_update = addslashes($_GET['id_up']);
          $res = $p->buscarDadosPessoa($id_update);
        }
        

?>
      
    </div>       
          
          
        <nav id="menu">
            <h1>Menu Principal</h1>
                <ul type= "disc">
                    <li><a href="../gerenciar produtos/gerenciar.php">Gerenciar Produtos</a></li>
                    <li><a href="../validade produtos/validade_produtos.php">Validade Produtos</a></li>
                    <li><a href="../relatorios/relatorios.php">Relatórios</a></li>
                    <li><a href="../Usuarios/usuarios.php">Usuários</a></li>
                </ul>
                <div id="icone1">
                <a href="http://localhost/Projeto%20TCC/Usuarios/alterar.php?id_up=<?php echo $id_update ?>&delete=true"><img src="../imagens/Excluir_02.png" width="80"; height="80"></a>
                </div>     
        </nav>

        <div id=nomeusuarios>
          <h1>Gerenciamento <br> de Usuários</h1>
        </div>
    
             
        <form id="cadastrar" method="POST">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Nome</label>
              <input type="text" class="form-control" id="inputEmail4" name="nome" size="80"
              value="<?php if(isset($res)){echo $res['nome'];}?>"
              >
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail5">E-mail</label>
              <input type="text" class="form-control" id="inputEmail5" name="email" size="80"
              value="<?php if(isset($res)){echo $res['email'];}?>"
              >
            </div>
          </div>
            <input id="botao" type="submit" class="btn btn-primary" value="Alterar" name="alterar">
          </form>


          <div class="botao_sair">
          <a href="../logout.php">Sair</a>
        </div>
   
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



        <?php
if (isset($_GET['id_up']) && isset($_GET['delete']) && $_GET['delete'] === 'true') {
    $id_update = addslashes($_GET['id_up']);
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        // Aqui você pode chamar o método de exclusão
        $p->excluir_usuario($id_update);
        header("location: http://localhost/Projeto%20TCC/Usuarios/usuarios.php");
        exit;
    }
    ?>
    <div class="modal" tabindex="-1" role="dialog" id="confirmModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar exclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir este usuário?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="http://localhost/Projeto%20TCC/Usuarios/alterar.php?id_up=<?php echo $id_update ?>&delete=true&confirm=true" class="btn btn-danger">Excluir</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#confirmModal').modal('show');
        });
    </script>
<?php
}
?>
    
  </body>
</html>


<?php
if (isset($_POST['alterar'])) {
    $id = $id_update;
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);

    // Verificar se está preenchido
    if (!empty($nome) && !empty($email)) {
        if ($p->msgErro == "") {
            if ($p->atualizarDadosPessoa($id, $nome, $email)) {
              
                ?>
                <div id="msg-jacadastrado2">
                    Alterado com sucesso!
                </div>
                <?php
            }else {
             
        ?>
        <div id="msg-jacadastrado2">
          Alterado com sucesso!
          
        </div>
        <?php
         
        }
      }
     
    }
    sleep(2.5);
    header("location: http://localhost/Projeto%20TCC/Usuarios/usuarios.php");
  }
?> 






