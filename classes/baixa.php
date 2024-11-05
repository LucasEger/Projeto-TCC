<?php
Class Baixa
{
	private $pdo;
	public $msgErro = "";//tudo ok

	public function __construct ($nome, $host, $senha, $usuario)
	{
		global $pdo;
		try 
		{
			$pdo = new PDO("mysql:dbname=".$nome.";host=".$host.";charset=utf8", $senha,$usuario);
		} catch (PDOException $e) {
			echo "Erro com banco de dados: ".$e->getMessage()
			;
			exit();
		}
		catch (Exception $e) {
			echo "Erro generico: ".$e->getMessage()
			;
			exit();
		}

		
	}

    public function buscarDados ()
	{
		global $pdo;

		$res = array();
		$cmd = $pdo->query("SELECT baixa.id as id_baixa, login2.nome, baixa.data_hora, produtos.id, produtos.nome as produto_nome, baixa.quantidade FROM baixa LEFT JOIN login2 ON login2.id = baixa.id_usuario LEFT JOIN produtos ON produtos.id = baixa.id_produto ORDER BY baixa.id DESC;");

		$res = $cmd->fetchAll(PDO::FETCH_ASSOC);
		
		return $res;


	}


    
   
}



?>