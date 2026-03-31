<?php

    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'gabnet_system';

    $connect = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    //if ($connect->connect_error) {
    //    die("Erro de conexão: " . $connect->connect_error);
    //}
    
?>