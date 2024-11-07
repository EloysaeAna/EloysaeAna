<?php

function editar_produto($conexao, $u, $id) {
    // Verifica se o ID é válido
    if (empty($id) || !is_numeric($id)) {
        die("ID inválido.");
    }

    // Prepara a consulta SQL para atualizar o produto no banco
    $sql = "UPDATE Produtos 
            SET nome = ?, descricao = ?, qtd = ?, marca = ?, preco = ?, validade = ? 
            WHERE id = ?";

    // Usa a declaração preparada para evitar SQL Injection
    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt) {
        // Faz o binding dos parâmetros
        mysqli_stmt_bind_param($stmt, 'ssisssi', $u->nome, $u->descricao, $u->qtd, $u->marca, $u->preco, $u->validade, $id);

        // Executa a consulta
        $res = mysqli_stmt_execute($stmt);

        // Fecha a declaração
        mysqli_stmt_close($stmt);

        return $res;  // Retorna o resultado (true ou false)
    } else {
        // Se ocorrer um erro ao preparar a consulta
        die("Erro ao preparar a consulta: " . mysqli_error($conexao));
    }
}
?>
