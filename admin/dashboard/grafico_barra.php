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
$chart->type = 'bar';

$emprestimos = [];

$meses = [
    "Janeiro",
    "Fevereiro",
    "Março",
    "Abril",
    "Maio",
    "Junho",
    "Julho",
    "Agosto",
    "Setembro",
    "Outubro",
    "Novembro",
    "Dezembro"
];

$ano = $_POST["var"];

$data = new Data();

$data->labels = $meses;

for ($i = 1; $i <= 12; $i++) {
    $query = "SELECT COUNT(*) as quantidade FROM cad_emprestimo WHERE ano = '$ano' AND mes = '$i'";
    $result = $db->query($query);

    $row = $result->fetchArray();
    $emprestimos[] = $row['quantidade'];
}
$dataset = new Dataset();
//quantidade de emprestimos dos respectivas meses
$dataset->data = $emprestimos;
$dataset->label = 'n° de emprestimos';

$data->datasets[] = $dataset;

$chart->data($data);

$options = new Options();
$options->responsive = true;

$chart->options($options);
?>
<div class="chart-container" >
    <?= $chart->toHtml('chart2'); ?>
</div>

