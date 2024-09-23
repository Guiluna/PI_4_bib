<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];

$lista = $db->query("SELECT * FROM cad_escola  WHERE id = '$usuario_id'");
$dados = $lista->fetchArray();
$titulo = $dados['nome'];

  
?>

<form action="" id="form">
<div class="modal-body">
    <div class="form-group row">
        <div class="col-sm-12">
            <div class="form-group form-primary">
                <input type="text" id="titulo" name="text" class="form-control" value="<?php echo $titulo ?>" >
                <span class="form-bar"></span>
                <label class="float-label">Nome da Escola</label>
            </div>
        </div>
    </div>  
</div>
      <div class="modal-footer">
      <input type="hidden" id="id" value="<?php echo $usuario_id ?>">
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
                swal("Aviso!", 'Preencha o título!', "warning");
            }else {
            
                $.ajax({
                    type: "POST",
                    url: "perfil/salva_edita_escola.php",
                    data: {'nome':titulo},
                    
                    success: function(response) {
                        if(response == 1){
                            location.reload();
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