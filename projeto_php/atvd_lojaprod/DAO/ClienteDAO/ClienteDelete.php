<?php 
 function deletar_cliente($conexao, $id) {
   // Primeiro, exclua os produtos associados aos pedidos
   $sqlDeleteProdutos = "DELETE FROM pedidos_produtos WHERE id_pedido IN (SELECT id_pedido FROM Pedidos WHERE id_cliente = $id);";
   mysqli_query($conexao, $sqlDeleteProdutos);

   // Depois, exclua os pedidos associados ao cliente
   $sqlDeletePedidos = "DELETE FROM Pedidos WHERE id_cliente = $id;";
   mysqli_query($conexao, $sqlDeletePedidos);

   // Agora, exclua o cliente
   $sql = "DELETE FROM Clientes WHERE id = $id;";
   $res = mysqli_query($conexao, $sql) or die("Erro ao tentar deletar cliente: " . mysqli_error($conexao));

   fecharConexao($conexao);
   return $res;
}

   
?>