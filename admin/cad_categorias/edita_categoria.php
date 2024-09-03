<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];

  $id = $_POST['id'];
  $lista = $db->query("SELECT * FROM cad_categoria  WHERE id = '$id'");
$dados = $lista->fetchArray();
$titulo = $dados['titulo'];

  
?>

<form action="" id="form">
<div class="modal-body">
        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="form-group form-primary">
                                    <input type="text" id="titulo" name="text" class="form-control" value="<?php echo $titulo ?>" >
                                    <span class="form-bar"></span>
                                    <label class="float-label">Título da categoria</label>
                                </div>
                            </div>
    </div>
       
</div>
      <div class="modal-footer">
      <input type="hidden" id="id" value="<?php echo $id ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary salvar" >Salvar</button>
        
      </div>

</form>

<script>
$(function(){
    
    $(".salvar").click(function(event) {
            event.preventDefault(); //previne o comportamento padrão do formulário
            
            var titulo = $("#titulo").val();
            var id = $("#id").val();
            
        

            if(titulo == ''  ){
                swal("Aviso!", 'Preencha o título da categoria', "warning");
            }else {
            
                $.ajax({
                    type: "POST",
                    url: "cad_categorias/salva_edita_categoria.php",
                    data: {'titulo':titulo, 'id':id},
                    
                    success: function(response) {
                        if(response == 1){
                            $('.tabela').load('cad_categorias/tabela.php');
                            $('#modal').modal('hide');
                          
                           
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


})
</script>