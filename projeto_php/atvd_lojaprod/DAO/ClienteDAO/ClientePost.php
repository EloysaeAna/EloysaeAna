<?php 
   
   function incluir_cliente($conexao, $u){

        $sql = "INSERT INTO Clientes (nome, endereco, cpf, telefone, email, dataNasc) VALUES ('$u->nome','$u->endereco', '$u->cpf', '$u->telefone','$u->email','$u->dataNasc');";
        $res = mysqli_query($conexao, $sql);
        if (!$res) {
            die("Erro ao tentar incluir: " . mysqli_error($conexao));
        }
        
        fecharConexao($conexao);
        return $res;
   };

?>

