<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];

// Recuperar o valor da pesquisa do campo de entrada
$pesquisa = $_POST['pesquisa'];

// Consultar o banco de dados para buscar usuários que correspondam à pesquisa
$resultado = $db->query("SELECT id, nome FROM cad_usuario WHERE nome LIKE '%$pesquisa%' and id_escola='$usuario_id'");

// Gerar a lista
// Gerar a lista de resultados como uma série de tags <li>
while ($row = $resultado->fetchArray()) {
    echo "<li id='" . $row['id'] . "'>" . $row['nome'] . "</li>";
}
  
?>