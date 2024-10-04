<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];
$lista = $db->query("SELECT * FROM cad_escola WHERE id = '$usuario_id'  ");
$dados = $lista->fetchArray();
$nome_escola = $dados['nome'];
?>
<?php 
$emprestimos = [];
$titulos = [];

$query = "SELECT c.id, c.titulo, (SELECT COUNT(*) FROM cad_emprestimo e WHERE e.id_acervo = c.id) AS emprestimos FROM cad_acervo c ORDER BY quantidade DESC";
$result = $db->query($query);
while($dados = $result->fetchArray(SQLITE3_ASSOC)){
    $titulos[] = $dados["titulo"];
    $emprestimos[] = $dados["emprestimos"];
}
?>
<ol><?php
for ($i=0; $i<10; $i++){
    ?>
    <li><?php 
    if(strlen($titulos[$i])>45){
    echo substr($titulos[$i],0,45) . "... - " . strval($emprestimos[$i]);
    }
    elseif($titulos[$i]!= ""){
        echo $titulos[$i] . " - " . strval($emprestimos[$i]);
    }
    else{
    }
    ?></li>
    <?php } ?>
</ol>