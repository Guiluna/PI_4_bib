<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];
$lista = $db->query("SELECT * FROM cad_escola WHERE id = '$usuario_id'  ");
$dados = $lista->fetchArray();




$id = $_POST['id'];
$novaData = $_POST['novaData'];
 

$insere = $db->query("UPDATE cad_emprestimo SET devolvido_em='$novaData'  WHERE id = '$id'"); 
    

echo '1';
?>