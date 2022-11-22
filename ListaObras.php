<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Obras</title>
    <link rel="stylesheet" type="text/css" href="appStyle.css">

</head>

<body>

<form style="padding: 30px" action="Inicio.php" method="post">
    <input type="submit" value="Voltar">
</form>

<form style="padding: 30px" action="CadastroObra.php" method="post">
    <input type="submit" value="Cadastrar Obra">
</form>


<form style="padding: 30px" action="ListaObras.php" method="post">
    <input type="text" name="nomePesquisa" placeholder="Pesquisar por nome">
    <input type="submit" value="Pesquisar">
</form>

<?php
include 'Conexao.php';

if(isset($_POST['nomePesquisa'])){
    $nomePesquisa = $_POST['nomePesquisa'];
    listaObrasPorNomeOuTipo($nomePesquisa);
}else{
    listaObras();
}
?>

</body>
</html>
