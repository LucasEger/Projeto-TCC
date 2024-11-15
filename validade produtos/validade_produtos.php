<?php
       session_start();
       if(!isset($_SESSION['id']))
       {
           header("location: ../Tela Principal/inicio.php");
           exit;
       }    
         
 
include ("../classes/conexao.php");
require_once "../classes/baixa.php";
$p = new Baixa("projeto_tcc", "localhost", "root", "");


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

                <div id="icone1">
                  <a href="../validade produtos/cadastrar_baixa.php"><img src="../imagens/adicionar2.png" width="80"; height="80"></a>
                </div>
        </nav>



          
      <div id=nomeprodutos>
          <h1>Saída Estoque</h1>
      </div>

  <section id="tabela_nova2" class="table table-hover"> 
    <table id="tabela_nova3">
          <tr id="titulo">
              <th>Código</th>
              <th>Nome do Usuário</th>
              <th>Data e Hora</th>
              <th>Código do produto</th>
              <th>Produto</th>
              <th>Quantidade baixada</th>
          </tr>

         
          <?php
              $dados = $p->buscarDados();
              if (count($dados) > 0) {
                  for ($i = 0; $i < count($dados); $i++) {
                      echo "<tr id='conteudo'>";
                      foreach ($dados[$i] as $k => $v) {
                          if ($k == 'data_hora') { 
                            
                              $v = date('d/m/Y H:i', strtotime($v));
                          }
                          echo "<td>" . htmlspecialchars($v) . "</td>";
                      }
                      echo "</tr>";
                  }
              }
          ?>

</table>
      <script src="http://localhost/Projeto%20TCC/_js/paginacao.js"></script>
  </section>



        <div class="botao_sair">
          <a href="../logout.php">Sair</a>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  </body>
</html>