<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
  

$id = $_POST['id'];


$query = "SELECT COUNT(*) as quantidade FROM cad_emprestimo WHERE id_usuario = '$id' ";
$result = $db->query($query);

$row = $result->fetchArray(SQLITE3_ASSOC);
$quantidade = $row['quantidade'];

if ($quantidade == 0) {

$exclui = $db->query("DELETE FROM cad_usuario WHERE id = '$id'");
echo 1;
}else{
    echo 'Este usuário possui empréstimos em seu nome. Não pode ser excluído';
}

?>