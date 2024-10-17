<?php

    session_start();
    if(!isset($_SESSION['id']))
    {
        header("location: ../Tela Principal/inicio.php");
        exit;
    }    
    
    include ("../classes/conexao.php");
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
        <h1>Cadastrar Baixa</h1>
      </div>

      <form id="cadastrar" method="POST">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputProduto">Produto</label>
      <select class="form-control" id="inputProduto" name="produto">
        <?php
          $produtos = $u->buscarProdutos();
          foreach ($produtos as $produto) {
            echo "<option value='" . htmlspecialchars($produto['id']) . "'>" . htmlspecialchars($produto['nome']) . "</option>";
          }
        ?>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputQuantidade">Quantidade</label>
      <input type="number" class="form-control" id="inputQuantidade" name="quantidade" size="80">
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
if (isset($_POST['Cadastrar'])) {
    $id_produto = addslashes($_POST['produto']); // ID do produto selecionado no select
    $quantidade_baixada = addslashes($_POST['quantidade']);
    $id_usuario = $_SESSION['id']; /* ID do usuário que está fazendo a baixa (deve ser definido) */;

    if (!empty($id_produto) && !empty($quantidade_baixada)) {
        // Buscar a quantidade atual do produto
        $res = $pdo->prepare("SELECT quantidade FROM produtos WHERE id = :id_produto");
        $res->bindValue(":id_produto", $id_produto);
        $res->execute();
        $dados = $res->fetch(PDO::FETCH_ASSOC);

        if ($dados) {
            $quantidade_atual = $dados['quantidade'];

            // Verificar se a quantidade baixada é menor ou igual à disponível
            if ($quantidade_baixada <= $quantidade_atual) {
                // Subtrair a quantidade baixada do estoque
                $nova_quantidade = $quantidade_atual - $quantidade_baixada;

                // Atualizar a quantidade no banco de dados
                $cmd = $pdo->prepare("UPDATE produtos SET quantidade = :nova_quantidade WHERE id = :id_produto");
                $cmd->bindValue(":nova_quantidade", $nova_quantidade);
                $cmd->bindValue(":id_produto", $id_produto);
                $cmd->execute();

                // Inserir na tabela baixa
                $insert_cmd = $pdo->prepare("INSERT INTO baixa (id_usuario, id_produto, quantidade, data_hora) VALUES (:id_usuario, :id_produto, :quantidade_baixada, NOW())");
                $insert_cmd->bindValue(":id_usuario", $id_usuario);
                $insert_cmd->bindValue(":id_produto", $id_produto);
                $insert_cmd->bindValue(":quantidade_baixada", $quantidade_baixada);
                $insert_cmd->execute();

                echo "<div class='alert alert-success'>Quantidade atualizada e registro de baixa criado com sucesso!</div>";
            } else {
                echo "<div class='alert alert-danger'>Erro: A quantidade solicitada excede o estoque disponível!</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Erro: Produto não encontrado.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Por favor, preencha todos os campos.</div>";
    }
}

      ?>

     
  </body>
</html>
