<?php

    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPasswords = '';
    $dbName = 'FormularioDaniel';

    $conexao = new mysqli($dbHost, $dbUsername, $dbPasswords, $dbName);

   // if ($conexao->connect_error) {