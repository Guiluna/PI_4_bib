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
//configura gráfico
require "../../vendor/autoload.php";

use Bbsnly\ChartJs\Chart;
use Bbsnly\ChartJs\Config\Data;
use Bbsnly\ChartJs\Config\Dataset;
use Bbsnly\ChartJs\Config\Options;

$chart = new Chart;
$chart->type = 'doughnut';

//lista de categorias de livros cadastradas
$titulos = [];
$emprestimos = [];

if (isset($_POST['var'])){
    $mystring = $_POST['var'];
    $arr = explode(' / ', $mystring, 2);
    $mes = $arr[0];
    $ano = $arr[1];
}

$data = new Data();
$categorias = $db->query("SELECT * FROM cad_categoria WHERE id_escola = '$usuario_id'");
while($dados = $categorias->fetchArray()){
    $titulo = $dados['titulo'];
    $id = $dados['id'];
    $titulos[] = $titulo;

    $ordem = 0;
    //adicionar categoria ao banco de dados de emprestimo
    
    $query = "SELECT COUNT(*) as quantidade FROM cad_emprestimo JOIN cad_acervo ON cad_acervo.id = cad_emprestimo.id_acervo JOIN cad_categoria ON cad_categoria.id = cad_acervo.categoria AND (cad_categoria.id = '$id' AND cad_emprestimo.mes = '$mes'AND cad_emprestimo.ano = '$ano')";
    $result = $db->query($query);

    $row = $result->fetchArray(SQLITE3_ASSOC);
    $emprestimos[] = $row['quantidade'];

}
$data->labels = $titulos;

$dataset = new Dataset();
//quantidade de emprestimos das respectivas categorias
$dataset->data = $emprestimos;
$dataset->label = 'n° de emprestimos';

$data->datasets[] = $dataset;

$chart->data($data);

$options = new Options();
$options->responsive = true;
$chart->options($options);
?>
<div class="chart-container" >
    <?= $chart->toHtml('my_chart'); ?>
</div>

<?php

?>
