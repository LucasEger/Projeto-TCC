<?php
Class Usuario
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

	//FUNÇÃO DE BUSCAR DADOS E PREECHER TABELA
	public function buscarDados ()
	{
		global $pdo;

		$res = array();
		$cmd = $pdo->query("SELECT id, nome, email FROM login2 ORDER BY id DESC");

		$res = $cmd->fetchAll(PDO::FETCH_ASSOC);
		return $res;


	}

    public function cadastrar($nome, $email,$senha)
    {
        global $pdo;
		//verificar se já existe o email cadastrado
		$sql = $pdo->prepare("SELECT id FROM login2 WHERE email = :e");
		$sql->bindValue(":e",$email);
		$sql->execute();
        if($sql->rowCount() > 0)
        {
            return FALSE; //já está cadastradado
        }
        else
        {
            //caso não, cadastrar
            $sql = $pdo->prepare("INSERT INTO login2 (Nome, Email, Senha) VALUES (:n, :e, :s)");
            $sql->bindValue(":n",$nome);
			$sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            return TRUE;
        }
	}
	
	public function excluir_usuario($id)
    {
        global $pdo;
		$cmd = $pdo->prepare("DELETE FROM login2 WHERE id = :id");
		$cmd->bindValue(":id",$id);
		$cmd->execute();
	}
	



	public function logar($email, $senha)
	{
		global $pdo;
		// Verificar se o email e senha estão cadastrados, se sim
		$sql = $pdo->prepare("SELECT id FROM login2 WHERE email = :e AND Senha = :s");
		$sql->bindValue(":e", $email);
		$sql->bindValue(":s", md5($senha));
		$sql->execute();
		if ($sql->rowCount() > 0) {
			// Entrar no sistema (sessão)
			$dado = $sql->fetch();
			session_start();
			$_SESSION['id'] = $dado['id'];
			return true; // Cadastrado com sucesso
		} else {
			return false; // Não foi possível logar
		}
	}

	public function buscarDadosPessoa($id)
	{	
		global $pdo;

		$res = array();
		$cmd = $pdo->prepare("SELECT nome, email FROM login2 WHERE id = :id");
		$cmd->bindValue(":id",$id);
		$cmd->execute();
		$res = $cmd->fetch(PDO::FETCH_ASSOC);
		return $res;
	}

	public function atualizarDadosPessoa($id, $nome, $email)
	{
		global $pdo;

		$cmd = $pdo->prepare("UPDATE login2 SET nome = :n, email = :e WHERE id = :id");

		$cmd->bindValue(":n",$nome);
		$cmd->bindValue(":e",$email);
		$cmd->bindValue(":id",$id);
		$cmd->execute();
	}



}



?>