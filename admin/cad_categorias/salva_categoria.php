<?php


//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];
$nome = $_POST['titulo'];

$query = "SELECT COUNT(*) as quantidade FROM cad_categoria WHERE titulo = '$nome' ";
$result = $db->query($query);

$row = $result->fetchArray(SQLITE3_ASSOC);
$quantidade = $row['quantidade'];

if($quantidade == 0){
    $insere = $db->query("INSERT INTO cad_categoria ( titulo,id_escola)"
    . "VALUES ('$nome','$usuario_id')");

    echo '1';
}else{
    echo 'Já existe uma cagtegoria este título!';
}
/*

*/
?>