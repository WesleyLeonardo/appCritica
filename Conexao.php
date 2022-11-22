<?php
$servername = "criticaapp.cllsvu4r1ic2.sa-east-1.rds.amazonaws.com";
$username = "root";
$password = "123456789";
$dbname = "app";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getConnection()
{
    $servername = "criticaapp.cllsvu4r1ic2.sa-east-1.rds.amazonaws.com";
    $username = "root";
    $password = "123456789";
    $dbname = "app";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}


function mostraCriticas()
{
    $conn = getConnection();
    $sql = "SELECT * FROM critica ORDER BY idcritica DESC LIMIT 10";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table><tr><th>Nome do User</th><th>Nota</th><th>Review</th><th>Obra</th></tr>";
        while ($row = $result->fetch_assoc()) {
            $idObra = $row["criticaobraid"];
            $sql2 = "SELECT nome FROM obra WHERE idobra = $idObra";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $nomeObra = $row2["nome"];
            echo "<tr><td>" . $row["nomeUser"] . "</td><td>" . $row["nota"] . "</td><td>" . $row["texto"] . "</td><td>" . $nomeObra . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Não há nenhuma crítica! Seja o primeiro a comentar, escolha uma obra e clique nela!";
    }
    $conn->close();
}


function insereCritica($nome, $nota, $texto, $obraid)
{
    global $conn;
    $sql = "INSERT INTO critica (nomeUser, nota, texto, criticaobraid) VALUES ('$nome', '$nota', '$texto', '$obraid')";
    $result = $conn->query
    ($sql);
}

function mostraCriticasById($idObra)
{
    global $conn;
    $sql = "SELECT * FROM critica WHERE criticaobraid = '$idObra'";
    $result = $conn->query
    ($sql);
    if ($result->num_rows > 0) {
        echo "<link rel='stylesheet' type='text/css' href='appStyle.css'>";
        echo "<table><tr><th>Nome</th><th>Nota</th><th>Review</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["nomeUser"] . "</td><td>" . $row["nota"] . "</td><td>" . $row["texto"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Não há críticas para essa obra. Seja o primeiro a comentar!";
    }
}

function listaObras()
{
    global $conn;
    $sql = "SELECT * FROM obra";
    $result = $conn->query
    ($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["tipo"] == "filme" || $row["tipo"] == "série" || $row["tipo"] == "Filme" || $row["tipo"] == "Série") {
            echo "<form action='Critica.php?idObra=" . $row["idobra"] . "' method='post'>
                <input type='hidden' name='criticaobraid' value='" . $row["idobra"] . "'>
                <div style='display: flex;'>
                <img src='movieIcon.png' width='20' height='20'>
                <input type='submit' value='" . $row["nome"] . " (" . $row["tipo"] . ")'>
                </div>
                </form>";
        } else if ($row["tipo"] == "livro" || $row["tipo"] == "Livro") {

            echo "<form action='Critica.php?idObra=" . $row["idobra"] . "' method='post'>
                <input type='hidden' name='criticaobraid' value='" . $row["idobra"] . "'>
                <div style='display: flex;'>
                <img src='bookIcon.png' width='20' height='20'>
                <input type='submit' value='" . $row["nome"] . " (" . $row["tipo"] . ")'>
                </div>
                </form>";

        } else {
            echo "<form action='Critica.php?idObra=" . $row["idobra"] . "' method='post'>
                <input type='hidden' name='criticaobraid' value='" . $row["idobra"] . "'>
                <div style='display: flex;'>
                <img src='othersIcon.png' width='30' height='30'>
                <input type='submit' value='" . $row["nome"] . " (" . $row["tipo"] . ")'>
               </div>
                </form>";
        }
    }
} else {
    echo "Não há obras cadastradas! Cadastra uma obra para poder criticar!";
}
}


function listaObrasPorNomeOuTipo($nome)
{
    global $conn;
    $sql = "SELECT * FROM obra WHERE nome LIKE '%$nome%' OR tipo LIKE '%$nome%'";
    if ($nome == "") {
        $sql = "SELECT * FROM obra";
    }
    $result = $conn->query
    ($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["tipo"] == "filme" || $row["tipo"] == "série" || $row["tipo"] == "Filme" || $row["tipo"] == "Série") {
                echo "<form action='Critica.php?idObra=" . $row["idobra"] . "' method='post'>
                <input type='hidden' name='criticaobraid' value='" . $row["idobra"] . "'>
                <div style='display: flex;'>
                <img src='movieIcon.png' width='20' height='20'>
                <input type='submit' value='" . $row["nome"] . " (" . $row["tipo"] . ")'>
                </div>
                </form>";
            } else if ($row["tipo"] == "livro" || $row["tipo"] == "Livro") {

                echo "<form action='Critica.php?idObra=" . $row["idobra"] . "' method='post'>
                <input type='hidden' name='criticaobraid' value='" . $row["idobra"] . "'>
                <div style='display: flex;'>
                <img src='bookIcon.png' width='20' height='20'>
                <input type='submit' value='" . $row["nome"] . " (" . $row["tipo"] . ")'>
                </div>
                </form>";

            } else {
                echo "<form action='Critica.php?idObra=" . $row["idobra"] . "' method='post'>
                <input type='hidden' name='criticaobraid' value='" . $row["idobra"] . "'>
                <div style='display: flex;'>
                <img src='othersIcon.png' width='30' height='30'>
                <input type='submit' value='" . $row["nome"] . " (" . $row["tipo"] . ")'>
               </div>
                </form>";
            }
        }
    } else {
        echo "Nenhuma obra foi encontrada!";
    }
}


function insereObra($nome, $tipo)
{
    global $conn;
    $sql = "INSERT INTO obra (nome, tipo) VALUES ('$nome', '$tipo')";
    $result = $conn->query
    ($sql);
}







