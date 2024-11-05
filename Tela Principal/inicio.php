<?php 
require_once '../CLASSES/usuarios.php';
$u = new Usuario("projeto_tcc", "localhost", "root", "");

?>

<html lang="pt-br">
    <head>
            <meta charset="UTF-8">
            <title>Controle de Estoque</title>

            <meta name="viewport" content="width=device-width">
            <link rel="stylesheet" type="text/css" href="../_css/estilo.css">
            
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  
    </head>

    <body>

    <div class="baner_login">
         <img src="../imagens/baner2.jpeg" width= "100%"; height= "100%"; >
        </div>

        <div class="titulo_login">
          <h1>STOCK GUARDIAN</h1>
        </div>


        
        <form id="cadastrar_login" method="POST">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail4">Login</label>
            <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Digite seu e-mail" size="60">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputPassword4">Senha</label>
            <input type="password" name="senha" class="form-control" id="inputPassword4" placeholder="Senha" size="50">
        </div>
    </div>
    <form id="botao1">
        <input id="botao" type="submit" class="btn btn-primary" value="Acessar" name="Cadastrar" position="center">
    </form>
</form>




          <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        

        <div class="12">
        <?php
if (isset($_POST['email'])) { 
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    
    if (!empty($email) && !empty($senha)) {
        $u->__construct("projeto_tcc", "localhost", "root", "");
        
        if ($u->msgErro == "") {
            if ($u->logar($email, $senha)) {
                
                header("location: ../corpo/corpo.php");
                exit;
            } else {
                echo '<div id="msg-jacadastrado1">E-mail e/ou senha estão incorretos!</div>'; 
            }
        } else {
            echo '<div id="msg-jacadastrado">Erro: ' . $u->msgErro . '</div>';
        }
    } else {
        echo '<div id="msg-jacadastrado1">Preencha todos os campos!</div>';
    }
}
?>
</div>
 </body>
</html>