<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];
$lista = $db->query("SELECT * FROM cad_escola WHERE id = '$usuario_id'  ");
$dados = $lista->fetchArray();
$nome_escola = $dados['nome'];           
?>

<div class="table-responsive" style="max-height: 400px;">
    <table class="table  table-sm table-hover" id="tabela-categorias" >
        <thead>
            <tr>
                <th>#</th>
                <th></th>
                <th>Título</th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
        <?php
            $ordem = 1;
            $lista = $db->query("SELECT * FROM cad_curso  WHERE id_escola = '$usuario_id'");
            while($dados = $lista->fetchArray()){
                $id = $dados['id'];
                $titulo = $dados['titulo'];
               
               
                ?>
                <th scope="row"><?php echo $ordem ?></th>
                <th>
                    <div class="radio-container">
                        <input class="" type="radio" name="categoria" data-id="<?php echo $id ?>" value="option1" >
                    
                    </div>
                </th>
                <td><?php echo $titulo ?></td>
               
                
            </tr>
              <?php
              $ordem++;
              }
              ?>                                             
        </tbody>
    </table>
    <div class="text-center">
        <center>
            <button class="btn waves-effect waves-light btn-info cadastrar" data-toggle="modal" data-target="#exampleModalCenter" style="width: 120px"><i class="ti-write"></i><br>cadastrar</button>

            <button class="btn waves-effect waves-light btn-success editar" style="width: 120px"><i class="ti-pencil-alt"></i><br>editar</button>

            <button class="btn waves-effect waves-light btn-danger excluir" style="width: 120px"><i class="ti-trash"></i><br>excluir</button>
        </center>

    </div>
</div>

<script>
    $(function(){
        $("#tabela-categorias tr").click(function() {
				$(this).find("input[type='radio']").prop("checked", true);
				$('#tabela-categorias tbody tr').removeClass('table-highlighted');
                
                // adicionar a classe de destaque à linha selecionada
                $(this).closest('#tabela-categorias tbody tr').addClass('table-highlighted');
			});  
    // ao clicar em um input radio
        $('input[name="categoria"]').on('change', function() {
                // remover a classe de destaque de todas as linhas
                $('#tabela-categorias tbody tr').removeClass('table-highlighted');
                
                // adicionar a classe de destaque à linha selecionada
                $(this).closest('#tabela-categorias tbody tr').addClass('table-highlighted');
            });
        
            $('.cadastrar').click(function(){
            $('.tabela').load('cursos/cad_curso.php');
        })
        

        $('.editar').on('click', function() {
            // verificar se um input radio foi selecionado
            if ($('input[name="categoria"]:checked').length === 0) {
                swal("Aviso!", 'Por favor, selecione uma categoria para editar.', "warning");
            
            return;
            }
            
            // obter o id da categoria selecionada
            var id = $('input[name="categoria"]:checked').data('id');

            $.ajax({
                    type: 'POST',
                    url: 'cursos/edita_curso.php',
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
                title: 'Excluir categoria?',
                text: "A exclusão não poderá ser revertida e todos os usuários deste setor também serão excluídos!",
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
                        url: 'cursos/excluir_curso.php',
                        data: {'id':id },
                        //se tudo der certo o evento abaixo é disparado
                        success: function(data) {
                            if(data == 1){
                                $('.tabela').load('cursos/tabela.php');
                                const notificacao = $('<div>', {
                                    'class': 'notificacao',
                                    'text': 'Categoria excluída com sucesso!'
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
             