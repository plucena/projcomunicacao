<?php


include('../classes/class_disciplina.php');
include('../classes/class_questao.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de questões</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
		<form id="questcad" action="cadastraquestoes.php" method="post">
			<label for="disciplina">Disciplina: </label>
			<select required="" name="disciplina" id="disciplina" >
			<?php

			$x = new disciplina();
			$retorno = $x->selectAtivo($PDO);
			foreach ($retorno as $key) {

			?>
			<option value="<?php echo $key['id'];?>" >
        <?php echo $key['nome']." - ".$key['habilitacao']." - ".$key['turno'];?>
      </option>
			<?php
		}
		?>
			</select><br/>
			<p>Enunciado da Questão:</p>
			<textarea required="" name="titulo" id="titulo" rows="10" cols="40">Enunciado da Questão</textarea> <br/>
			<label for="resp1">Alternativa 1:</label>
			<input required="" type="text" name="resp1"> <br/>
			<label for="resp2">Alternativa 2:</label>
			<input required="" type="text" name="resp2"> <br/>
			<label for="resp3">Alternativa 3:</label>
			<input required="" type="text" name="resp3"> <br/>
			<label for="resp4">Alternativa 4:</label>
			<input required="" type="text" name="resp4"> <br/>
			<label for="resp5">Alternativa 5:</label>
			<input required="" type="text" name="resp5"> <br/>
			<label for="respcorreta"><h3>Alternativa Correta</h3></label>
			<select required="" name="respcorreta" id="respcorreta">
				<option value="A">A</option>
				<option value="B">B</option>
				<option value="C">C</option>
				<option value="D">D</option>
				<option value="E">E</option>

			</select> <br/>
			<input type="submit" name="envia">
		</form>




<?php


if(isset($_POST['envia'])){

		$disciplina = $_POST['disciplina'];
		$titulo = $_POST['titulo'];
		$resp1 = $_POST['resp1'];
		$resp2 = $_POST['resp2'];
		$resp3 = $_POST['resp3'];
		$resp4 = $_POST['resp4'];
		$resp5 = $_POST['resp5'];
		$respcorreta = $_POST['respcorreta'];

		$x = new questao();
		$cadastraquestao = $x->registrarQuestoes($PDO,$disciplina, $titulo, $resp1, $resp2, $resp3, $resp4, $resp5, $respcorreta);
}



?>

</body>
</html>
