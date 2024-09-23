<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];
$lista = $db->query("SELECT * FROM cad_escola WHERE id = '$usuario_id'  ");
$dados = $lista->fetchArray();

$nome_escola = $_POST['nome'];

$insere = $db->query("UPDATE cad_escola SET nome='$nome_escola'  WHERE id = '$usuario_id'"); 
    
echo '1';