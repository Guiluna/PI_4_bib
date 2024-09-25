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
     .pagination {
      display: inline-block;
    }
    .pagination a {
      color: black;
      float: left;
      padding: 8px 16px;
      text-decoration: none;
      transition: background-color .3s;
      border: 1px solid #ddd;
    }
    .pagination a.active {
      background-color: #4CAF50;
      color: white;
      border: 1px solid #4CAF50;
    }
    .pagination a:hover:not(.active) {
      background-color: #ddd;
    }

  .pagination .btn-circle {
  width: 40px;
  height: 40px;
  padding: 5;
  margin: 5px;
  font-size: 16px;
  
  border-radius: 50%;
}

.pagination .btn-circle.active {
  background-color: #007bff;
  border-color: #007bff;
  color: white;
}

.pagination .btn-circle:hover {
  background-color: #007bff;
  border-color: #007bff;
  color: white;
}
.pagination .btn-nav {  
  background-color: green;
  width: 70px;
  height: 40px;
  padding: 10px;
  font-size: 12px;
  line-height: 1.428571429;
  align-items: center;
  justify-content: center;
  color: white;
}

.pagination .btn-nav:hover {
  background-color: #4CAF50;
  border-color: #007bff;
  color: white;
}
#tabela-categorias{
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
}
#tabela-categorias th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
      }
#tabela-categorias      th {
        background-color: #f2f2f2;
        font-weight: bold;
      }
#tabela-categorias tr:nth-child(even) {
        background-color: #f2f2f2;
      }
  </style>
<div class="card-header">
    <h5>Devoluções Pendentes</h5>
    
</div>
<div class="form-group ">
    <input type="text" id="campoPesquisa" name="text" class="form-control" placeholder="pesquisar" >
                       
</div>
<div class="table-responsive" >
    <table class=" table-sm table-hover" id="tabela-categorias" >
        <thead>
            <tr>
                <th>#</th>
                <th></th>
                <th>Usuário</th>
                <th>Título</th>
                <th>Empréstimo</th>
                <th>Prazo</th>
                <th>Ano</th>
                <th>Mês</th>
            </tr>
        </thead>
        <tbody>
            
        <?php

                    function mesPorExtenso($mes) {
                        $meses = [
                            1 => "Janeiro",
                            2 => "Fevereiro",
                            3 => "Março",
                            4 => "Abril",
                            5 => "Maio",
                            6 => "Junho",
                            7 => "Julho",
                            8 => "Agosto",
                            9 => "Setembro",
                            10 => "Outubro",
                            11 => "Novembro",
                            12 => "Dezembro"
                        ];

                        if ($mes >= 1 && $mes <= 12) {
                            return $meses[$mes];
                        } else {
                            return "Mês inválido";
                        }
                    }

            $ordem = 1;
            $lista = $db->query("SELECT * FROM cad_emprestimo  WHERE id_escola = '$usuario_id' AND devolvido_em='' ORDER BY mes,ano DESC ");
            while($dados = $lista->fetchArray()){
                $id = $dados['id'];
                $id_acervo = $dados['id_acervo'];
                $id_usuario = $dados['id_usuario'];
                $data_atual = $dados['data_atual'];
                $data_devolucao = $dados['data_devolucao'];
                $devolvido_em = $dados['devolvido_em'];
                $hora = $dados['hora'];
                $ano = $dados['ano'];
                $mes = $dados['mes'];

                $lista2 = $db->query("SELECT * FROM cad_acervo  WHERE id = '$id_acervo'");
                $dados2 = $lista2->fetchArray();
                $titulo = $dados2['titulo'];

                $nomeDoMes = mesPorExtenso($mes);
                $cor_linha = '';
                $devolvido = '';

               
                ?>
                <tr>
                <th scope="row"><?php echo $ordem ?></th>
                <td>
                    <div class="radio-container">
                        <input class="" type="radio" name="categoria" data-id="<?php echo $id ?>" value="option1" >
                    
                    </div>
                </td>
                <td>
                    <?php 
                    
                    $lista2 = $db->query("SELECT * FROM cad_usuario  WHERE id = '$id_usuario' ");
                        $dados2 = $lista2->fetchArray();
                        $nome = $dados2['nome'];
                        echo $nome
                    ?>
                
                </td>
                <td><?php echo $titulo ?></td>
                
                <td><?php echo $data_atual ?></td>
                <td><?php echo $data_devolucao ?></td>
               
                <td><?php echo $ano ?></td>
                <td><?php echo $nomeDoMes ?></td>
                
                
            </tr>
              <?php
              $ordem++;
              }
              ?>                                             
        </tbody>
    </table>
</div>
<div id="pagination-container"></div>
<div class="text-center">
    <center>
        <button class="btn waves-effect waves-light btn-info novo"  style="width: 120px"><i class="ti-write"></i><br>Novo</button>
        <button class="btn waves-effect waves-light btn-primary historico" style="width: 120px"><i class="ti-list"></i><br>Historico</button>
        <button class="btn waves-effect waves-light btn-success devolver" style="width: 120px"><i class="ti-check-box"></i><br>Devolver</button>
    </center>
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

    $("#campoPesquisa").on("keyup", function () {
        const filtro = $(this).val().toUpperCase();
        $("#tabela-categorias tbody tr").each(function () {
            const textoLinha = $(this).text().toUpperCase();
            if (textoLinha.indexOf(filtro) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    const tabela = $('#tabela-categorias');
    const itensPorPagina = 10;
    const linhas = tabela.find('tbody tr');
    const numPaginas = Math.ceil(linhas.length / itensPorPagina);
    const containerPaginacao = $('#pagination-container');

    function renderizarPaginacao() {
            containerPaginacao.empty();
            const ul = $('<ul>').addClass('pagination').appendTo(containerPaginacao);

            // Botão "Anterior"
            const liPrev = $('<li>').addClass('page-item').appendTo(ul);
            $('<a>').addClass('page-link btn-nav')
                .attr('href', 'javascript:void(0);')
                .text('Anterior')
                .on('click', function () {
                const paginaAtual = containerPaginacao.find('a.active').text();
                if (parseInt(paginaAtual) > 1) {
                    irParaPagina(parseInt(paginaAtual) - 1);
                }
                })
                .appendTo(liPrev);

            // Botões de página
            const numBotaoVisivel = 5; // Número máximo de botões de página visíveis
            for (let i = 1; i <= numPaginas; i++) {
                const li = $('<li>').addClass('page-item').css('display', i <= numBotaoVisivel ? 'inline' : 'none').appendTo(ul);
                $('<a>').addClass('page-link btn-circle')
                .attr('href', 'javascript:void(0);')
                .text(i)
                .on('click', function () {
                    irParaPagina(i);
                })
                .appendTo(li);
            }

            // Botão "Próximo"
            const liNext = $('<li>').addClass('page-item').appendTo(ul);
            $('<a>').addClass('page-link btn-nav')
                .attr('href', 'javascript:void(0);')
                .text('Próximo')
                .on('click', function () {
                const paginaAtual = containerPaginacao.find('a.active').text();
                if (parseInt(paginaAtual) < numPaginas) {
                    irParaPagina(parseInt(paginaAtual) + 1);
                }
                })
                .appendTo(liNext);
            }


            function irParaPagina(pagina) {
                const inicio = (pagina - 1) * itensPorPagina;
                const fim = inicio + itensPorPagina;
                linhas.hide().slice(inicio, fim).show();
                containerPaginacao.find('a').removeClass('active');
                containerPaginacao.find('a.btn-circle').eq(pagina - 1).addClass('active');

                // Atualizar a visibilidade dos botões de página
                const numBotaoVisivel = 5; // Número máximo de botões de página visíveis
                const metadeVisivel = Math.floor(numBotaoVisivel / 2);
                const inicioVisivel = Math.max(1, pagina - metadeVisivel);
                const fimVisivel = Math.min(numPaginas, inicioVisivel + numBotaoVisivel - 1);

                containerPaginacao.find('a.btn-circle').each(function (index) {
                    if (index + 1 >= inicioVisivel && index + 1 <= fimVisivel) {
                    $(this).parent().css('display', 'inline');
                    } else {
                    $(this).parent().css('display', 'none');
                    }
                });
                }

        if(numPaginas > 1){
        renderizarPaginacao();
        irParaPagina(1);
        }        

        $(".devolvido_em").datepicker({
            showButtonPanel: true,
            dateFormat: "dd/mm/yy",
            onSelect: function(dateText, inst) {
                // Atualiza o valor do campo input com a data escolhida
                $(this).val(dateText);

                const id = $(this).data("id");
                const novaData = dateText;
                

                $.ajax({
                    url: "emprestimos/devolucao.php",
                    type: "POST",
                    data: {
                        id: id,
                        novaData: novaData
                    },
                    success: function(response) {
                       if(response == 1){
                        swal(
                                'Baixado!',
                                'Acervo devolvido com sucesso!',
                                'success'
                            )
                       }else{
                        alert(response);
                       }
                    }
                });
            }
        });

        $('.novo').click(function() { 
        $(this).hide();
        $('.pesquisar').hide();
        $('.salvar').show();
        $('.cancelar1').show(); 
        $('.editar').hide();
        $('.excluir').hide();
        $('.tabela').load('emprestimos/cad_emprestimo.php');
        
        
    });

    $('.devolver').click(function(e){
        e.preventDefault()
        // verificar se um input radio foi selecionado
        if ($('input[name="categoria"]:checked').length === 0) {
            swal("Aviso!", 'Por favor, selecione uma item para excluir.', "warning");
        
        return;
        }

        // obter o id da categoria selecionada
        var id = $('input[name="categoria"]:checked').data('id');
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        var novaData = day.toString().padStart(2,'0') + '/' + month.toString().padStart(2,'0') + '/' + year;
        
        swal({
            title: 'Devolver item do acervo?',
            text: "A devolução não poderá ser revertida!",
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
        }).then((Devolver) => {
            if (Devolver) {
                                

            $.ajax({
                    type: 'POST',
                    url: 'emprestimos/devolucao.php',
                    data: {'id':id, 'novaData' :novaData},
                    //se tudo der certo o evento abaixo é disparado
                    success: function(data) {
                        if(data == 1){
                            $(`input[name='categoria']:checked`).closest('tr').remove();
                            // $('.tabela').load('emprestimos/tabela.php')
                            const notificacao = $('<div>', {
                                'class': 'notificacao',
                                'text': 'Acervo devolvido com sucesso!'
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
    $('.historico').click(function(){
        $('.tabela').load('emprestimos/historico.php')
    })
    })
</script>
             