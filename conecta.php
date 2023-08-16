<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "imagens_devmedia";

$conexao = mysqli_connect($host, $usuario, $senha, $banco);

if (!$conexao) {
    die("Não foi possível conectar ao banco de dados: " . mysqli_connect_error());
}
?>