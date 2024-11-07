<?php 
   
   function editar_pedidos($conexao, $u, $id_cliente){

        $sql = "UPDATE Pedidos SET  id_cliente = '$u->id_cliente', data = '$u->data' WHERE id_cliente = $id_cliente;";
        $res = mysqli_query($conexao, $sql) or die("Erro ao tentar incluir");
        fecharConexao($conexao);
        return $res;
   };

?>