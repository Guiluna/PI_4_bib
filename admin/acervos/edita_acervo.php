<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];

  $id_acervo = $_POST['id'];
  $lista = $db->query("SELECT * FROM cad_acervo  WHERE id = '$id_acervo'");
$dados = $lista->fetchArray();
$titulo = $dados['titulo'];
$isbn = $dados['isbn'];
$autor = $dados['autor'];
$quantidade = $dados['quantidade'];
$ano = $dados['ano'];
$editora = $dados['editora'];
$tipo = $dados['tipo'];
$setor = $dados['setor'];
$estante = $dados['estante'];
$prateleira = $dados['prateleira'];
$sinopse = $dados['sinopse'];
$categoria = $dados['categoria'];

 
?>

<div class="p-4">
<form action="" id="form">
            <div class="form-group row" >
                <div class="col-md-12">
                    <div class="form-group form-primary">
                        <label class="float-label">Título</label>
                        <input type="text" id="titulo" name="text" class="form-control" value="<?php echo $titulo ?>" >
                        <span class="form-bar"></span>
                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group form-primary">
                        <label class="float-label">Autor</label>
                        <input type="text" id="autor" name="text" class="form-control" value="<?php echo $autor ?>" > 
                        <span class="form-bar"></span>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-primary">
                        <label class="float-label">Quantidade</label>
                        <input type="number" id="quantidade" name="quant" class="form-control" value="<?php echo $quantidade ?>" > 
                        <span class="form-bar"></span>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-primary">
                        <label class="float-label">Ano</label>
                        <input type="text" id="ano" name="text" class="form-control" value="<?php echo $ano ?>" > 
                        <span class="form-bar"></span>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-primary">
                        <label class="float-label">ISBN</label>
                        <input type="text" id="isbn" name="text" class="form-control" value="<?php echo $isbn ?>" > 
                        <span class="form-bar"></span>
                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group form-primary">
                        <label class="float-label">Editora</label>
                        <input type="text" id="editora" name="text" class="form-control" value="<?php echo $editora ?>" > 
                        <span class="form-bar"></span>
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-primary">
                    <label class="float-label">Categoria</label>
                        <select name="" id="tipo" class="form-control">
                            
                            <option><?php echo $tipo ?></option>
                            <option>Livro</option>
                            <option>Revista</option>
                            <option>Coleção</option>
                            <option>Jornal</option>
                            <option>Gibi</option>
                            <option>Outros</option>
                                            
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-primary">
                    <label class="float-label">Área do conhecimento</label>
                        <select name="" id="categoria" class="form-control">

                           <?php
                                                    $lista = $db->query("SELECT * FROM cad_categoria  WHERE id = '$categoria' ");
                                                    $dados = $lista->fetchArray();
                                                        $id = $dados['id'];
                                                        $nome = $dados['titulo'];

                                                    ?>
                                                    <option value="<?php echo $id ?>"><?php echo $nome ?></option>

                                                    
                                            <?php
                                                    $lista = $db->query("SELECT * FROM cad_categoria  WHERE id_escola = '$usuario_id'  ORDER BY titulo");
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
                <div class="form-group row" >
                    <div class="col-md-12">
                        LOCALIZAÇÃO
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-primary">
                            <label class="float-label">Setor</label>
                            <input type="text" id="setor" name="text" class="form-control" value="<?php echo $setor ?>" > 
                            <span class="form-bar"></span>
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-primary">
                            <label class="float-label">Estante</label>
                            <input type="text" id="estante" name="text" class="form-control" value="<?php echo $estante ?>" > 
                            <span class="form-bar"></span>
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-primary">
                            <label class="float-label">Prateleira</label>
                            <input type="text" id="prateleira" name="text" class="form-control" value="<?php echo $prateleira ?>" > 
                            <span class="form-bar"></span>
                            
                        </div>
                    </div>

                </div>
                <div class="form-group row" >
                <div class="col-md-12">
                    <div class="form-group form-primary">
                    <label class="float-label">Sinopse</label>
                        <textarea name=""  id="sinopse" class="form-control" cols="30" rows="5"><?php echo $sinopse ?></textarea>
                    </div>
                </div>
                
                <div class="form-group form-primary">
                        <br>
                        <input type="hidden" id="id" value="<?php echo $id_acervo ?>">
                        <button type="button" class="btn btn-secondary cancelar" data-dismiss="modal"  >Retornar</button>
                        <input type="submit" class="btn btn-success"  value="Salvar">
                    </div>
                
                
            </div>
          
                
            
</form>
</div>
<script>
    $(function(){
        $('.cancelar').click(function(){
            $('.tabela').load('acervos/tabela.php');
        })
        $("#form").submit(function(event) {
            event.preventDefault(); //previne o comportamento padrão do formulário
            var data = new FormData();
            var titulo = $("#titulo").val();
            var autor = $("#autor").val();
            var quantidade = $("#quantidade").val();
            var ano = $("#ano").val();
            var editora = $("#editora").val();
            var tipo = $("#tipo").val();
            var setor = $("#setor").val();
            var estante = $("#estante").val();
            var prateleira = $("#prateleira").val();
            var sinopse = $("#sinopse").val();
            var categoria = $("#categoria").val();
            var isbn = $("#isbn").val();
            var id = $("#id").val();


            data.append("id", id);
            data.append("isbn", isbn);
            data.append("titulo", titulo);
            data.append("autor", autor);
            data.append("quantidade", quantidade);
            data.append("ano", ano);
            data.append("editora", editora);
            data.append("tipo", tipo);
            data.append("setor", setor);
            data.append("estante", estante);
            data.append("prateleira", prateleira);
            data.append("sinopse", sinopse);
            data.append("categoria", categoria);


          
           

            if(titulo == ''){
                swal("Aviso!", 'Descreva o título do acervo!', "warning");
            }else if(autor == ''){
                swal("Aviso!", 'Descreva o autor do acervo!', "warning");
            }else if(quantidade == ''){
                swal("Aviso!", 'Informe a quantidade do acervo!', "warning");
            }else if(tipo == ''){
                swal("Aviso!", 'Selecione uma categoria para o acervo!', "warning");
            }else if(categoria == ''){
                swal("Aviso!", 'Selecione uma área de conhecimento para o acervo!', "warning");
            }else {
            
                $.ajax({
                    type: "POST",
                    url: "acervos/salva_edita_acervo.php",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response == 1){
                            $('.tabela').load('acervos/tabela.php');
                          
                            swal(
                                'Editado!',
                                'Cadastro editado com sucesso!',
                                'success'
                            )
                            $('#modal').modal('hide')
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