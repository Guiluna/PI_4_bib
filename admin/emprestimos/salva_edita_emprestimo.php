<?php


//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];

$id = $_POST['id'];

$id_usuario = $_POST['id_usuario'];
$id_acervo = $_POST['id_acervo'];
$data_atual = $_POST['data_atual'];
$data_devolucao = $_POST['data_devolucao'];
$hora_atual = $_POST['hora_atual'];

$separa = explode('/',$data_atual);
$mes = $separa[1];
$ano = $separa[2];


$lista = $db->query("SELECT * FROM cad_acervo  WHERE id = '$id_acervo'");
    $dados = $lista->fetchArray();
    $quantidade_livros = $dados['quantidade'];

   
$query = "SELECT COUNT(*) as quantidade FROM cad_emprestimo WHERE id_acervo = '$id_acervo' AND devolvido_em = '' AND id != '$id'";
$result = $db->query($query);

$row = $result->fetchArray(SQLITE3_ASSOC);
$quantidade = $row['quantidade'];

if($quantidade < $quantidade_livros){
    $insere = $db->query("UPDATE cad_emprestimo SET id_usuario='$id_usuario', id_acervo = '$id_acervo', data_atual='$data_atual', data_devolucao='$data_devolucao',hora='$hora_atual'  WHERE id = '$id'"); 

    echo '1';
}else{
    echo 'Não existe estoque para este acervo. Verifique as pendências de devolução para dar baixa!';
}
/*

*/
?>