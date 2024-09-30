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
		$cmd = $pdo->query("SELECT baixa.id as id_baixa, login2.nome, baixa.data_hora, produtos.id, produtos.nome as produto_nome, baixa.quantidade FROM baixa LEFT JOIN login2 ON login2.id = baixa.id_usuario LEFT JOIN produtos ON produtos.id = baixa.id_produto;");

		$res = $cmd->fetchAll(PDO::FETCH_ASSOC);
		
		return $res;


	}

    public function cadastrar($nome, $validade, $quantidade, $peso)
    {
    
        global $pdo;
		//verificar se já existe o produto cadastrado
		$sql = $pdo->prepare("SELECT id FROM produtos WHERE nome = :n");
		$sql->bindValue(":n",$nome);
		$sql->execute();
        if($sql->rowCount() > 0)
        {
            return FALSE; //já está cadastradado
        }
        else
        {
            //caso não, cadastrar
            $sql = $pdo->prepare("INSERT INTO produtos (nome, validade, quantidade, peso) VALUES (:n, :v, :q, :p)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":v",$validade);
            $sql->bindValue(":q",$quantidade);
            $sql->bindValue(":p",$peso);
            $sql->execute();
            return TRUE;
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
		//verificar se já existe o email cadastrado
		$sql = $pdo->prepare("SELECT * FROM produtos order by validade asc");
		$sql->bindValue(":v",$validade);
		$sql->execute();
        if($sql->rowCount() > 0)
        {
			$sql = $pdo->prepare("UPDATE FROM produtos (validade) VALUES (:v)");
            $sql->bindValue(":v",$validade);
            $sql->execute();



            return FALSE; //já está cadastradado
        }
        else
        {
            //caso não, cadastrar
           
            return TRUE;
        }
    }

	public function buscarDadosProduto($id)
	{	
		global $pdo;



		$res = array();
		$cmd = $pdo->prepare("SELECT nome, validade, quantidade, peso FROM produtos WHERE id = :id");
		$cmd->bindValue(":id",$id);
		$cmd->execute();
		$res = $cmd->fetch(PDO::FETCH_ASSOC);

		$res['validade'] = date('d/m/Y', strtotime($res['validade']));

		return $res;
	}

	public function atualizarDadosProduto($id, $nome, $validade, $quantidade, $peso)
	{
		global $pdo;

		$peso = str_replace(',', '.', $peso);

		$cmd = $pdo->prepare("UPDATE produtos SET nome = :n, validade = :v, quantidade = :q, peso = :p WHERE id = :id");

		$cmd->bindValue(":n",$nome);
		$cmd->bindValue(":v",$validade);
		$cmd->bindValue(":q",$quantidade);
		$cmd->bindValue(":p",$peso);
		$cmd->bindValue(":id",$id);
		$cmd->execute();
	}


    
   
}



?>