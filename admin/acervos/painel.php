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
    input[type="radio"] {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  border: 2px solid #ccc;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  outline: none;
  cursor: pointer;
}

/* Estilo quando o input radio está marcado */
input[type="radio"]:checked {
  background-color: #8bc34a;
  border-color: #8bc34a;
}

/* Estilo do label do input radio */
.radio-label {
  display: inline-block;
  margin-left: 5px;
  font-size: 16px;
  color: #333;
}

/* Estilo do container que envolve o input radio e o label */
.radio-container {
  display: inline-block;
  vertical-align: middle;
  margin-right: 10px;
}
/* estilo para a linha destacada */
.table-highlighted {
  background-color: #00FFFF;
}

</style>
<!-- Page-header start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">Acervo Bibliotecário</h5>
                    <p class="m-b-0">Cadastro, edição e exclusão de livros.</p>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="painel.php"> <i class="fa fa-home f-20"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)" class="lista">Acervo</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
    <div class="card">
        <div class="card-header">
            <h5>Cadastro de Acervo Bibliotecário</h5>
            
        </div>
        <div class="card-block typography">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="tabela">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalExemploTitulo" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalExemploTitulo">Acervo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="corpo_modal"></div>
      
    </div>
  </div>
</div>

<script>
    $(function(){
        $('.tabela').load('acervos/tabela.php');

        $('.lista').click(function(){
            $('.tabela').load('acervos/tabela.php')
        })
    })
</script>