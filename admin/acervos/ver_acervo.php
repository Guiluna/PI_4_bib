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
                        <label class="float-label">Título</label><br>
                        <?php echo $titulo ?>
                        <span class="form-bar"></span>
                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group form-primary">
                        <label class="float-label">Autor</label><br>
                        <?php echo $autor ?>
                        
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-primary">
                        <label class="float-label">Quantidade</label><br>
                        <?php echo $quantidade ?>
                        
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-primary">
                        <label class="float-label">Ano</label><br>
                        <?php echo $ano ?>
                        
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group form-primary">
                        <label class="float-label">ISBN</label><br>
                        <?php echo $isbn ?>
                        
                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group form-primary">
                        <label class="float-label">Editora</label><br>
                        <?php echo $editora ?>
                       
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-primary">
                    <label class="float-label">Categoria</label><br>
                    <?php echo $tipo ?>
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-primary">
                    <label class="float-label">Área do conhecimento</label><br>
                    <?php
                                                    $lista = $db->query("SELECT * FROM cad_categoria  WHERE id = '$categoria' ");
                                                    $dados = $lista->fetchArray();
                                                        $id = $dados['id'];
                                                        $nome = $dados['titulo'];
                                                        echo $nome;

                        ?>
                        
                    </div>
                   
                </div>
                </div>
                <div class="form-group row" >
                    <div class="col-md-12">
                        LOCALIZAÇÃO
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-primary">
                            <label class="float-label">Setor</label><br>
                            <?php echo $setor ?>
                            
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-primary">
                            <label class="float-label">Estante</label><br>
                            <?php echo $estante ?>
                            
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-primary">
                            <label class="float-label">Prateleira</label><br>
                            <?php echo $prateleira ?>
                           
                            
                        </div>
                    </div>

                </div>
                <div class="form-group row" >
                <div class="col-md-12">
                    <div class="form-group form-primary">
                    <label class="float-label">Sinopse</label><br>
                    <?php echo $sinopse ?>
                        
                    </div>
                </div>
                
                <div class="form-group form-primary">
                        <br>
                        <input type="hidden" id="id" value="<?php echo $id_acervo ?>">
                        <button type="button" class="btn btn-secondary cancelar" data-dismiss="modal"  >Retornar</button>
                        
                    </div>
                
                
            </div>
          
                
            
</form>
</div>
<script>
    $(function(){
        $('.cancelar').click(function(){
            $('.tabela').load('acervos/tabela.php');
        })
      
    })
</script>