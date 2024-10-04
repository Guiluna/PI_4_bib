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
  </style>

<div class="form-group ">
    <input type="text" id="campoPesquisa" name="text" class="form-control" placeholder="pesquisar" >
                       
</div>
<div class="table-responsive" >
    <table class="table table-sm table-hover" id="tabela-categorias" >
        <thead>
            <tr>
                <th>#</th>
                <th></th>
                <th>Nome</th>
                <th>Setor</th>
                <th>Idade</th>
            </tr>
        </thead>
        <tbody>
            <tr>
        <?php
            $ordem = 1;
            $lista = $db->query("SELECT * FROM cad_usuario  WHERE id_escola = '$usuario_id' ORDER BY nome");
            while($dados = $lista->fetchArray()){
                $id = $dados['id'];
                $nome = $dados['nome'];
                $setor = $dados['setor'];
                $data_nasc = $dados['data_nascimento'];
               
                ?>
                <th scope="row"><?php echo $ordem ?></th>
                <th>
                    <div class="radio-container">
                        <input class="" type="radio" name="categoria" data-id="<?php echo $id ?>" value="option1" >
                    
                    </div>
                </th>
                <td><?php echo $nome ?></td>
                <td>
                    <?php 
                    
                    $lista2 = $db->query("SELECT * FROM cad_curso  WHERE id = '$setor' ");
                        $dados2 = $lista2->fetchArray();
                        $titulo = $dados2['titulo'];
                        echo $titulo;
                    ?>
                
                </td>
                <td>
                    <?php
                     $arr = explode('/', $data_nasc, 3);
                     $dia = (int)$arr[0];
                     $mes = (int)$arr[1];
                     $ano = (int)$arr[2];
                     $birthday = mktime (0,0,0,$mes,$dia,$ano);
                     $age = floor((time() - $birthday) / 31556926);
                     echo $age;
                    ?>
                </td>
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
        <button class="btn waves-effect waves-light btn-info cadastrar" data-toggle="modal" data-target="#exampleModalCenter" style="width: 120px"><i class="ti-write"></i><br>cadastrar</button>

        <button class="btn waves-effect waves-light btn-success editar" style="width: 120px"><i class="ti-pencil-alt"></i><br>editar</button>

        <button class="btn waves-effect waves-light btn-danger excluir" style="width: 120px"><i class="ti-trash"></i><br>excluir</button>
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


        renderizarPaginacao();
        irParaPagina(1);
        
        $('.cadastrar').click(function(){
            $('.tabela').load('cad_usuarios/cad_usuario.php');
        })
        

        $('.editar').on('click', function() {
            // verificar se um input radio foi selecionado
            if ($('input[name="categoria"]:checked').length === 0) {
                swal("Aviso!", 'Por favor, selecione um usuário para editar.', "warning");
            
            return;
            }
            
            // obter o id da categoria selecionada
            var id = $('input[name="categoria"]:checked').data('id');

            $.ajax({
                    type: 'POST',
                    url: 'cad_usuarios/edita_usuario.php',
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
                title: 'Excluir usuário?',
                text: "A exclusão não poderá ser revertida!",
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
                        url: 'cad_usuarios/excluir_usuario.php',
                        data: {'id':id },
                        //se tudo der certo o evento abaixo é disparado
                        success: function(data) {
                            if(data == 1){
                                $(`input[name='categoria']:checked`).closest('tr').remove();
                                //$('.tabela').load('cad_usuarios/tabela.php');
                                const notificacao = $('<div>', {
                                    'class': 'notificacao',
                                    'text': 'Usuário excluído com sucesso!'
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
             