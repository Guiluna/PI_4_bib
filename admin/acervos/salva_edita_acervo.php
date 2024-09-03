<?php


//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];

$isbn = $_POST['isbn'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$quantidade2 = $_POST['quantidade'];
$ano = $_POST['ano'];
$editora = $_POST['editora'];
$tipo = $_POST['tipo'];
$setor = $_POST['setor'];
$estante = $_POST['estante'];
$prateleira = $_POST['prateleira'];
$sinopse = $_POST['sinopse'];
$categoria = $_POST['categoria'];
$id = $_POST['id'];

$query = "SELECT COUNT(*) as quantidade FROM cad_acervo WHERE titulo = '$titulo' and id != '$id' ";
$result = $db->query($query);

$row = $result->fetchArray(SQLITE3_ASSOC);
$quantidade = $row['quantidade'];

if($quantidade == 0){
    $insere = $db->query("UPDATE cad_acervo SET isbn='$isbn', titulo='$titulo', autor='$autor', quantidade='$quantidade2', ano='$ano', editora='$editora', tipo='$tipo', setor='$setor', estante='$estante', prateleira='$prateleira', sinopse='$sinopse', categoria='$categoria' WHERE id = '$id'"); 
    echo '1';
}else{
    echo 'Já existe um acervo este título!';
}
/*

*/
?>