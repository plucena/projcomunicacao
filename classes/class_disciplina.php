<?php
require_once('../model/conexao.php');

class disciplina {
	private $iditemdisciplina;
	private $nome;
	private $curso;
	private $turno;
	private $credito;
	private $flgativo;

	function _construct() {
		$this->iditemdisciplina= "";
		$this->nome = "";
		$this->curso = "";
		$this->turno = "";
		$this->credito = "";
		$this->flgativo = "";
	}

	//metodos Gets
	public function getIditemdisciplina($iditemdisciplina){
		return $this->iditemdisciplina = $iditemdisciplina;
	}
	public function getNome($nome){
		return $this->nome = $nome;
	}
	public function getCurso($curso){
		return $this->curso = $curso;
	}
	public function getTurno($turno){
		return $this->turno = $turno;
	}
	public function getCredito($credito){
		return $this->credito = $credito;
	}
	public function getFlgativo($flgativo){
		return $this->flgativo = $flgativo;
	}

	//metodos Sets
	public function setIditemdisciplina($iditemdisciplina){
		return $this->iditemdisciplina = $iditemdisciplina;
	}
	public function setNome($nome){
		return $this->nome = $nome;
	}
	public function setCurso($curso){
		return $this->curso = $curso;
	}
	public function setTurno($turno){
		return $this->turno = $turno;
	}
	public function setCredito($credito){
		return $this->credito = $credito;
	}
	public function setFlgativo($flgativo){
		return $this->flgativo = $flgativo;
	}

	function insereDataDisciplina($pdo,$curso,$turno,$semestre,$datainicio,$datafim){

		$conn = $pdo->prepare("UPDATE disciplina SET dataprovainicio=:datainicio, dataprovafim=:datafim
		 WHERE
			curso=:curso AND
			turno=:turno AND
			semestre=:semestre");
		$conn->bindParam(":datainicio",$datainicio,PDO::PARAM_STR);
		$conn->bindParam(":datafim",$datafim,PDO::PARAM_STR);
		$conn->bindParam(":curso",$curso,PDO::PARAM_STR);
		$conn->bindParam(":turno",$turno,PDO::PARAM_STR);
		$conn->bindParam(":semestre",$semestre,PDO::PARAM_STR);

		if($conn->execute()){
			echo "<script>
				alert('Prova Liberada!');
				window.location='index.php';
				</script>";
			}else{
				echo "<script> alert('ERRO INSERE DATA');</script>";
			}
			$conn=null;


	}

	function editaDisciplinaByID($pdo,$iddisciplina,$nome,$semestre,$curso,$turno,$credito){
		$conn = $pdo->prepare("UPDATE itemdisciplina
			SET curso = :curso,
			nome = :nome,
			turno = :turno,
			semestre = :semestre,
			credito = :credito
			WHERE iditemdisciplina=:id");

			$conn->bindParam(":curso",$curso,PDO::PARAM_STR);
			$conn->bindParam(":nome",$nome,PDO::PARAM_STR);
			$conn->bindParam(":turno",$turno,PDO::PARAM_STR);
			$conn->bindParam(":semestre",$semestre,PDO::PARAM_STR);
			$conn->bindParam(":credito",$credito,PDO::PARAM_INT);
			$conn->bindParam(":id",$iddisciplina,PDO::PARAM_INT);

			if($conn->execute()){
				echo "<script>
				alert('Disciplina Alterada com Sucesso!');
				window.location='visualizadisciplinas.php';
				</script>";
			}else{
				echo "<script> alert('ERRO CADASTRO DISCIPLINA');</script>";
			}
			$conn=null;
		}

		function selectAtivo($pdo,$curso,$turno,$semestre){
			$conn = $pdo->prepare("SELECT * FROM itemdisciplina
				WHERE curso=:curso AND turno=:turno AND semestre=:semestre");

				$conn->bindParam(":curso",$curso,PDO::PARAM_STR);
				$conn->bindParam(":turno",$turno,PDO::PARAM_STR);
				$conn->bindParam(":semestre",$semestre,PDO::PARAM_INT);
				$conn->execute();
				return $conn->fetchAll(PDO::FETCH_ASSOC);
				$conn=null;
		}

		function selectDisciplinaByProfessor($pdo, $id){
			$conn = $pdo->prepare("SELECT * FROM disciplina
				WHERE idusuario=:id AND flgativo=1 ORDER BY nome ASC");
				$conn->bindParam(":id",$id,PDO::PARAM_INT);

				$conn->execute();
				return $conn->fetchAll(PDO::FETCH_ASSOC);
		}

		function selectDisciplinaByAluno($pdo, $curso, $turno, $semestre,$dataprova){
			$conn = $pdo->prepare("SELECT D.id, D.nome as 'nomedisciplina', D.curso, D.turno,
				D.semestre, P.nome as 'nomeprofessor'
				FROM disciplina D	INNER JOIN usuario P
				ON D.idusuario = P.id
				WHERE D.flgativo = 1
				AND :dataprova BETWEEN D.dataprovainicio AND D.dataprovafim
				AND D.curso = :curso
				AND D.turno = :turno
				AND D.semestre = :semestre");

				$conn->bindParam(":dataprova",$dataprova,PDO::PARAM_STR);
				$conn->bindParam(":curso",$curso,PDO::PARAM_STR);
				$conn->bindParam(":turno",$turno,PDO::PARAM_STR);
				$conn->bindParam(":semestre",$semestre,PDO::PARAM_INT);
				$conn->execute();
				return $conn->fetchAll(PDO::FETCH_ASSOC);
				$conn=null;
		}

		function selectNomeDisciplinaById($pdo, $id){
			$conn = $pdo->prepare("SELECT nome FROM disciplina
				WHERE id= :id");
				$conn->bindParam(":id",$id,PDO::PARAM_INT);

				if($conn->execute()){
					return $conn->fetchColumn();
				}else{
					echo "<script> alert('ERRO NOME DISCIPLINA');</script>";
				}
		}

		function selectNotasDisciplinasByIdProva($pdo, $idprova) {
            $conn = $pdo->prepare (
                "SELECT pd.iddisciplina, round(pd.notadisciplina, 1) as notadisciplina
					FROM prova_disciplina pd
					WHERE pd.idprova = :idprova
					ORDER BY pd.iddisciplina;"
            );

            $conn->bindParam(":idprova",$idprova,PDO::PARAM_INT);

            if($conn->execute()){
                return $conn->fetchAll(PDO::FETCH_ASSOC);
            }else{
                echo "<script> alert('ERRO AO BUSCAR NOTA DISCIPLINA');</script>";
            }
            $conn=null;
		}

		function selectDisciplinasByCursoTurnoAndSemestre($pdo, $curso, $turno, $semestre){

				$conn= $pdo->prepare(
					"SELECT id, nome
					FROM disciplina
					WHERE curso = :curso
					AND turno = :turno
					AND semestre = :semestre
					AND flgativo = 1"
				);

				$conn->bindParam(":curso",$curso,PDO::PARAM_STR);
				$conn->bindParam(":turno",$turno,PDO::PARAM_STR);
				$conn->bindParam(":semestre",$semestre,PDO::PARAM_INT);

				if($conn->execute()){
					return $conn->fetchAll(PDO::FETCH_ASSOC);
				}else{
					echo "<script> alert('ERRO AO ENCONTRAR DISCIPLINA');</script>";
				}
		}

		function cadastra_itemdisciplina($con, $nome, $curso, $turno, $credito, $semestre, $flgativo){
			$conn = $con->prepare("INSERT INTO itemdisciplina (nome, curso, turno, credito, semestre, flgativo)
			VALUES(:nome, :curso, :turno, :credito, :semestre, :flgativo)");

			$conn->bindParam(":nome",$nome,PDO::PARAM_STR);
			$conn->bindParam(":curso",$curso,PDO::PARAM_STR);
			$conn->bindParam(":turno",$turno,PDO::PARAM_STR);
			$conn->bindParam(":credito",$credito,PDO::PARAM_INT);
			$conn->bindParam(":semestre",$semestre,PDO::PARAM_INT);
			$conn->bindParam(":flgativo",$flgativo,PDO::PARAM_INT);

			if($conn->execute()){
				echo "<script>
				alert('Disciplina Cadastrada com Sucesso!');
				window.location='../Admin/cadastro-disciplina.php';
				</script>";
			}else{
				echo "<script> alert('ERRO CADASTRO DISCIPLINA');</script>";
			}
			$conn=null;
		}

		function verifica_disciplina_cadastrada($con,$nome, $curso, $turno, $idusuario){

			$conn= $con->prepare("SELECT id FROM disciplina WHERE nome=:nome
				AND curso=:curso AND turno=:turno
				AND idusuario=:idusuario AND flgativo=1" );

				$conn->bindParam(":nome",$nome,PDO::PARAM_STR);
				$conn->bindParam(":curso",$curso,PDO::PARAM_STR);
				$conn->bindParam(":turno",$turno,PDO::PARAM_STR);
				$conn->bindParam(":idusuario",$idusuario,PDO::PARAM_INT);

				if($conn->execute()){
					return $conn->fetchColumn();
				}else{
					echo "<script> alert('ERRO VERIFICA DISCIPLINA');</script>";
				}
		}

		function cadastra_disciplina($con,$nomedisciplina,$idusuario,$curso,$turno,$semestre){
			$conn = $con->prepare("INSERT INTO disciplina (idusuario, nome, curso, turno, semestre)
			VALUES(:idusuario,:nome, :curso, :turno, :semestre)");
			$conn->bindParam(":idusuario",$idusuario,PDO::PARAM_INT);
			$conn->bindParam(":nome",$nomedisciplina,PDO::PARAM_STR);
			$conn->bindParam(":curso",$curso,PDO::PARAM_STR);
			$conn->bindParam(":turno",$turno,PDO::PARAM_STR);
			$conn->bindParam(":semestre",$semestre,PDO::PARAM_STR);

			if($conn->execute()){
			}else{
				echo "<script> alert('ERRO CADASTRA DISCIPLINA');</script>";
			}
		}
		function excluiDisciplinaById($pdo,$id){
			$tb = $pdo->prepare("UPDATE itemdisciplina SET flgativo = 0 WHERE iditemdisciplina = :id");
			$tb->bindParam(":id", $id, PDO::PARAM_INT);
			if($tb->execute()){
				echo "<script>window.location='visualizadisciplinas.php'</script>";
			}else{
				echo "<script> alert('ERRO, DISCIPLINA NAO EXCLUIDA')</script>";
			}
		}
		function lista_itemdisciplina($pdo){
			$conn = $pdo->prepare("SELECT * FROM itemdisciplina WHERE flgativo=1 ORDER BY nome ASC");
			$conn->execute();

			return $conn->fetchAll();
		}
	}
?>
