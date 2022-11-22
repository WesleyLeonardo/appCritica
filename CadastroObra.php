<!--cria um formulário para cadastrar uma obra, com nome e tipo-->

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Cadastro de Obra</title>
    <link rel="stylesheet" type="text/css" href="appStyle.css">

</head>
<body>

        <form action="CadastroObra.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome">
            &nbsp;
            <br>

            <label for="tipo">Tipo:</label>
            <input type="text" name="tipo" id="tipo">
            <br>
            <input class="botao" type="submit" value="Cadastrar">
        </form>

        <?php
            include 'Conexao.php';
            if(isset($_POST['nome']) && isset($_POST['tipo'])){
                $nome = $_POST['nome'];
                $tipo = $_POST['tipo'];
                insereObra($nome, $tipo);
                header("Location: Inicio.php");
            }
        ?>

</body>
</html>
