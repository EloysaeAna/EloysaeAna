<?php 
   
   function editar_pedido_parcialmente($conexao){
      $dados = json_decode(file_get_contents('php://input'));
 
      $tabela = $dados->tabela;
      $id_pedido = $dados->id_pedido;
   
      $campo = array_keys((array) $dados)[2];
   
      $valor = $dados->$campo;
   
      $verificar_sql = "SELECT id_pedido FROM Pedidos WHERE id_pedido = $id_pedido";
      $verificar_res = mysqli_query($conexao, $verificar_sql);
   
      if (mysqli_num_rows($verificar_res) == 0) {
         echo "ID inválido. Por favor, informe um válido. \n";
         fecharConexao($conexao);
         return false;
      }
   
      $sql = "UPDATE $tabela SET $campo = '$valor' WHERE id_pedido = $id_pedido;";
      $res = mysqli_query($conexao, $sql) or die("Erro ao tentar editar");
   
      fecharConexao($conexao);
   
      return $res;
   };
 
?>