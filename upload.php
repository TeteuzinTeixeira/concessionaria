<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require("conecta.php");

    $nomeEvento = $_POST['nome_evento'];
    $descricaoEvento = $_POST['descricao_evento'];
    $imagemTemp = $_FILES['imagem']['tmp_name'];
    $tamanho = $_FILES['imagem']['size'];
    $tipo = $_FILES['imagem']['type'];
    $nomeImagem = $_FILES['imagem']['name'];

    if (!empty($imagemTemp)) {
        $conteudo = addslashes(file_get_contents($imagemTemp));

        $queryInsercao = "INSERT INTO tabela_imagens (nome_evento, descricao_evento, nome_imagem, tamanho_imagem, tipo_imagem, imagem) VALUES ('$nomeEvento', '$descricaoEvento', '$nomeImagem', '$tamanho', '$tipo', '$conteudo')";

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