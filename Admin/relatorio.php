<?php
include('verifica_sessao_admin.php');
?>

<!DOCTYPE html>

<head>
    <title>Área do Administrador</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="../assets/img/UNASP.png" alt="logo unasp">
        </div>

        <header id="cabecalho">
            <hgroup>
                <h1>RELATÓRIOS</h1>
            </hgroup>
        </header>

        <nav id="menu">
            <h1>Gerar relatorios</h1>
            <ul type="disc">
                 <li><a href="index.php">MENU</a></li>
                 <li><a href="cadastro-disciplina.php">Cadastrar Disciplina</a></li>
                 <li><a href="cadastro-professor.php">Cadastrar Professor</a></li>
            </ul>

             <ul id="logout" type="disc">
                 <li><a href="../logout.php">Logout</a></li>
            </ul>
        </nav>
        
        <hgroup>
            <a href="../classes/class_relatorio_teste.php">
               <img src="../assets/img/pdf.png" height="60" width="60" alt="" style=" margin-top: 5%;">
            </a>
        </hgroup>
        <!--nav style="margin-left:630px; margin-top:10px;">
            <a href="../classes/class_relatorio_teste.php"></a>
        </nav-->

        

        <footer id="rodape">
            <p><b>Copyright&copy; 2016 - by Ana Carla Moraes, Diogo Lopes, Gabriel Tagliari, Matheus Hofart, Wesley R. Silva.<b>
        </footer>
    </div>
</body>
</html>
