<?php


//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];
$nome = $_POST['titulo'];
$setor = $_POST['setor'];

$query = "SELECT COUNT(*) as quantidade FROM cad_usuario WHERE nome = '$nome' AND setor = '$setor'";
$result = $db->query($query);

$row = $result->fetchArray(SQLITE3_ASSOC);
$quantidade = $row['quantidade'];

if($quantidade == 0){
    $insere = $db->query("INSERT INTO cad_usuario ( nome,setor,id_escola)"
    . "VALUES ('$nome','$setor', '$usuario_id')");

    echo '1';
}else{
    echo 'Já existe um usuario com este nome neste setor!';
}
/*

*/
?>