<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto_tcc";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$requestData = $_REQUEST;

$columns = array(
    0 => 'id',
    1 => 'nome',
    2 => 'validade',
    3 => 'quantidade',
    4 => 'peso',
    5 => 'preco_venda',
    6 => 'custo',
    7 => 'total_preco_venda',  
    8 => 'total_custo'  
);


$result_user = "SELECT id, nome, validade, quantidade, REPLACE(peso, '.', ',') AS peso, preco_venda, custo FROM produtos";
$resultado_user = mysqli_query($conn, $result_user);
$qnt_linhas = mysqli_num_rows($resultado_user);


$result_usuarios = "SELECT id, nome, validade, quantidade, REPLACE(peso, '.', ',') AS peso, preco_venda, custo, 
                    (preco_venda * quantidade) AS total_preco_venda, 
                    (custo * quantidade) AS total_custo 
                    FROM produtos WHERE 1=1";


if (!empty($requestData['search']['value'])) {
    $result_usuarios .= " AND (nome LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios .= "OR DATE_FORMAT(validade, '%d/%m/%Y') LIKE '".$requestData['search']['value']."%' ";
    $result_usuarios .= "OR quantidade LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios .= "OR REPLACE(peso, '.', ',') LIKE '".$requestData['search']['value']."%' ";
    $result_usuarios .= "OR preco_venda LIKE '".$requestData['search']['value']."%' ";
    $result_usuarios .= "OR custo LIKE '".$requestData['search']['value']."%' ";
    $result_usuarios .= "OR (preco_venda * quantidade) LIKE '".$requestData['search']['value']."%' ";
    $result_usuarios .= "OR (custo * quantidade) LIKE '".$requestData['search']['value']."%') ";
}


$resultado_usuarios = mysqli_query($conn, $result_usuarios);
$totalFiltered = mysqli_num_rows($resultado_usuarios);


$orderColumn = $columns[$requestData['order'][0]['column']];
$orderDirection = $requestData['order'][0]['dir']; 


if ($orderColumn == 'preco_venda' || $orderColumn == 'custo' || $orderColumn == 'total_preco_venda' || $orderColumn == 'total_custo') {
    $orderColumn = "CAST($orderColumn AS DECIMAL(10, 2))";
}

$result_usuarios .= " ORDER BY $orderColumn $orderDirection LIMIT ".$requestData['start'].", ".$requestData['length'];
$resultado_usuarios = mysqli_query($conn, $result_usuarios);


$dados = array();
while ($row_usuarios = mysqli_fetch_array($resultado_usuarios)) {
    $dado = array();
    $dado[] = $row_usuarios["id"];
    $dado[] = $row_usuarios["nome"];
    $dado[] = date("d/m/Y", strtotime($row_usuarios["validade"]));
    $dado[] = $row_usuarios["quantidade"];
    $dado[] = $row_usuarios["peso"];
    $dado[] = number_format($row_usuarios["preco_venda"], 2, ',', '.');
    $dado[] = number_format($row_usuarios["custo"], 2, ',', '.');
    $dado[] = number_format($row_usuarios["total_preco_venda"], 2, ',', '.');
    $dado[] = number_format($row_usuarios["total_custo"], 2, ',', '.');

	
    $dados[] = $dado;
}


$json_data = array(
    "draw" => intval($requestData['draw']),
    "recordsTotal" => intval($qnt_linhas),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $dados
);


echo json_encode($json_data);
