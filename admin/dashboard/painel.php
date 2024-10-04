<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];
$lista = $db->query("SELECT * FROM cad_escola WHERE id = '$usuario_id'  ");
$dados = $lista->fetchArray();
$nome_escola = $dados['nome'];
?>

<!-- Page-header start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">Dashboard</h5>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="painel.php"> <i class="fa fa-home f-20"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)" class="lista">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
        

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
             <!-- Page-body start -->
             <div class="page-body">
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-block bg-c-green">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h5 class="text-white m-b-0" id="titulo">Empréstimos (Categoria)</h5>
                                    </div>
                                    
                                    <div class="col-4 text-right">
                                        <select name="" id="mes" class="form-control">
                                            <?php
                                                $lista = $db->query("SELECT DISTINCT ano FROM cad_emprestimo ORDER BY ano DESC");
                                                while($dados = $lista->fetchArray()){
                                                    $ano = $dados['ano'];

                                                    $meses = $db->query("SELECT DISTINCT mes FROM cad_emprestimo WHERE ano = '$ano' ORDER BY mes DESC");
                                                    while($dados = $meses->fetchArray()){
                                                        $mes = $dados['mes'];

                                                        $mes_ano = strval($mes)." / ".strval($ano);
                                                    ?>
                                                    <option value="<?php echo $mes_ano ?>"><?php echo $mes_ano ?></option>
                                                    <?php
                                                    }
                                            }
                                            ?>         
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="align-items-center grafico">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-block bg-c-green">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h5 class="text-white m-b-0" id="titulo">Empréstimos (Mensal)</h5>
                                    </div>
                                    
                                    <div class="col-4 text-right">
                                        <select name="" id="ano" class="form-control">
                                            <?php
                                                $lista = $db->query("SELECT DISTINCT ano FROM cad_emprestimo ORDER BY ano DESC");
                                                while($dados = $lista->fetchArray()){
                                                    $ano = $dados['ano'];
                                                    ?>
                                                    <option value="<?php echo $ano ?>"><?php echo $ano ?></option>
                                                    <?php
                                                    }
                                            ?>         
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block col-12">
                                <div class="align-items-center grafico_barra">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-block bg-c-green">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h5 class="text-white m-b-0" id="titulo">Acervo Atual</h5>
                                    </div>
                                    <div class="col-3 text-right">
                                        <i class="ti-bar-chart text-white f-16"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block col-12">
                                <div class="align-items-center grafico_acervo">
                                </div>
                            </div>
                        </div>
                    </div>
             </div>
             <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-block bg-c-green">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h5 class="text-white m-b-0" id="titulo">Top Empréstimos</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-block col-12">
                            <div class="align-items-center top_acervo">

                            </div>
                        </div>
                    </div>
                </div>
             </div>
         </div>
    </div>
</div>
<script>
    $(function(){
        var mes = $('#mes').find(":selected").val();
        $('.grafico').load("dashboard/grafico.php", {var: mes});

        $("#mes").on('change',function(event) {
            mes = $('#mes').find(":selected").val();
            $('.grafico').load("dashboard/grafico.php", {var: mes});
        })

        var ano = $('#ano').find(":selected").val();
        $('.grafico_barra').load("dashboard/grafico_barra.php", {var: ano});

        $("#ano").on('change',function(event) {
            ano = $('#ano').find(":selected").val();
            $('.grafico_barra').load("dashboard/grafico_barra.php", {var: ano});
        })   
        
        $('.grafico_acervo').load("dashboard/grafico_acervo.php");
        $('.top_acervo').load("dashboard/top_acervo.php");
    })
</script>
