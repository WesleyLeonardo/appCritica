<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Review</title>
    <link rel="stylesheet" type="text/css" href="appStyle.css">

</head>
<body>

<?php
$idObra = $_GET['idObra'];
?>

<form method='post'>

    <input type="text" name="nomeUser" placeholder="Nome do User">
    &nbsp;
    <input type="text" name="nota" placeholder="Nota">
    &nbsp;
    <textarea class="caixa" name="texto" placeholder="Review"></textarea>
    <input type="hidden" name="idObra" value="<?php echo $idObra; ?>">
    <input class="botao" type="submit" name="enviar" value="Enviar">
</form>

<?php
include 'Conexao.php';
if (isset($_POST['enviar'])) {
    $nomeUser = $_POST['nomeUser'];
    $nota = $_POST['nota'];
    $texto = $_POST['texto'];
    $idObra = $_POST['idObra'];
    insereCritica($nomeUser, $nota, $texto, $idObra);
    header("Location: Critica.php?idObra=$idObra");
}
?>

<?php
mostraCriticasById($idObra);
?>


</body>
</html>
