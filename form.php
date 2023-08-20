<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

$usuarioLogado = $_SESSION['usuario'];

require("conecta.php");

if (isset($_GET['delete'])) {
    $codigoExcluir = $_GET['delete'];
    $queryExcluir = "DELETE FROM tabela_imagens WHERE id = '$codigoExcluir'";
    mysqli_query($conexao, $queryExcluir);
}

$querySelecao = "SELECT * FROM tabela_imagens";
$resultado = mysqli_query($conexao, $querySelecao);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulário Protegido</title>
</head>
<body>
    <h2>Formulário Protegido</h2>
    <p>Bem-vindo, <?php echo $usuarioLogado; ?>!</p>
    
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="marca">Marca</label>
        <input type="text" name="marca" id="marca">
        <br>
        <label for="modelo">Modelo</label>
        <input name="modelo" id="modelo"></input>
        <br>
        <label for="ano">Ano</label>
        <input name="ano" id="ano"></input>
        <br>
        <label for="valor">Valor</label>
        <input name="valor" id="valor"></input>
        <br>
        <label for="descricao">Descricao</label>
        <textarea name="descricao" id="descricao"></textarea>
        <br>
        <label for="imagem">Imagem</label>
        <input type="file" name="imagem" id="imagem">
        <br>
        <input type="submit" value="Enviar">
    </form>
    
    <p><a href="logout.php">Sair</a></p>

    <h1>Dados do Banco de Dados</h1>
    <table border="1">
        <tr>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Ano</th>
            <th>Valor</th>
            <th>Descricao</th>
            <th>Imagem</th>
            <th>Acao</th>
        </tr>
        <<?php while ($linha = mysqli_fetch_assoc($resultado)) { ?>
            <tr>
                <td><?php echo isset($linha['marca']) ? $linha['marca'] : ''; ?></td>
                <td><?php echo isset($linha['modelo']) ? $linha['modelo'] : ''; ?></td>
                <td><?php echo isset($linha['ano']) ? $linha['ano'] : ''; ?></td>
                <td><?php echo isset($linha['valor']) ? $linha['valor'] : ''; ?></td>
                <td><?php echo isset($linha['descricao']) ? $linha['descricao'] : ''; ?></td>
                <td><img src="data:<?php echo $linha['tipo_imagem']; ?>;base64,<?php echo base64_encode($linha['imagem']); ?>"></td>
                <td><a href="form.php?delete=<?php echo $linha['id']; ?>">Excluir</a></td>
            </tr>
    <?php } ?>
    </table>
</body>
</html>