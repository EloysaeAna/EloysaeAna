<?php 
   
   function incluir_pedidos($conexao, $u){

        $sql = "INSERT INTO Pedidos (id_cliente, data) VALUES ('$u->id_cliente', '$u->data');";
        $res = mysqli_query($conexao, $sql);
        if (!$res) {
            die("Erro ao tentar incluir: " . mysqli_error($conexao));
        }
        
        fecharConexao($conexao);
        return $res;
   };

?>

