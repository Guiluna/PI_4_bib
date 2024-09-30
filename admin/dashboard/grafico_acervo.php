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
$chart->type = 'pie';

//lista de categorias de livros cadastradas
$titulos = [];
$acervo = [];

$data = new Data();

$sql = "SELECT SUM(quantidade) as quantidade FROM cad_acervo";
$result = $db->query($sql);
$row = $result->fetchArray(SQLITE3_ASSOC);
$total_acervo = $row["quantidade"];

$query = "SELECT COUNT(*) as quantidade FROM cad_emprestimo WHERE id_escola = '$usuario_id' AND devolvido_em = ''";
$result = $db->query($query);
$row = $result->fetchArray(SQLITE3_ASSOC);
$acervo[] = ($row["quantidade"]/$total_acervo) * 100;
$acervo[] = (($total_acervo - $row["quantidade"]) / $total_acervo) * 100;

$data->labels = ["Emprestado","Disponível"];

$dataset = new Dataset();
//quantidade de emprestimos das respectivas categorias
$dataset->data = $acervo;
$dataset->label = 'porcentagem (%)';
$dataset->backgroundColor = ["#ff5252","#11c15b"];

$data->datasets[] = $dataset;

$chart->data($data);

$options = new Options();
$options->responsive = true;
$chart->options($options);
?>
<div class="chart-container">
    <?= $chart->toHtml('chart3'); ?>
</div>
