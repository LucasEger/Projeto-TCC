<?php
    session_start();
if(!isset($_SESSION['id']))
{
    header("location: ../Tela Principal/inicio.php");
    exit;
}    

?>

<html lang="pt-br">
<head>

            <meta charset="UTF-8">
            <title>Controle de estoque</title>
             <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" type="text/css" href="../_css/estilo.css">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		        <script type="text/javascript" language="javascript">
               $(document).ready(function() {
			          $('#listar-usuario').DataTable({
                  language: {
                    lengthMenu: 'Mostrando _MENU_ registros por página',
                    zeroRecords: 'Nada encontrado',
                    info: 'Mostrando página _PAGE_ de _PAGES_',
                    infoEmpty: 'Nenhum registro disponível',
                    infoFiltered: '(filtrado de _MAX_ registros no total)',
                    sSearch: "Pesquisar",
                    oPaginate: {
                    sNext: "Próximo",
                    sPrevious: "Anterior",
                    sFirst: "Primeiro",
                    sLast: "Último"
                },
                        },			
				          "processing": true,
				          "serverSide": true,
				          "ajax": {
					            "url": "http://localhost/projeto%20TCC/proc_pesq.php",
					            "type": "POST"
				                  }
			                                    });
		                                        } );
          </script>
    </head>

  <body>
  <div id="banerprincipal">
      
    </div>
          
      
              
  <nav id="menu">
            <h1>Menu Principal</h1>
                <ul type= "disc">
                    <li><a href="../gerenciar produtos/gerenciar.php">Gerenciar Produtos</a></li>
                    <li><a href="../validade produtos/validade_produtos.php">Baixar Estoque</a></li>
                    <li><a href="../relatorios/relatorios.php">Relatórios</a></li>
                    <li><a href="../Usuarios/usuarios.php">Usuários</a></li>
                </ul>
               
        </nav>

        <div id=nomeprodutos>
        <h1>Controle de Estoque</h1>
      </div>
            <div id="nomerelatorio">
            <table id="listar-usuario" class="display">
			        <thead>
                <tr>
                  <th>Código</th>
                  <th>Nome</th>
                  <th>Validade</th>
                  <th>Quantidade</th>
                  <th>Peso Kg</th>
                </tr>
			        </thead>
		        </table>	
      </div>
     
            
          
	     
               
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        


        <div class="botao_sair">
          <a href="../logout.php">Sair</a>
        </div>
  </body>
</html>


