<?php 
   
   function incluir_pedidosProdutos($conexao, $u){

        $sql = "INSERT INTO pedidos_produtos (id_pedido, id_produto, qtd) VALUES ('$u->id_pedido', '$u->id_produto', '$u->qtd');";
        $res = mysqli_query($conexao, $sql);
        if (!$res) {
            die("Erro ao tentar incluir: " . mysqli_error($conexao));
        }
        
        fecharConexao($conexao);
        return $res;
   };

?>

