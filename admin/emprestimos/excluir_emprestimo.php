<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
  

$id = $_POST['id'];


$exclui = $db->query("DELETE FROM cad_emprestimo WHERE id = '$id'");



echo 1;
?>