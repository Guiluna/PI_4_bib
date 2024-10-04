<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];
$lista = $db->query("SELECT * FROM cad_escola WHERE id = '$usuario_id'  ");
$dados = $lista->fetchArray();




$id = $_POST['id'];
$titulo = $_POST['titulo'];
$setor = $_POST['setor'];
$data_nasc = $_POST['data_nasc'];

$insere = $db->query("UPDATE cad_usuario SET nome='$titulo', setor = '$setor' , data_nascimento = '$data_nasc' WHERE id = '$id'"); 
    

echo '1';
?>