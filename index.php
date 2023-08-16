<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Formulário de Login</h2>
    <form action="autenticar.php" method="post">
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" id="usuario" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
