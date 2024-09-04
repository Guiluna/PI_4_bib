<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];
$lista = $db->query("SELECT * FROM cad_escola WHERE id = '$usuario_id'  ");
$dados = $lista->fetchArray();
$nome_escola = $dados['nome'];         
?>

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">Menu</h5>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="painel.php"> <i class="fa fa-home f-20"></i> </a>
                    </li>
                    
                </ul>
            </div>
        </div>
        

    </div>
</div>

<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
             <!-- Page-body start -->
            <div class="page-body">
                <div class="row">

                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-block bg-c-green b-radius-10" >

                                <a href="#" class="emprestimos"><h3 class="text-white m-50" style="text-align: center;">Empréstimos</h3></a>  

                            </div>                     
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-block bg-c-purple b-radius-10" >

                                <a href="#" class="acervo"><h3 class="text-white m-50" style="text-align: center;">Acervo</h3></a>  

                            </div>                     
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-block b-radius-10" style="background: #009578;">

                                <a href="#" class="usuarios"><h3 class="text-white m-50" style="text-align: center;">Usuários</h3></a>  

                            </div>                     
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-block bg-c-orenge b-radius-10" >

                                <a href="#" class="cursos"><h3 class="text-white m-50" style="text-align: center;">Turmas</h3></a>  

                            </div>                     
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-block b-radius-10" style="background: #ff5833;" >

                                <a href="#" class="categorias"><h3 class="text-white m-50" style="text-align: center;">Gêneros</h3></a>  

                            </div>                     
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-block b-radius-10" style="background: #f8c830;" >

                                <a href="#" class="dashboard"><h3 class="text-white m-50" style="text-align: center;">Dashboard</h3></a>  

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
        $('.emprestimos').click(function(){
            $('.menus').removeClass('active');
            $('.emprestimos1').addClass('active');
            $('.corpo').load('emprestimos/painel.php')
        })
        $('.acervo').click(function(){
            $('.menus').removeClass('active');
            $('.cadastros1').addClass('active');
            $('.corpo').load('acervos/painel.php')
        })
        $('.usuarios').click(function(){
            $('.menus').removeClass('active');
            $('.cadastros1').addClass('active');
            $('.corpo').load('cad_usuarios/painel.php')
        })
        $('.cursos').click(function(){
            $('.menus').removeClass('active');
            $('.cadastros1').addClass('active');
            $('.corpo').load('cursos/painel.php')
        })
        $('.categorias').click(function(){
            $('.menus').removeClass('active');
            $('.cadastros1').addClass('active');
            $('.corpo').load('cad_categorias/painel.php')
        })
        $('.dashboard').click(function(){
            $('.menus').removeClass('active');
            $('.dashboard1').addClass('active');
            $('.corpo').load('dashboard/painel.php')
        })
    })
</script>