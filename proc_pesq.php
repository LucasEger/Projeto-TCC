<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto_tcc";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$requestData= $_REQUEST;
// INDICE DA COLUNA NA TABELA VISUALIZAR RESULTADO => mp,e d coluna no banco de dados
$columns = array(
    0 => 'id',
    1 => 'nome',
    2 => 'validade',
    3 => 'quantidade',
    4 => 'peso'
);

// Obtenho registros de número total sem quaquer pesquisa
$result_user = "SELECT id, nome, validade, quantidade, REPLACE(peso, '.', ',') AS peso FROM produtos";
$resultado_user =mysqli_query($conn, $result_user);
$qnt_linhas = mysqli_num_rows($resultado_user);

//Obter os dados a serem apresentados
$result_usuarios = "SELECT id, nome, validade, quantidade, REPLACE(peso, '.', ',') AS peso FROM produtos WHERE 1=1";
	if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
		$result_usuarios.=" AND ( nome LIKE '".$requestData['search']['value']."%' ";    
	$result_usuarios.=" OR quantidade LIKE '".$requestData['search']['value']."%') ";
}

$resultado_usuarios=mysqli_query($conn, $result_usuarios);
$totalFiltered = mysqli_num_rows($resultado_usuarios);
//Ordenar o resultado
$result_usuarios.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$resultado_usuarios=mysqli_query($conn, $result_usuarios);
// Ler e criar o array de dados
$dados = array();
while( $row_usuarios =mysqli_fetch_array($resultado_usuarios) ) {  
	$dado = array(); 
	$dado[] = $row_usuarios["id"];
	$dado[] = $row_usuarios["nome"];
	$dado[] = date("d/m/Y", strtotime($row_usuarios["validade"]));
    $dado[] = $row_usuarios["quantidade"];
    $dado[] = $row_usuarios["peso"];	
	$dados[] = $dado;
}

//Cria o array de informações a serem retornadas para o Javascript
$json_data = array(
	"draw" => intval( $requestData['draw'] ),
	"recordsTotal" => intval( $qnt_linhas ), 
	"recordsFiltered" => intval( $totalFiltered ), 
	"data" => $dados  
);

echo json_encode($json_data);  
