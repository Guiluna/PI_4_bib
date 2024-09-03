<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>Gerador de Horário Escolar </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="Sistema para gerar grade de horário escolar." />
      <meta name="keywords" content="escola, educação, horário" />
      <meta name="author" content="Wadson Benfica" />
      <!-- Favicon icon -->

      <link rel="icon" href="../arquivos/assets/images/favicon.ico" type="image/x-icon">
     <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="../arquivos/assets/css/bootstrap/css/bootstrap.min.css">
      <!-- waves.css -->
      <link rel="stylesheet" href="../arquivos/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="../arquivos/assets/icon/themify-icons/themify-icons.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="../arquivos/assets/icon/icofont/css/icofont.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="../arquivos/assets/icon/font-awesome/css/font-awesome.min.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="../arquivos/assets/css/style.css">
  </head>

  <body themebg-pattern="theme1">
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

    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    
                        <form class="md-float-material form-material">
                            <div class="text-center">
                                <img src="../imagens/logo_novo.png" style="width:200px; margin-bottom: -30px" alt="logo.png">
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Novo Cadastro</h3>
                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="text" id="nome" name="text" class="form-control" required="">
                                        <span class="form-bar"></span>
                                        <label class="float-label">Nome da Escola</label>
                                    </div>
                                    
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20 cadastro">Cadastrar</button>
                                        </div>
                                    </div>
                                    <div class="row m-t-25 text-left">
                                        <div class="col-12">
                                            
                                            <div class="forgot-phone text-right f-right">
                                                <a href="../index.php" class="text-right f-w-600">retornar</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </form>
                        <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>

<!-- Required Jquery -->
    <script type="text/javascript" src="../arquivos/assets/js/jquery/jquery.min.js"></script>     <script type="text/javascript" src="../arquivos/assets/js/jquery-ui/jquery-ui.min.js "></script>     <script type="text/javascript" src="../arquivos/assets/js/popper.js/popper.min.js"></script>     <script type="text/javascript" src="../arquivos/assets/js/bootstrap/js/bootstrap.min.js "></script>
<!-- waves js -->
<script src="../arquivos/assets/pages/waves/js/waves.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="../arquivos/assets/js/jquery-slimscroll/jquery.slimscroll.js "></script>
<!-- modernizr js -->
    <script type="text/javascript" src="../arquivos/assets/js/SmoothScroll.js"></script>     <script src="../arquivos/assets/js/jquery.mCustomScrollbar.concat.min.js "></script>

<script type="text/javascript" src="../arquivos/assets/js/common-pages.js"></script>
<script src="../arquivos/sweetalert/sweetalert.min.js"></script>
</body>
<script>
    $(function(){
        $('.cadastro').click(function(){
            nome = $('#nome').val();

            if(nome == ''){
                Swal.fire(
                    'Aviso!',
                    'Preencha o campo nome da escola!',
                    'warning'
                )
            }else{
                $.ajax({
                    type: "POST",
                    url: "salva_escola.php",
                    data: {'nome':nome},
                   
                    success: function(response) {
                        if(response == 1){
                            window.location.href="../index.php";

                          
                        }else{
                            Swal.fire(
                                'Aviso!',
                                response,
                                'warning'
                            )
                        }
                        
                    },
                        error: function(response) {
                        alert("Erro ao salvar dados");
                    }
                });
            }
        })
    })
</script>
</html>
