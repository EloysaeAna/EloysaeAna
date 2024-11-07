<?php
function deletar_produto($conexao, $id) {
    // Primeiro, exclua os registros dependentes
    $sqlDeletePedidos = "DELETE FROM pedidos_produtos WHERE id_produto = $id;";
    mysqli_query($conexao, $sqlDeletePedidos);

    // Agora, exclua o produto
    $sql = "DELETE FROM Produtos WHERE id = $id;";
    $res = mysqli_query($conexao, $sql) or die("Erro ao tentar deletar");

    fecharConexao($conexao);
    return $res;
}
?>