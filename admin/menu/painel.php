<?php
//cria o banco de dados se ele não existir
$db = new SQLite3('../../db/bibliotecario.db');
session_start(); 
$usuario_id = $_SESSION['usuarioId'];
$lista = $db->query("SELECT * FROM cad_escola WHERE id = '$usuario_id'  ");
$dados = $lista->fetchArray();
$nome_escola = $dados['nome'];         
?>

<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
             <!-- Page-body start -->
            <div class="page-body">
                <div class="row">

                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-block bg-c-green b-radius-10" >

                                <a href="#" class="emprestimos"><h3 class="text-white m-50" style="text-align: center;">Empréstimos</h3></a>  

                            </div>                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>