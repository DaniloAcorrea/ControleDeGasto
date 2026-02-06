<?php

require_once 'Config.php';

$error = false;

try{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($conn->connect_errno){
        throw new Exception("Erro ao conectar com o banco de dados: " . $conn->connect_error);
    }
}catch(mysqli_sql_exception $error){
    $erroDB = true;
}

?>