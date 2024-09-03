<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];

  $id_user = $_POST['id'];
  $lista = $db->query("SELECT * FROM cad_usuario  WHERE id = '$id_user'");
$dados = $lista->fetchArray();
$nome = $dados['nome'];
$setor = $dados['setor'];

  
?>

<form action="" id="form">
<div class="modal-body">
<div class="form-group row" >
                <div class="col-sm-12">
                <label class="float-label">Nome do usuário</label>
                    <div class="form-group form-primary">
                        <input type="text" id="titulo" name="text" value="<?php echo $nome ?>" class="form-control" >
                        <span class="form-bar"></span>
                        
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group form-primary">
                        <select name="" id="setor" class="form-control">
                            
                            <?php
                             $lista = $db->query("SELECT * FROM cad_curso  WHERE id = '$setor'  ");
                             $dados = $lista->fetchArray();
                             $id = $dados['id'];
                             $nome = $dados['titulo'];
                            ?>
                            <option value="<?php echo $id ?>"><?php echo $nome ?></option>

                                            <?php
                                                    $lista = $db->query("SELECT * FROM cad_curso  WHERE id_escola = '$usuario_id' AND id != '$setor'  ORDER BY titulo");
                                                    while($dados = $lista->fetchArray()){
                                                        $id = $dados['id'];
                                                        $nome = $dados['titulo'];

                                                    ?>
                                                    <option value="<?php echo $id ?>"><?php echo $nome ?></option>

                                                    <?php
                                                    }
                                                    ?>
                        </select>
                    </div>
                </div>
                </div>
       
</div>
      <div class="modal-footer">
      <input type="hidden" id="id" value="<?php echo $id_user ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary salvar" >Salvar</button>
        
      </div>

</form>

<script>
$(function(){
    
    $(".salvar").click(function(event) {
            event.preventDefault(); //previne o comportamento padrão do formulário
            
            var titulo = $("#titulo").val();
            var id = $("#id").val();
            var setor = $("#setor").val();
            
        

            if(titulo == ''  ){
                swal("Aviso!", 'Preencha o título da categoria', "warning");
            }else {
            
                $.ajax({
                    type: "POST",
                    url: "cad_usuarios/salva_edita_usuario.php",
                    data: {'titulo':titulo, 'id':id,'setor':setor},
                    
                    success: function(response) {
                        if(response == 1){
                            $('.tabela').load('cad_usuarios/tabela.php');
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