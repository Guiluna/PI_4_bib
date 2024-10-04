<?php


//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];
$nome = $_POST['titulo'];
$setor = $_POST['setor'];
$data_nasc = $_POST['data_nasc'];

$query = "SELECT COUNT(*) as quantidade FROM cad_usuario WHERE nome = '$nome' AND setor = '$setor'";
$result = $db->query($query);

$row = $result->fetchArray(SQLITE3_ASSOC);
$quantidade = $row['quantidade'];

if($quantidade == 0){
    $insere = $db->query("INSERT INTO cad_usuario ( nome,setor,id_escola, data_nascimento)"
    . "VALUES ('$nome','$setor', '$usuario_id','$data_nasc')");

    echo '1';
}else{
    echo 'Já existe um usuario com este nome neste setor!';
}
/*

*/
?>