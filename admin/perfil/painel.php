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
                    <h5 class="m-b-10">Dados da Instituição</h5>
                    <p class="m-b-0">Edição do perfil da instituição</p>
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
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
    <div class="card">
        <div class="card-header">
            <h5>Editar o Perfil da Instituição</h5>
            <br><br>
           
        </div>
        <div class="card-block typography quadro">
            <form action="" id="form" class="">
                <div class="form-group row">
                    <div class="col-sm-6">
                                <div class="form-group form-primary">
                                    <input type="text" id="nome" name="text" class="form-control" value="<?php echo $nome_escola ?>" >
                                    <span class="form-bar"></span>
                                    <label class="float-label">Nome da Instituição</label>
                                </div>
                    </div>
                   
                </div>
                <div class="form-group row">
                            <div class="col-sm-12">
                                <button class="btn btn-danger excluir">Excluir</button>
                                <input type="submit" class="btn btn-success" value="Salvar edição">
                            </div>
                        </div>
            </form>

        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<script>
$(function(){
    
    $("#form").submit(function(event) {
            event.preventDefault(); //previne o comportamento padrão do formulário
            var data = new FormData();
            var nome = $("#nome").val();
           
           
            data.append("nome", nome);
            
           

            if(nome == ''  ){
                swal("Aviso!", 'Preencha o nome da instituição', "warning");
            }else {
            
                $.ajax({
                    type: "POST",
                    url: "perfil/salva_edita_escola.php",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response == 1){
                            $('.corpo').load('perfil/painel.php')
                          
                            swal(
                                'Cadastro!',
                                'Cadastro editado com sucesso!',
                                'success'
                            )
                        }else{
                            swal("Aviso!", response, "warning");
                        }
                        
                    },
                        error: function(response) {
                        alert("Erro ao salvar dados");
                    }
                });
            }
        });



        $('.excluir').click(function(e){
            e.preventDefault()
            id = $(this).data('id');
            
            swal({
                title: 'Excluir esta escola?',
                text: "A exclusão não poderá ser revertida!",
                type: 'warning',
                buttons:{
                    confirm: {
                        text : 'Sim!',
                        className : 'btn btn-success'
                    },
                    cancel: {
                        visible: true,
                        text : 'Cancelar!',
                        className: 'btn btn-danger'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                                   

                $.ajax({
                        type: 'POST',
                        url: 'perfil/excluir_escola.php',
                        data: {'id':id },
                        //se tudo der certo o evento abaixo é disparado
                        success: function(data) {
                            if(data == 1){
                                window.location.href="../index.php";
                               }else{
                                swal(data, {
                                buttons: {        			
                                    confirm: {
                                        className : 'btn btn-warning'
                                    }
                                },
					        });
                            }
                    
                        }        
                    })
                } else {
                    swal.close();
                }
            });
        })




})
</script>
