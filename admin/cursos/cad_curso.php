<h4>Novo cadastro</h4>
<form action="" id="form">
            <div class="form-group row" >
                <div class="col-sm-6">
                    <div class="form-group form-primary">
                        <input type="text" id="titulo" name="text" class="form-control" >
                        <span class="form-bar"></span>
                        <label class="float-label">Título do(a) curso/turma/setor</label>
                    </div>
                </div>
                <div class="col-sm-6 ">
                        <button type="button" class="btn btn-secondary cancelar" >Retornar</button>
                        <input type="submit" class="btn btn-success" value="Salvar">
                </div>
            </div>
                
            
</form>

<script>
    $(function(){
        $('.cancelar').click(function(){
            $('.tabela').load('cursos/tabela.php');
        })
        $("#form").submit(function(event) {
            event.preventDefault(); //previne o comportamento padrão do formulário
            var data = new FormData();
            var titulo = $("#titulo").val();
            
           
            data.append("titulo", titulo);
          
           

            if(titulo == '' ){
                swal("Aviso!", 'Descreva o título!', "warning");
            }else {
            
                $.ajax({
                    type: "POST",
                    url: "cursos/salva_curso.php",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response == 1){
                            $('#titulo').val('');
                          
                            swal(
                                'Cadastrado!',
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