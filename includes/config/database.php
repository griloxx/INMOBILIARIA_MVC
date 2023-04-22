<?php

function conectarDB() : mysqli {
    $db = new mysqli(
        $_ENV['DB_HOST'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        $_ENV['DB_BD']
    );
    //$db = new mysqli('localhost', 'root', 'Gridur.91', 'bienesraices_crud');
    if (!$db) {
        echo 'error no se pudo conectar';
        exit;
    } 
        return $db;

};
