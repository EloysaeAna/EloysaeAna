<?php 

   function pegar_produtos($conexao){
    $conexao = conectar();
    $sql = "SELECT * FROM Produtos";
    $res = mysqli_query($conexao, $sql) or die("Erro ao tentar consultar");

    $produtos = [];

    while ($registro = mysqli_fetch_array($res)) {
        $id = utf8_encode( $registro['id']);
        $nome = utf8_encode($registro['nome']);
        $descricao = utf8_encode( $registro['descricao']);
        $qtd = utf8_encode( $registro['qtd']);
        $marca = utf8_encode( $registro['marca']);
        $preco = utf8_encode( $registro['preco']);
        $validade = utf8_encode( $registro['validade']);
        
        
        
        $novo_produto = new Produto($id, $nome, $descricao, $qtd, $marca, $preco, $validade);
        array_push($produtos, $novo_produto);
        
        //echo $nome;
        //$novo_usuario = new Usuario($id, $nome, $preco, $marca, $validadeimento, $senha, $papel);
        //array_push($usuarios ,$novo_usuario);
    };
    
    fecharConexao($conexao);
    return $produtos;
   };

   
?>