<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];


  
?>
<style>
		#resultado-pesquisa li:hover {
			cursor: pointer;
		}
	</style>

<form action="" id="form">
<div class="modal-body">
<div class="form-group row" >
    <div class="col-sm-12">
        <label class="float-label">Digite o nome e depois click na lista abaixo para selecionar um usuário.</label>
        <br>
        <span style="color: red" class="alerta"></span>
        <div class="input-group">
            
            <input type="text" id="pesquisa_usuario" data-id="" class="form-control" placeholder="Digite o nome do usuário">
            <div class="input-group-append">
				<button class="btn btn-primary" type="button" data-id=""  id="inserir_resultado">Inserir</button>
			</div>
           
        </div>
        <ul id="resultado-pesquisa"></ul>
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
						url: "emprestimos/resultado_pesquisa_usuario.php",
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

            $(document).on("click", "#resultado-pesquisa li", function() {
                $('.alerta').text('');
				var id_usuario = $(this).attr("id");
                $("#inserir_resultado").data("id", id_usuario);
				var nome_usuario = $(this).text();
				$("#pesquisa_usuario").val(nome_usuario);
				$("#resultado-pesquisa").empty();

			});
            $('#inserir_resultado').click(function(){
                
                
                id= $(this).data('id');
                if( id != ''){                
                    
                    $("#nome_usuario").data("id", id);
                    valor_nome = $("#pesquisa_usuario").val();
                    $("#nome_usuario").val(valor_nome);
                    $('#modal').modal('hide')
                }else{
                    $('.alerta').text('Selecione um usuário na lista de pesquisa!');
                    
                }

            })
    })
</script>