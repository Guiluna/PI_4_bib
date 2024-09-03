<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];
$lista = $db->query("SELECT * FROM cad_escola WHERE id = '$usuario_id'  ");
$dados = $lista->fetchArray();
$nome_escola = $dados['nome'];   

$id = $usuario_id;


$exclui = $db->query("DELETE FROM cad_escola WHERE id = '$id'");
$exclui = $db->query("DELETE FROM cad_acervo WHERE id_escola = '$id'");
$exclui = $db->query("DELETE FROM cad_categoria WHERE id_escola = '$id'");
$exclui = $db->query("DELETE FROM cad_usuario WHERE id_escola = '$id'");
$exclui = $db->query("DELETE FROM cad_curso WHERE id_escola = '$id'");
$exclui = $db->query("DELETE FROM cad_emprestimo WHERE id_escola = '$id'");

echo 1;
?>