<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../db/horario.db');
$id = $_POST['id'];

session_start();
$_SESSION['usuarioId'] = $_POST['id'];

echo("admin/painel.php");
        
       