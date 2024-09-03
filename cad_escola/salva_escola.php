<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../db/bibliotecario.db');
$nome = $_POST['nome'];

$query = "SELECT COUNT(*) as quantidade FROM cad_escola WHERE nome = '$nome' ";
$result = $db->query($query);

$row = $result->fetchArray(SQLITE3_ASSOC);
$quantidade = $row['quantidade'];

if($quantidade == 0){
    $insere = $db->query("INSERT INTO cad_escola ( nome)"
    . "VALUES ('$nome')");

    echo '1';
}else{
    echo 'Já existe uma escola este nome!';
}
/*

*/
?>