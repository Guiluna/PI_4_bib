<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];


  
?>
<style>
		.col-titulo:hover {
            color: red;
            cursor: pointer;
            font-weight: bold;
        }
	</style>

<form action="" id="form">
<div class="modal-body">
<div class="form-group row" >
    <div class="col-sm-12">
        <label class="float-label">Digite o título e depois click na lista abaixo para selecionar um acervo.</label>
        <br>
        <span style="color: red" class="alerta"></span>
        <div class="input-group">
            
            <input type="text" id="pesquisa_usuario" data-id="" class="form-control" placeholder="Digite o título do acervo">
            <div class="input-group-append">
				<button class="btn btn-primary" type="button" data-id=""  id="inserir_resultado">Inserir</button>
			</div>
           
        </div>
        <div  id="resultado-pesquisa"></div>
    </div>

</div>
</div>
</form>

<script>
    $(function(){
        $("#pesquisa_usuario").keyup(function() {
            $('.alerta').text('');
				var pesquisa = $(this).val();
				if (pesquisa != "") {
					$.ajax({
						url: "emprestimos/resultado_pesquisa_acervo.php",
						type: "POST",
						data: {pesquisa: pesquisa},
						success: function(data) {
							$("#resultado-pesquisa").html(data);
						}
					});
				} else {
					$("#resultado-pesquisa").empty();
				}
			});

            $(document).on("click", "#resultado-pesquisa td.titulo", function() {
                var titulo = $(this).text();
                var id = $(this).siblings(".id").text();
                $("#pesquisa_usuario").val(titulo);
                $("#inserir_resultado").data("id", id);
                $("#resultado-pesquisa").empty();

			});
            $(document).on("mouseenter", "#resultado-pesquisa td.titulo", function() {
                $(this).addClass("col-titulo");
            }).on("mouseleave", "#resultado-pesquisa td.titulo", function() {
                $(this).removeClass("col-titulo");
            });

            $('#inserir_resultado').click(function(){
                
                id= $(this).data('id');
                if( id != ''){                
                    
                    $("#titulo_acervo").data("id", id);
                    valor_nome = $("#pesquisa_usuario").val();
                    $("#titulo_acervo").val(valor_nome);
                    $('#modal').modal('hide')
                }else{
                    $('.alerta').text('Selecione um acervo na lista de pesquisa!');
                    
                }
               

            })
    })
</script>