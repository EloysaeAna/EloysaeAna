<?php 

   function pegar_pedidos($conexao){
    $conexao = conectar();
    $sql = "SELECT * FROM Pedidos";
    $res = mysqli_query($conexao, $sql) or die("Erro ao tentar consultar");

    $pedidos = [];

    while ($registro = mysqli_fetch_array($res)) {
        $id_pedido = utf8_encode( $registro['id_pedido']);
        $id_cliente = utf8_encode($registro['id_cliente']);
        $data = utf8_encode( $registro['data']);
      
        
        
        $novo_pedidos = new Pedidos($id_pedido, $id_cliente, $data);
        array_push($pedidos, $novo_pedidos);
        
        //echo $nome;
        //$novo_usuario = new Usuario($id, $nome, $email, $telefone, $dataNascimento, $senha, $papel);
        //array_push($usuarios ,$novo_usuario);
    };
    
    fecharConexao($conexao);
    return $pedidos;
   };

   
?>