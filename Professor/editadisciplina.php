<?php 
include('../classes/class_disciplina.php');
include('verifica_sessao_professor.php');
$iddisciplina = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Editar Disciplina</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <script src="../assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	    <script src="../assets/bootstrap-3.3.7-dist/js/newjs.js"></script>
	      <link rel="stylesheet" href="../assets/css/normalize.css">
	      <link rel="stylesheet" href="../assets/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	 	<meta name="viewport" content="width=device-width, initial-scale=1">
	      <link rel="stylesheet" href="../assets/bootstrap-3.3.7-dist/js/newjs.js">
	      <link rel="stylesheet" href="../assets/css/newstyle.css">
</head>

<body>
		<nav class="navbar navbar-inverse" style="border-radius:0px; background:#20205a;">

  <div class="container-fluid">
    
	      <div class="col-sm-2">
	        <a  class="navbar-brand" href="index.php"><img style="margin-top:-13px;width:70%;"  src="../assets/img/UNASP.png" alt="logo unasp"></a>
	     </div>
          
	      <div class="col-sm-3">
	        <h3 class="areadoprofessor">ÁREA DO PROFESSOR</h3>
	      </div>

    <div class="col-sm-7">
    <ul class="nav navbar-nav">
      <li ><a id="font-white" href="index.php">Home</a></li>
<li class="active"><a id="ativo" href="pre-cadastra.php">Cadastrar Questões</a></li>
    <li><a id="font-white" href="pre_relatorio.php"> Relatórios de Notas</a></li>
      <li><a id="font-white" href="listadisciplinas.php">Editar/Visualizar Questões</a></li>
	        <li><a id="font-white" href="alterarsenha.php">Alterar Senha</a></li>
	        <li><a id="font-white" href="../logout.php">Logout</a></li>
    </ul>
  </div>

  </div>
</nav>

<div id="wrap">
<legend class="text-center">ALTERE O SEMESTRE,CURSO OU TURNO DA DISCIPLINA SELECIONADA</legend>
          
	<form class="form-horizontal" method="post" action="editadisciplina.php">
		<fieldset>
		<div class="form-group">
		<label class="col-md-5 control-label" for="semestre">Semestre:</label>
		<div class="col-md-5">
		<input type="hidden" name="iddisciplina" value="<?php echo $iddisciplina;?>">
			<select required="" name="semestre" id="semestre">
					<option value="">Selecione o Semestre</option>
					<option value="1">1º Semestre</option>
					<option value="2">2º Semestre</option>
					<option value="3">3º Semestre</option>
					<option value="4">4º Semestre</option>
					<option value="5">5º Semestre</option>
					<option value="6">6º Semestre</option>
					<option value="7">7º Semestre</option>
					<option value="8">8º Semestre</option>
			</select>
			</div>
			</div>

				<div class="form-group">
					<label class="col-md-5 control-label" for="curso">Curso:</label>
				<div class="col-md-5">
					<select required="" name="curso" id="curso">
						<option value="">Selecione o Curso</option>
						<option value="PP">PP</option>
						<option value="RTV">RTV</option>
					</select>
				</div>
				</div>

				<div class="form-group">
					<label class="col-md-5 control-label" for="turno">Turno:</label>
				<div class="col-md-5">
			<select required="" name="turno" id="turno">
					<option value="">Selecione o Turno</option>
					<option value="Diurno">Diurno</option>
					<option value="Noturno">Noturno</option>
			</select>
				</div>
				</div>
	<!-- Button -->
	<div class="form-group">
	  <label class="col-md-5 control-label" for="singlebutton"></label>
	  <div class="col-md-5">
	    <input style="font-size:13pt;" name="envia" type="submit" class="btn btn-primary"></input>
	  </div>
	</div>

	</fieldset>	
	</form>
	</div>
	
<div id="push">
</div>
    <div id="footer">
      <div class="container">
        <p class="muted credit"> Unasp - Centro Universitário Adventista de São Paulo - © 2016 - Todos os direitos reservados.</a></p>
      </div>
    </div>
</body>
</html>

<?php 

if(isset($_POST['envia'])){
	$iddisciplina = $_POST['iddisciplina'];
	$semestre = $_POST['semestre'];
	$curso = $_POST['curso'];
	$turno = $_POST['turno'];

	$x = new disciplina();
	$x->editaDisciplinaByID($PDO,$iddisciplina,$semestre,$curso,$turno);
}
?>