<?php
        //cria o banco de dados se ele não existir
    $db = new SQLite3('../../db/bibliotecario.db');
    session_start(); 
    $usuario_id = $_SESSION['usuarioId'];
    
    $isbn = strval($_POST['isbn']);

    $url = "https://brasilapi.com.br/api/isbn/v1/";
    $api = file_get_contents( $url . $isbn);
    $defuse = json_decode($api); 

    echo $defuse;