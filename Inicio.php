<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" type="text/css" href="appStyle.css">


</head>
<body>


<form action="CadastroObra.php" method="post">
    <input type="submit" value="Cadastrar Obra">
</form>

<form action="ListaObras.php" method="post">
    <input type="submit" value="Listar Obras">
</form>

<h1>10 últimas críticas!</h1>

<?php
include 'Conexao.php';
mostraCriticas();
?>


</body>
</html>






