
<!DOCTYPE html>
<html lang="pt-BR">
<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('db/bibliotecario.db');
?>


<head>
    <title>Inovação Bibliotecária </title>
    
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="Sistema para contrele de livros em bibliotecas escolares." />
      <meta name="keywords" content="biblioteca, escola, educação, livros, book" />
      <meta name="author" content="codedthemes" />
      <!-- Favicon icon -->

      <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
      
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="arquivos/assets/css/bootstrap/css/bootstrap.min.css">
      <!-- waves.css -->
      <link rel="stylesheet" href="arquivos/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="arquivos/assets/icon/themify-icons/themify-icons.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="arquivos/assets/icon/icofont/css/icofont.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="arquivos/assets/icon/font-awesome/css/font-awesome.min.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="arquivos/assets/css/style.css">


  </head>

  <body themebg-pattern="theme1">
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

    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    
                        <form class="md-float-material form-material">
                            <div class="text-center">
                               <!--<img src="assets/images/logo.png" alt="logo.png">-->
                               <p class=""></p>
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Inovação Bibliotecária</h3>
                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                        <select name="" id="nome_escola" class="form-control">
                                            <option value="">Selecione Uma Instituição</option>
                                            <?php
                                                    $lista = $db->query("SELECT * FROM cad_escola ORDER BY id  ");
                                                    while($dados = $lista->fetchArray()){
                                                        $id = $dados['id'];
                                                        $nome = $dados['nome'];

                                                    ?>
                                                    <option value="<?php echo $id ?>"><?php echo $nome ?></option>

                                                    <?php
                                                    }
                                                    ?>
                                        </select>
                                    </div>
                                   
                                   
                                    <div class="row">
                                        <div class="col-md-10">
                                            
                                            <p class="text-inverse text-left"><a href="cad_escola.php"><b>Cadastre Nova Instituição</b></a></p>
                                        </div>
                                        <div class="col-md-2">
                                            <img src="assets/images/auth/Logo-small-bottom.png" alt="small-logo.png">
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
    
    <script type="text/javascript" src="arquivos/assets/js/jquery/jquery.min.js"></script>   
    <script type="text/javascript" src="arquivos/assets/js/jquery-ui/jquery-ui.min.js "></script>     
    <script type="text/javascript" src="arquivos/assets/js/popper.js/popper.min.js"></script>    
    <script type="text/javascript" src="arquivos/assets/js/bootstrap/js/bootstrap.min.js "></script>
    <!-- waves js -->
    <script src="arquivos/assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="arquivos/assets/js/jquery-slimscroll/jquery.slimscroll.js "></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="arquivos/assets/js/SmoothScroll.js"></script>     
    <script src="arquivos/assets/js/jquery.mCustomScrollbar.concat.min.js "></script>
    <script type="text/javascript" src="arquivos/assets/js/common-pages.js"></script>
    <script src="arquivos/sweetalert/sweetalert.min.js"></script>

<script>
    $(function(){
        $('#nome_escola').on("change", function(){
            id = $(this).val();
            if(id != "Selecione uma escola"){
                $.ajax({
                    type: 'POST',
                    url: 'cad_escola/verifica.php',
                    data: {'id':id },
                    //se tudo der certo o evento abaixo é disparado
                    success: function(data) {
                       window.location.href=data;

                
                }        
              })
            }
        })

    })
</script>
</body>

</html>
