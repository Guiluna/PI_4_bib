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
$data = new Data();
$categorias = $db->query("SELECT * FROM cad_categoria WHERE id_escola = '$usuario_id'");
while($dados = $categorias->fetchArray()){
    $titulo = $dados['titulo'];
    $id = $dados['id'];
    $titulos[] = $titulo;

    $ordem = 0;
    //adicionar categoria ao banco de dados de emprestimo
    $lista = $db->query("SELECT * FROM cad_acervo  WHERE categoria = '$id'");
        while($dados = $lista->fetchArray()){ $ordem += $dados['emprestimos']; }
    $emprestimos[]=$ordem;
}
$data->labels = $titulos;

$dataset = new Dataset();
//quantidade de emprestimos das respectivas categorias
$dataset->data = $emprestimos;
$dataset->label = 'n° de emprestimos';
//testar random color php para não precisar selecionar manualmente
$dataset->backgroundColor = [
    'rgb(255, 99, 132)',
    'rgb(54, 162, 235)',
    'rgb(255, 206, 86)'
];
$data->datasets[] = $dataset;

$chart->data($data);

$options = new Options();
$options->responsive = true;
$chart->options($options);
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>

<div class="col-xl-4 col-md-6">
    <div class="card">
        <div class="card-block bg-c-green">
            <div class="row align-items-center">
                <div class="col-8">
                    <h5 class="text-white m-b-0">Emprestimos</h5>
                </div>
                <div class="col-3 text-right">
                    <i class="fa fa-bar-chart text-white f-16"></i>
                </div>
            </div>
        </div>
        <div class="card-block">
            <div class="row align-items-center">
                <div class="chart-container" style="position: relative; height:30vh; width:40vw">
                    <?= $chart->toHtml('my_chart'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
