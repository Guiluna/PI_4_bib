<?php
// Cria a conexão com o banco de dados SQLite3
$db = new SQLite3('../../db/bibliotecario.db');

// Recupera o ID do usuário a partir da sessão
session_start(); 
$usuario_id = $_SESSION['usuarioId'];

// Valida e escapa o valor da pesquisa
if (isset($_POST['pesquisa'])) {
    $pesquisa = $db->escapeString($_POST['pesquisa']);

    // Consulta o banco de dados para buscar livros que correspondam à pesquisa
    $query = "SELECT * FROM cad_acervo WHERE titulo LIKE '%$pesquisa%' AND id_escola='$usuario_id'";
    $resultado = $db->query($query);

    // Gera a lista de resultados como uma tabela
    if ($resultado->numColumns() > 0) {
        echo "<table class='table'>";
        echo "<tr><th>ID</th><th>ISBN</th><th>Título</th><th>Categoria</th></tr>";
        while ($row = $resultado->fetchArray(SQLITE3_ASSOC)) {
            

            echo "<tr>";
            echo "<td class='id'>" . $row['id'] . "</td>";
            echo "<td>" . $row['isbn'] . "</td>";
            echo "<td class='col-titulo titulo'>" . $row['titulo'] . "</td>";
            echo "<td>" . $row['tipo'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum resultado encontrado.";
    }
} else {
    echo "O campo de pesquisa está vazio.";
}


?>
