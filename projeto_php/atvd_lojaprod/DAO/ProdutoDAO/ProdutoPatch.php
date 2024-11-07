<?php 
   
   function editar_produto_parcialmente($conexao){
      $dados = json_decode(file_get_contents('php://input'));
 
      $tabela = $dados->tabela;
      $id = $dados->id;
   
      $campo = array_keys((array) $dados)[2];
   
      $valor = $dados->$campo;
   
      $verificar_sql = "SELECT id FROM Produtos WHERE id = $id";
      $verificar_res = mysqli_query($conexao, $verificar_sql);
   
      if (mysqli_num_rows($verificar_res) == 0) {
         echo "ID inválido. Por favor, informe um válido. \n";
         fecharConexao($conexao);
         return false;
      }
   
      $sql = "UPDATE $tabela SET $campo = '$valor' WHERE id = $id;";
      $res = mysqli_query($conexao, $sql) or die("Erro ao tentar editar");
   
      fecharConexao($conexao);
   
      return $res;
   };
 
?>