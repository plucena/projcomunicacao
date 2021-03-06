<?php
include '../model/conexao.php';

class usuario {
	private $id;
	private $nome;
	private $usuario;
	private $senha;
	private $nivel;
	private $flgativo;

	function _construct() {
		$this->id = "";
		$this->nome = "";
		$this->usuario = "";
		$this->senha  = "";
		$this->nivel = "";
		$this->flgativo = "";
	}

	//metodos Gets
	public function getId($id){
		return $this->id = $id;
	}
	public function getNome($nome){
		return $this->nome = $nome;
	}
	public function getUsuario($usuario){
		return $this->usuario = $usuario;
	}
	public function getSenha($senha){
		return $this->senha = $senha;
	}
	public function getNivel($nivel){
		return $this->nivel = $nivel;
	}
	public function getFlgativo($flgativo){
		return $this->flgativo = $flgativo;
	}

	//metodos Sets
	public function setId($id){
		return $this->id = $id;
	}
	public function setNome($nome){
		return $this->nome = $nome;
	}
	public function setUsuario($usuario){
		return $this->usuario = $usuario;
	}
	public function setSenha($senha){
		return $this->senha = $senha;
	}
	public function setNivel($nivel){
		return $this->nivel = $nivel;
	}
	public function setFlgativo($flgativo){
		return $this->flgativo = $flgativo;
	}

	function verificaExistente($pdo,$usuario){
		$conn = $pdo->prepare("SELECT `usuario` FROM `usuario`
			WHERE `usuario` = :usuario AND `flgativo` = :flgativo LIMIT 1");
		$conn->bindParam(":usuario",$usuario, PDO::PARAM_STR);
		$flgativo=1;
		$conn->bindParam(":flgativo", $flgativo, PDO::PARAM_INT);
		$conn->execute();
		return $conn->fetch(PDO::FETCH_ASSOC);
	}
	function listaprofessores($pdo){
		$conn = $pdo->prepare("SELECT * FROM usuario WHERE flgativo = 1 AND nivel = 2 ORDER BY usuario ASC");
		$conn->execute();
		return $conn->fetchAll();
	}
	function registrarProfessor($pdo,$nome, $usuario, $senha,
	$nivel, $flgativo){
		try{
			$tb = $pdo->prepare("INSERT INTO usuario (nome, usuario, senha, nivel, flgativo)
			VALUES( :nome, :usuario, :senha, :nivel, :flgativo)");

			$tb->bindParam(":nome",$nome,PDO::PARAM_STR);
			$tb->bindParam(":usuario",$usuario,PDO::PARAM_STR);
			$tb->bindParam(":senha",$senha,PDO::PARAM_STR);
			$tb->bindParam(":nivel",$nivel,PDO::PARAM_INT);
			$tb->bindParam(":flgativo",$flgativo,PDO::PARAM_INT);

			if($tb->execute()){
				echo "<script>
				alert('Professor Cadastrado!');
				window.location='cadastro-professor.php';
				</script>";
			}else {
				echo "ERRO, usuário não cadastrado: ";
			}
			$tb=null;
		}catch (PDOException $e ) {
			echo 'Erro ao cadastrar usuario: ' . $e->getMessage();
		}
	}

	function excluiProfessorById($pdo,$usuarioid){
		$tb = $pdo->prepare("UPDATE usuario SET flgativo = 0 WHERE id = :id");
		$tb->bindParam(":id", $usuarioid, PDO::PARAM_INT);
			if($tb->execute()){
				echo "<script>window.location='visualizaprofessores.php'</script>";
			}else{
				echo "ERRO, USUARIO NAO EXCLUIDO";
			}
	}

	function alterarsenha($pdo,$usuarioid,$senhanova){
		$tb = $pdo->prepare("UPDATE usuario SET senha = :senhanova WHERE id = :id ");

		$tb->bindParam(":senhanova", $senhanova, PDO::PARAM_STR);
		$tb->bindParam(":id",$usuarioid, PDO::PARAM_INT);

		if($tb->execute()){
			echo "<script>
			alert('Senha Alterada com Sucesso!');
			window.location='index.php';
			</script>";
		}else{
			echo "ERRO, SENHA NÃO ALTERADA";
		}
	}

}
?>
