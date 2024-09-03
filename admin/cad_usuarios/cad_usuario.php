<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];

 

  
?>
<h4>Novo cadastro</h4>
<form action="" id="form">
            <div class="form-group row" >
                <div class="col-sm-5">
                    <div class="form-group form-primary">
                        <input type="text" id="titulo" name="text" class="form-control" >
                        <span class="form-bar"></span>
                        <label class="float-label">Nome do usuário</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group form-primary">
                        <select name="" id="setor" class="form-control">
                            <option value="">Selecione um setor</option>
                                            <?php
                                                    $lista = $db->query("SELECT * FROM cad_curso  WHERE id_escola = '$usuario_id'  ORDER BY titulo");
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
                <div class="col-sm-3 ">
                        <button type="button" class="btn btn-secondary cancelar" >Retornar</button>
                        <input type="submit" class="btn btn-success" value="Salvar">
                </div>
                
            </div>
            <div class="form-group row" >
                
            </div>
                
            
</form>

<script>
    $(function(){
        $('.cancelar').click(function(){
            $('.tabela').load('cad_usuarios/tabela.php');
        })
        $("#form").submit(function(event) {
            event.preventDefault(); //previne o comportamento padrão do formulário
            var data = new FormData();
            var titulo = $("#titulo").val();
            var setor = $("#setor").val();
            
           
            data.append("titulo", titulo);
            data.append("setor", setor);
          
           

            if(titulo == '' || setor == ''){
                swal("Aviso!", 'Preencha ou selecione todos os campos!', "warning");
            }else {
            
                $.ajax({
                    type: "POST",
                    url: "cad_usuarios/salva_usuario.php",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response == 1){
                            $('#titulo').val('');
                          
                            swal(
                                'Cadastro!',
                                'Cadastro salvo com sucesso!',
                                'success'
                            )
                        }else{
                            swal("Aviso!", response, "warning");
                        }
                        
                    },
                        error: function(response) {
                        swal("Aviso!", "Erro ao salvar dados", "warning");
                        
                    }
                });
            }
        });
       
    })
</script>