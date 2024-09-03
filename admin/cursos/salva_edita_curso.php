<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];
$lista = $db->query("SELECT * FROM cad_escola WHERE id = '$usuario_id'  ");
$dados = $lista->fetchArray();




$id = $_POST['id'];
$titulo = $_POST['titulo'];
 

$insere = $db->query("UPDATE cad_curso SET titulo='$titulo'  WHERE id = '$id'"); 
    

echo '1';
?>