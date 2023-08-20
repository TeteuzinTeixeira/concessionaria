<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require("conecta.php");

    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $valor = $_POST['valor'];
    $descricao = $_POST['descricao'];
    $imagensTemp = $_FILES['imagem']['tmp_name'];
    $tamanhos = $_FILES['imagem']['size'];
    $tipos = $_FILES['imagem']['type'];
    $nomesImagem = $_FILES['imagem']['name'];

    if (!empty($imagensTemp)) {
        $imagens = [];
        foreach ($imagensTemp as $key => $imagemTemp) {
            $conteudo = addslashes(file_get_contents($imagemTemp));
            $imagens[] = $conteudo;
        }

        $imagensSerializadas = serialize($imagens);

        $queryInsercao = "INSERT INTO tabela_imagens (marca, modelo, ano, valor, descricao, nome_imagem, tamanho_imagem, tipo_imagem, imagem) VALUES ('$marca', '$modelo', '$ano','$valor', '$descricao', '$nomesImagem', '$tamanhos', '$tipos', '$imagensSerializadas')";

        if (mysqli_query($conexao, $queryInsercao)) {
            echo 'Registro inserido com sucesso!';
            header('Location: form.php');
        } else {
            die("Algo deu errado ao inserir o registro. Tente novamente. Erro: " . mysqli_error($conexao));
        }
    } else {
        print "Não foi possível carregar a imagem.";
    }
} else {
    echo "Acesso inválido.";
}
?>