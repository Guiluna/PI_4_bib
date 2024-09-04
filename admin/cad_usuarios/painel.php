<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];
$lista = $db->query("SELECT * FROM cad_escola WHERE id = '$usuario_id'  ");
$dados = $lista->fetchArray();
$nome_escola = $dados['nome'];           
?>
<style>
    input[type="radio"] {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  border: 2px solid #ccc;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  outline: none;
  cursor: pointer;
}

/* Estilo quando o input radio está marcado */
input[type="radio"]:checked {
  background-color: #8bc34a;
  border-color: #8bc34a;
}

/* Estilo do label do input radio */
.radio-label {
  display: inline-block;
  margin-left: 5px;
  font-size: 16px;
  color: #333;
}

/* Estilo do container que envolve o input radio e o label */
.radio-container {
  display: inline-block;
  vertical-align: middle;
  margin-right: 10px;
}
/* estilo para a linha destacada */
.table-highlighted {
  background-color: #00FFFF;
}

</style>
<!-- Page-header start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">Usuários</h5>
                    <p class="m-b-0">Cadastro, edição e exclusão de usuários.</p>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="painel.php"> <i class="fa fa-home f-20"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)"></a>
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
            <h5>Cadastro de Usuários</h5>
            
        </div>
        <div class="card-block typography">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="tabela">

                    </div>
                    <div class="text-center">
                        <center>
                            <button class="btn waves-effect waves-light btn-primary cadastrar" data-toggle="modal" data-target="#exampleModalCenter" style="width: 120px"><i class="ti-check-box"></i><br>cadastrar</button>

                            <button class="btn waves-effect waves-light btn-success editar" style="width: 120px"><i class="ti-pencil-alt"></i><br>editar</button>

                            <button class="btn waves-effect waves-light btn-danger excluir" style="width: 120px"><i class="ti-trash"></i><br>excluir</button>
                        </center>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalExemploTitulo" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalExemploTitulo">Editar usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="corpo_modal"></div>
      
    </div>
  </div>
</div>

<script>
    $(function(){
        $('.tabela').load('cad_usuarios/tabela.php');
        $('.cadastrar').click(function(){
            $('.tabela').load('cad_usuarios/cad_usuario.php');
        })
        

        $('.editar').on('click', function() {
            // verificar se um input radio foi selecionado
            if ($('input[name="categoria"]:checked').length === 0) {
                swal("Aviso!", 'Por favor, selecione um usuário para editar.', "warning");
            
            return;
            }
            
            // obter o id da categoria selecionada
            var id = $('input[name="categoria"]:checked').data('id');

            $.ajax({
                    type: 'POST',
                    url: 'cad_usuarios/edita_usuario.php',
                    data: {'id':id },
                    //se tudo der certo o evento abaixo é disparado
                    success: function(data) {
                        $('#modal').modal('show');
                        $('#corpo_modal').html(data)

                }       
            })
            
            // abrir o modal com o id da categoria selecionada
           
           
        });

        $('.excluir').click(function(e){
            e.preventDefault()
            // verificar se um input radio foi selecionado
            if ($('input[name="categoria"]:checked').length === 0) {
                swal("Aviso!", 'Por favor, selecione uma categoria para excluir.', "warning");
            
            return;
            }

            // obter o id da categoria selecionada
            var id = $('input[name="categoria"]:checked').data('id');
            
            swal({
                title: 'Excluir usuário?',
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
                        url: 'cad_usuarios/excluir_usuario.php',
                        data: {'id':id },
                        //se tudo der certo o evento abaixo é disparado
                        success: function(data) {
                            if(data == 1){
                                $(`input[name='categoria']:checked`).closest('tr').remove();
                                //$('.tabela').load('cad_usuarios/tabela.php');
                                const notificacao = $('<div>', {
                                    'class': 'notificacao',
                                    'text': 'Usuário excluído com sucesso!'
                                    }).appendTo('body');

                                    setTimeout(() => {
                                    notificacao.fadeOut('slow', () => {
                                        notificacao.remove();
                                    });
                                    }, 5000); // notificação dura 5 segundos (5000 milissegundos)
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