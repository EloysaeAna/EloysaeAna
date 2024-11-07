<?php 
   
   function editar_cliente($conexao, $u, $id){

        $sql = "UPDATE Clientes SET nome = '$u->nome', endereco = '$u->endereco', cpf = '$u->cpf', telefone = '$u->telefone', email ='$u->email', dataNasc = '$u->dataNasc' WHERE id = $id;";
        $res = mysqli_query($conexao, $sql) or die("Erro ao tentar incluir");
        fecharConexao($conexao);
        return $res;
   };

?>