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

$url = "https://brasilapi.com.br/api/isbn/v1/";
$api = file_get_contents( $url . $isbn);
$defuse = json_decode($api); 
?>

<div class="p-4">
    <center>
        <h6><?php echo $defuse->title?></h6>
        <img src=<?php echo $defuse->cover_url?> width="400px" height="600px" alt="Não disponivel">
    </center>
</div>
<script>
    $(function(){
        $('.cancelar').click(function(){
            $('.tabela').load('acervos/tabela.php');
        })
      
    })
</script>