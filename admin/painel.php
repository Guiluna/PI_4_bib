<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];
$lista = $db->query("SELECT * FROM cad_escola WHERE id = '$usuario_id'  ");
$dados = $lista->fetchArray();
$nome_escola = $dados['nome'];           
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Inovação Bibliotecária</title>
    
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     
      <!-- Favicon icon -->
      <link rel="icon" href="../arquivos/assets/images/book.ico" type="image/x-icon">
      <!-- waves.css -->
    <link rel="stylesheet" href="../arquivos/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- Required Framework -->
      <link rel="stylesheet" type="text/css" href="../arquivos/assets/css/bootstrap/css/bootstrap.min.css">
      <!-- waves.css -->
      <link rel="stylesheet" href="../arquivos/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- themify icon -->
      <link rel="stylesheet" type="text/css" href="../arquivos/assets/icon/themify-icons/themify-icons.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="../arquivos/assets/icon/font-awesome/css/font-awesome.min.css">
      <!-- scrollbar.css -->
      <link rel="stylesheet" type="text/css" href="../arquivos/assets/css/jquery.mCustomScrollbar.css">
        
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="../arquivos/assets/css/style.css">

      <link rel="stylesheet" type="text/css" href="../arquivos/jqueryui/jquery-ui.css">
  </head>
  <style>
        .notificacao {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: linear-gradient(to bottom right, #3f69ff, #0077ff);
        color: #fff;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        z-index: 9999;
        }
    </style>
  <body>
  <!-- Pre-loader start -->
  <div class="theme-loader">
      <div class="loader-track">
          <div class="preloader-wrapper">
              <div class="spinner-layer spinner-blue">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
              <div class="spinner-layer spinner-red">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
            
              <div class="spinner-layer spinner-yellow">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
            
              <div class="spinner-layer spinner-green">
                  <div class="circle-clipper left">
                      <div class="circle"></div>
                  </div>
                  <div class="gap-patch">
                      <div class="circle"></div>
                  </div>
                  <div class="circle-clipper right">
                      <div class="circle"></div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Pre-loader end -->
  <div id="pcoded" class="pcoded">
      <div class="pcoded-overlay-box"></div>
      <div class="pcoded-container navbar-wrapper" >
          <nav class="navbar header-navbar pcoded-header">
              <div class="navbar-wrapper">
                  <div class="navbar-logo">
                      <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                          <i class="ti-menu"></i>
                      </a>
                      <div class="mobile-search waves-effect waves-light">
                          <div class="header-search">
                              <div class="main-search morphsearch-search">
                                  <div class="input-group">
                                      
                                  </div>
                              </div>
                          </div>
                      </div>
                      <a href="painel.php">
                        <!--
                          <img class="img-fluid" src="../imagens/logo_novo.png" style="width: 100px; margin-bottom: -10px; margin-top:-7px;" alt="Theme-Logo" />
                        -->
                        Inovação Bibliotecária
                      </a>
                      <a class="mobile-options waves-effect waves-light">
                          <i class="ti-more"></i>
                      </a>
                  </div>
                
                  <div class="navbar-container container-fluid">
                      <ul class="nav-left">
                          <li>
                              <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                          </li>
                          
                          
                      </ul>
                      <ul class="nav-right">
                          
                          <li class="user-profile header-notification">
                              <a href="#!" class="waves-effect waves-light">
                                  
                                  <span><?php echo $nome_escola ?></span>
                                  <i class="ti-angle-down"></i>
                              </a>
                             
                          </li>
                      </ul>
                  </div>
              </div>
          </nav>

          <div class="pcoded-main-container">
              <div class="pcoded-wrapper">
                  <nav class="pcoded-navbar">
                      <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                      <div class="pcoded-inner-navbar main-menu">
                         
                            <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">
                                
                                <!--<img class="img-fluid" src="../imagens/logo_novo.png" style="width: 130px; margin-bottom: -10px; margin-top:-7px;" alt="Theme-Logo" />-->
                            </div>
                          <ul class="pcoded-item pcoded-left-item">
                              <li class="menu menus">
                                  <a href="painel.php" class="waves-effect waves-dark dashboard">
                                      <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Menu</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                              <li class="escola1 menus">
                                  <a href="javascript:void(0)" class="waves-effect waves-dark escola">
                                      <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.dash.main">Instituição</span>
                                      
                                  </a>
                                 
                              </li>
                              <li class="pcoded-hasmenu cadastros1 menus">
                                  <a href="javascript:void(0)" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-archive"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.dash.main">Cadastros</span>
                                      
                                  </a>
                                    <ul class="pcoded-submenu">
                                    <li class="">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark categorias">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Gêneros</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark cursos">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Turmas</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark usuarios">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Usuários</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="javascript:void(0)" class="waves-effect waves-dark acervo">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Acervo Bibliotecário</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        
                                       
                                        
                                    </ul>
                                 
                              </li>
                              <li class="emprestimos1 menus">
                                  <a href="javascript:void(0)" class="waves-effect waves-dark emprestimos">
                                      <span class="pcoded-micon"><i class="ti-calendar"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.dash.main">Empréstimos</span>
                                      
                                  </a>
                                 
                              </li>
                              
                              <li class="dashboard1 menus">
                                  <a href="javascript:void(0)" class="waves-effect waves-dark dashboard">
                                      <span class="pcoded-micon"><i class="ti-bar-chart"></i></span>
                                      <span class="pcoded-mtext"  data-i18n="nav.dash.main">Dashboard</span>
                                      
                                  </a>                                 
                              </li>
                    
                          </ul>
                     
                      </div>
                  </nav>
                  <div class="pcoded-content corpo">
                    
                </div>
            </div>
        </div>
    </div>
    
    
    <!-- Required Jquery -->
    <script type="text/javascript" src="../arquivos/assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../arquivos/assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="../arquivos/assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="../arquivos/assets/js/bootstrap/js/bootstrap.min.js "></script>
    <script type="text/javascript" src="../arquivos/assets/pages/widget/excanvas.js "></script>
    <!-- waves js -->
    <script src="../arquivos/assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="../arquivos/assets/js/jquery-slimscroll/jquery.slimscroll.js "></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="../arquivos/assets/js/modernizr/modernizr.js "></script>
    <!-- slimscroll js -->
    <script type="text/javascript" src="../arquivos/assets/js/SmoothScroll.js"></script>
    <script src="../arquivos/assets/js/jquery.mCustomScrollbar.concat.min.js "></script>
    <!-- Chart js -->
    <script type="text/javascript" src="../arquivos/assets/js/chart.js/Chart.js"></script>
  
    <!-- menu js -->
    <script src="../arquivos/assets/js/pcoded.min.js"></script>
    <script src="../arquivos/assets/js/vertical-layout.min.js "></script>
    
    <script type="text/javascript" src="../arquivos/assets/js/script.js "></script>
    <script type="text/javascript" src="../arquivos/jqueryui/jquery-ui.js "></script>
    
    <script src="../arquivos/sweetalert/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
</body>
<script>
    $(function(){
        $('.menu').addClass('active');

        $('.categorias').click(function(){
            $('.menus').removeClass('active');
            $('.cadastros1').addClass('active');
            $('.corpo').load('cad_categorias/painel.php')
        })
        $('.cursos').click(function(){
            $('.menus').removeClass('active');
            $('.cadastros1').addClass('active');
            $('.corpo').load('cursos/painel.php')
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

        $('.emprestimos').click(function(){
            $('.menus').removeClass('active');
            $('.emprestimos1').addClass('active');
            $('.corpo').load('emprestimos/painel.php')
        })

        $('.corpo').load('menu/painel.php')

        $('.dashboard').click(function(){
            $('.menus').removeClass('active');
            $('.dashboard1').addClass('active');
            $('.corpo').load('relatorios/painel.php')
        })

        $('.escola').click(function(){
            $('.menus').removeClass('active');
            $('.escola1').addClass('active');
            $('.corpo').load('perfil/painel.php')
        })       
    })
</script>
</html>
