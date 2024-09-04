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
                    <h5 class="m-b-10">Inovação Bibliotecária</h5>
                    <p class="m-b-0">Bem-vindo(a) ao Sistema para Controle de Acervo Literário</p>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="painel.php"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Escola: <?php echo $nome_escola ?></a>
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

                <?php
                $ordem = 0;
                $lista = $db->query("SELECT * FROM cad_emprestimo  WHERE id_escola = '$usuario_id' ");
                while($dados = $lista->fetchArray()){ $ordem++; }

                $mesAtual = date("m");
                $media = round($ordem);

                $acervos = 0;
                $lista = $db->query("SELECT * FROM cad_acervo  WHERE id_escola = '$usuario_id' ");
                while($dados = $lista->fetchArray()){ $acervos++; }

                $usuarios = 0;
                $lista = $db->query("SELECT * FROM cad_usuario  WHERE id_escola = '$usuario_id' ");
                while($dados = $lista->fetchArray()){ $usuarios++; }

                ?>

                    <!-- task, page, download counter  start -->
                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h4 class="text-c-green"><?php echo $media ?></h4>
                                        <h6 class="text-muted m-b-0">Empréstimos Mensais</h6>
                                    </div>
                                    <div class="col-4 text-right">
                                        <i class="fa fa-bar-chart f-28"></i>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="emprestimos">
                            <div class="card-footer bg-c-green">
                                
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <p class="text-white m-b-0">Ver Todos</p>
                                    </div>
                                    <div class="col-3 text-right">
                                        <i class="fa fa-line-chart text-white f-16"></i>
                                    </div>
                                </div>
                                
            
                            </div>
                            </a>
                        </div>
                    </div>

                     <!-- task, page, download counter  start -->
                     <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h4 class="text-c-purple"><?php echo $acervos ?></h4>
                                        <h6 class="text-muted m-b-0">Acervo Cadastrado</h6>
                                    </div>
                                    <div class="col-4 text-right">
                                        <i class="fa fa-bar-chart f-28"></i>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="acervo">
                            <div class="card-footer bg-c-purple">
                                
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <p class="text-white m-b-0">Ver Todos</p>
                                    </div>
                                    <div class="col-3 text-right">
                                        <i class="fa fa-line-chart text-white f-16"></i>
                                    </div>
                                </div>
                                
            
                            </div>
                            </a>
                        </div>
                    </div>


                     <!-- task, page, download counter  start -->
                     <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h4 class="text-c-red"><?php echo $usuarios ?></h4>
                                        <h6 class="text-muted m-b-0">Usuários</h6>
                                    </div>
                                    <div class="col-4 text-right">
                                        <i class="fa fa-bar-chart f-28"></i>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="usuarios">
                            <div class="card-footer bg-c-red">
                                
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <p class="text-white m-b-0">Ver Todos</p>
                                    </div>
                                    <div class="col-3 text-right">
                                        <i class="fa fa-line-chart text-white f-16"></i>
                                    </div>
                                </div>
                                
            
                            </div>
                            </a>
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
        $('.usuarios').click(function(){
            $('.menus').removeClass('active');
            $('.cadastros1').addClass('active');
            $('.corpo').load('cad_usuarios/painel.php')
        })
        $('.acervo').click(function(){
            $('.menus').removeClass('active');
            $('.cadastros1').addClass('active');
            $('.corpo').load('acervos/painel.php')
        })
    })
</script>