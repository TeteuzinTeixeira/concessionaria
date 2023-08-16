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
    $queryExcluir = "DELETE FROM tabela_imagens WHERE codigo = '$codigoExcluir'";
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
    
    <!-- Seu formulário de upload de imagem -->
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="nome_evento">Nome do Evento:</label>
        <input type="text" name="nome_evento" id="nome_evento">
        <br>
        <label for="descricao_evento">Descrição do Evento:</label>
        <textarea name="descricao_evento" id="descricao_evento"></textarea>
        <br>
        <label for="imagem">Imagem:</label>
        <input type="file" name="imagem" id="imagem">
        <br>
        <input type="submit" value="Enviar">
    </form>
    
    <p><a href="logout.php">Sair</a></p>

    <h1>Dados do Banco de Dados</h1>
    <table border="1">
        <tr>
            <th>Código</th>
            <th>Nome do Evento</th>
            <th>Descrição do Evento</th>
            <th>Imagem</th>
            <th>Ação</th>
        </tr>
        <?php while ($linha = mysqli_fetch_assoc($resultado)) { ?>
            <tr>
                <td><?php echo $linha['codigo']; ?></td>
                <td><?php echo $linha['nome_evento']; ?></td>
                <td><?php echo $linha['descricao_evento']; ?></td>
                <td><img src="data:<?php echo $linha['tipo_imagem']; ?>;base64,<?php echo base64_encode($linha['imagem']); ?>" alt="<?php echo $linha['nome_imagem']; ?>"></td>
                <td><a href="form.php?delete=<?php echo $linha['codigo']; ?>">Excluir</a></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
