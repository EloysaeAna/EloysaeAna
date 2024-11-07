<?php 

   function pegar_pedidosProdutos($conexao){
    $conexao = conectar();
    $sql = "SELECT * FROM pedidos_produtos";
    $res = mysqli_query($conexao, $sql) or die("Erro ao tentar consultar");

    $pedidosProdutos = [];

    while ($registro = mysqli_fetch_array($res)) {
        $id_pedido = utf8_encode( $registro['id_pedido']);
        $id_produto = utf8_encode($registro['id_produto']);
        $qtd = utf8_encode( $registro['qtd']);
      
        
        
        $novo_pedidosProdutos = new pedidos_produtos($id_pedido, $id_produto, $qtd);
        array_push($pedidosProdutos, $novo_pedidosProdutos);
        
        //echo $nome;
        //$novo_usuario = new Usuario($id, $nome, $email, $telefone, $dataNascimento, $senha, $papel);
        //array_push($usuarios ,$novo_usuario);
    };
    
    fecharConexao($conexao);
    return $pedidosProdutos;
   };

   
?>