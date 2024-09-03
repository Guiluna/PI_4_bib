<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];

$id_empres = $_POST['id'];
$lista = $db->query("SELECT * FROM cad_emprestimo  WHERE id = '$id_empres'");
$dados = $lista->fetchArray();
$id_usuario = $dados['id_usuario'];
$id_acervo = $dados['id_acervo'];
$hora = $dados['hora'];
$data_atual = $dados['data_atual'];
$data_devolucao = $dados['data_devolucao'];
$devolvido_em = $dados['devolvido_em'];

$lista = $db->query("SELECT * FROM cad_usuario  WHERE id = '$id_usuario'");
$dados = $lista->fetchArray();
$nome = $dados['nome'];

$lista = $db->query("SELECT * FROM cad_acervo  WHERE id = '$id_acervo'");
$dados = $lista->fetchArray();
$titulo = $dados['titulo'];
  
?>

<form action="" id="form">

<div class="form-group row" >
    <div class="col-sm-12">
        <label class="float-label">Nome do usuário</label>
            <div class="input-group">
					<input type="text" id="nome_usuario" data-id="<?php echo $id_usuario ?>" value="<?php echo $nome ?>" class="form-control" readonly>
					<div class="input-group-append">
						<button class="btn btn-primary" type="button" id="botao-pesquisa">Buscar</button>
					</div>
			</div>
    </div>
    <div class="col-sm-12">
        <label class="float-label">Título do acervo</label>
            <div class="input-group">
					<input type="text" id="titulo_acervo" data-id="<?php echo $id_acervo ?>" value="<?php echo $titulo ?>" class="form-control" readonly>
					<div class="input-group-append">
						<button class="btn btn-success" type="button" id="botao-pesquisa_acervo">Buscar</button>
					</div>
			</div>
    </div>
    <div class="col-sm-3">
        <label class="float-label">Data atual</label>
        <?php 
        $data = '';

        ?>
            <div class="input-group">
					<input type="text" class="form-control" id="data_atual" value="<?php echo $data_atual ?>" name="data_atual" readonly>
			</div>
    </div>
    <div class="col-sm-3">
        <label class="float-label">Data para devolução</label>
        <div class="input-group">
        <input type="text" id="data_escolhida" name="data_escolhida" class="form-control" value="<?php echo $data_devolucao ?>" readonly>
        
      </div>
     
        
    </div>
    <div class="col-sm-3">
        <label class="float-label">Hora do empréstimo</label>
        <div class="input-group">
        <input type="text" id="hora_emprestimo" name="hora_emprestimo" value="<?php echo $hora ?>" class="form-control" readonly>
        
      </div>
          
        
    </div>
    <div class="col-sm-12">
        <input type="hidden" id="id" value="<?php echo $id_empres ?>">
        <button class="btn waves-effect waves-light btn-primary salva_edicao"  style="width: 120px"><i class="ti-check-box"></i><br>Salvar edição</button>
        <button class="btn waves-effect waves-light btn-default cancela_edicao"  style="width: 120px"><i class="ti-check-box"></i><br>Cancelar</button>
        
      </div>


</div>
</form>
<script>
    $(function(){
        $('.cancela_edicao').click(function(e){
            e.preventDefault();
            $('.pesquisar').show();
            $('.novo').show();
            $('.editar').show();
            $('.excluir').show();
            $('.tabela').load('emprestimos/tabela.php')
        })
        function formatTime(date) {
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');
        return `${hours}:${minutes}:${seconds}`;
      }
    

    
		$("#botao-pesquisa").click(function() {
            
                $.ajax({
                        type: 'POST',
                        url: 'emprestimos/pesquisa.php',
                        //data: {'id':id },
                        //se tudo der certo o evento abaixo é disparado
                        success: function(data) {
                            $('#modal').modal('show');
                            $('#corpo_modal').html(data)

                    }       
                })

				
			});

            $("#botao-pesquisa_acervo").click(function() {
            
            $.ajax({
                    type: 'POST',
                    url: 'emprestimos/pesquisa_acervo.php',
                    //data: {'id':id },
                    //se tudo der certo o evento abaixo é disparado
                    success: function(data) {
                        $('#modal').modal('show');
                        $('#corpo_modal').html(data)

                }       
            })

            
        });
        var hoje = new Date();
        var dia = hoje.getDate();
        var mes = hoje.getMonth()+1; //Adicionar 1, já que o valor de janeiro é 0
        var ano = hoje.getFullYear();

        //Coloca a data no formato DD/MM/AAAA
        if(dia<10){
            dia='0'+dia;
        } 
        if(mes<10){
            mes='0'+mes;
        } 

        var dataFormatada = dia+'/'+mes+'/'+ano;

        //Pega o input pelo ID e coloca a data nele
        //$('#data_atual').val(dataFormatada);
        
        var dataAtual = new Date();
        var dataFutura = new Date(dataAtual.getTime() + (7 * 24 * 60 * 60 * 1000));
        var dia = dataFutura.getDate().toString().padStart(2, '0');
        var mes = (dataFutura.getMonth() + 1).toString().padStart(2, '0');
        var ano = dataFutura.getFullYear();
        var dataFormatada2 = dia + '/' + mes + '/' + ano;
        //$('#data_escolhida').val(dataFormatada2);
        

        $( "#data_escolhida" ).datepicker({
            showButtonPanel: true,
            dateFormat: "dd/mm/yy",
                onSelect: function(dateText, inst) {
                var date = $(this).datepicker('getDate');
                var day = date.getDate().toString().padStart(2, '0');
                var month = (date.getMonth() + 1).toString().padStart(2, '0');
                var year = date.getFullYear();
                var formattedDate = day + '/' + month + '/' + year;
                $(this).val(formattedDate);
                }
        });
        $( "#data_atual" ).datepicker({
            showButtonPanel: true,
            dateFormat: "dd/mm/yy"
        });

        const currentTime = formatTime(new Date());
        $('#hora_emprestimo').val(currentTime);

        $('.salva_edicao').click(function(e) { 
            e.preventDefault();
            id=$('#id').val();
             id_usuario = $('#nome_usuario').data('id');
             id_acervo = $('#titulo_acervo').data('id');
             data_atual = $('#data_atual').val();
             data_devolucao = $('#data_escolhida').val();
             hora_atual = $('#hora_emprestimo').val();
             const dataAtual = stringToDate($('#data_atual').val());
             const dataPosterior = stringToDate($('#data_escolhida').val());

             if (dataAtual > dataPosterior) {
                swal("Aviso!", 'A data atual não pode ser maior que a data posterior!', "warning");
                
            }else if(id_acervo == ''){
                swal("Aviso!", 'Selecione um acervo para emprétimo!', "warning");
            }else if(id_usuario == ''){
                swal("Aviso!", 'Selecione um usuário!', "warning");
            }else{
                $.ajax({
                    type: 'POST',
                    url: 'emprestimos/salva_edita_emprestimo.php',
                    data: {'id_usuario':id_usuario,'id_acervo':id_acervo,'data_atual':data_atual,'data_devolucao':data_devolucao,'hora_atual':hora_atual,'id':id },
                    //se tudo der certo o evento abaixo é disparado
                    success: function(data) {
                       if(data == 1){
                        $('.pesquisar').show();
                        $('.novo').show();
                        $('.editar').show();
                        $('.excluir').show();
                        $('.tabela').load('emprestimos/tabela.php');
                        swal(
                                'Editado!',
                                'Empréstimo editado com sucesso!',
                                'success'
                            )
                       }else{
                        swal("Aviso!", data, "warning");
                       }

                }       
            })

            }
            
             
                
               
            
             
        });
    })
</script>


