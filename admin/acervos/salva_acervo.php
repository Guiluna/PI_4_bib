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

$query = "SELECT COUNT(*) as quantidade FROM cad_acervo WHERE titulo = '$titulo' ";
$result = $db->query($query);

$row = $result->fetchArray(SQLITE3_ASSOC);
$quantidade = $row['quantidade'];

if($quantidade == 0){
    $insere = $db->query("INSERT INTO cad_acervo ( titulo,autor,quantidade,ano,editora,tipo,setor,estante,prateleira,sinopse,categoria,id_escola,isbn,emprestimos)"
    . "VALUES ('$titulo','$autor','$quantidade2','$ano','$editora','$tipo','$setor','$estante','$prateleira','$sinopse','$categoria','$usuario_id','$isbn',0)");

    echo '1';
}else{
    echo 'Já existe um acervo com este título!';
}
/*

*/
?>