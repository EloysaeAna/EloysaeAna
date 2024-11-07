<?php 
   
   function editar_pedidosProdutos($conexao, $u, $id_produto){

        $sql = "UPDATE pedidos_produtos SET id_produto = '$u->id_produto', qtd = '$u->qtd' WHERE id_produto = $id_produto;";
        $res = mysqli_query($conexao, $sql) or die("Erro ao tentar incluir");
        fecharConexao($conexao);
        return $res;
   };

?>