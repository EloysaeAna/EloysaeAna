<?php 

   function pegar_clientes($conexao){
    $conexao = conectar();
    $sql = "SELECT * FROM Clientes";
    $res = mysqli_query($conexao, $sql) or die("Erro ao tentar consultar");

    $clientes = [];

    while ($registro = mysqli_fetch_array($res)) {
        $id = utf8_encode( $registro['id']);
        $nome = utf8_encode($registro['nome']);
        $endereco = utf8_encode( $registro['endereco']);
        $cpf = utf8_encode( $registro['cpf']);
        $telefone = utf8_encode( $registro['telefone']);
        $email = utf8_encode( $registro['email']);
        $dataNasc = utf8_encode( $registro['dataNasc']);
        
        
        
        $novo_cliente = new Cliente($id, $nome, $endereco, $cpf, $telefone, $email, $dataNasc);
        array_push($clientes, $novo_cliente);
        
        //echo $nome;
        //$novo_usuario = new Usuario($id, $nome, $email, $telefone, $dataNascimento, $senha, $papel);
        //array_push($usuarios ,$novo_usuario);
    };
    
    fecharConexao($conexao);
    return $clientes;
   };

   
?>