<?php
Class Produto
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

	public function buscarProdutos ()
{
    global $pdo;

    $res = array();
    $cmd = $pdo->query("SELECT id, nome FROM produtos");
    $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
    
    return $res;
}

    public function buscarDados ()
	{
		global $pdo;

		$res = array();
		$cmd = $pdo->query("SELECT * FROM produtos ORDER BY id DESC");

		$res = $cmd->fetchAll(PDO::FETCH_ASSOC);
		
		return $res;


	}
	public function cadastrar($nome, $validade, $quantidade, $peso, $preco_venda, $custo)
	{
		global $pdo;
		
		
		$sql = $pdo->prepare("SELECT id FROM produtos WHERE nome = :n");
		$sql->bindValue(":n", $nome);
		$sql->execute();
		
		if ($sql->rowCount() > 0) {
			return FALSE; 
		} else {
		
			try {
				$sql = $pdo->prepare("INSERT INTO produtos (nome, validade, quantidade, peso, preco_venda, custo) 
									  VALUES (:n, :v, :q, :p, :pv, :cs)");

				$sql->bindValue(":n", $nome);
				$sql->bindValue(":v", $validade);
				$sql->bindValue(":q", $quantidade);
				$sql->bindValue(":p", $peso);
				$sql->bindValue(":pv", $preco_venda);
				$sql->bindValue(":cs", $custo);
		
				if ($sql->execute()) {
					return TRUE;
				} else {
					throw new Exception("Erro ao executar a consulta SQL.");
				}
			} catch (Exception $e) {
		
				echo "Erro: " . $e->getMessage();
				return FALSE;
			}
		}
	}
	
	public function excluir_produto($id)
    {
        global $pdo;
		$cmd = $pdo->prepare("DELETE FROM produtos WHERE id = :id");
		$cmd->bindValue(":id",$id);
		$cmd->execute();
	}
	

	public function ordenar($validade)
    {
        global $pdo;
		
		$sql = $pdo->prepare("SELECT * FROM produtos order by validade asc");
		$sql->bindValue(":v",$validade);
		$sql->execute();
        if($sql->rowCount() > 0)
        {
			$sql = $pdo->prepare("UPDATE FROM produtos (validade) VALUES (:v)");
            $sql->bindValue(":v",$validade);
            $sql->execute();



            return FALSE; 
        }
        else
        {
           
           
            return TRUE;
        }
    }

	public function buscarDadosProduto($id)
	{	
		global $pdo;



		$res = array();
		$cmd = $pdo->prepare("SELECT nome, validade, quantidade, peso, preco_venda, custo FROM produtos WHERE id = :id");
		$cmd->bindValue(":id",$id);
		$cmd->execute();
		$res = $cmd->fetch(PDO::FETCH_ASSOC);

		if ($res && isset($res['validade'])) {
			$res['validade'] = date('Y-m-d', strtotime($res['validade']));
		}

		return $res;
	}

	public function atualizarDadosProduto($id, $nome, $validade, $quantidade, $peso, $preco_venda, $custo) {
		global $pdo;
	

		$peso = str_replace(',', '.', $peso);
	
		try {

			$cmd = $pdo->prepare("UPDATE produtos SET nome = :n, validade = :v, quantidade = :q, peso = :p, preco_venda = :pv, custo = :cs WHERE id = :id");
	

			$cmd->bindValue(":n", $nome);
			$cmd->bindValue(":v", $validade);
			$cmd->bindValue(":q", $quantidade);
			$cmd->bindValue(":p", $peso);
			$cmd->bindValue(":pv", $preco_venda);
			$cmd->bindValue(":cs", $custo);
			$cmd->bindValue(":id", $id);
	
	
			if ($cmd->execute()) {
				echo "Dados atualizados com sucesso!";
			} else {
	
				throw new Exception("Erro na execução do comando SQL: " . implode(" ", $cmd->errorInfo()));
			}
	
		} catch (Exception $e) {

			echo "Erro: " . $e->getMessage();
		}
	}


    
   
}





?>