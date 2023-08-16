<?php
session_start();
require("conecta.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM login WHERE usuario = '$usuario' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $query);

    if ($resultado && mysqli_num_rows($resultado) === 1) {
        // Autenticação bem-sucedida
        $_SESSION['usuario'] = $usuario;
        header('Location: form.php'); // Redireciona para form.php após o login bem-sucedido
    } else {
        // Autenticação falhou
        echo "Usuário ou senha incorretos. <a href='index.php'>Tente novamente</a>";
    }
}
?>
