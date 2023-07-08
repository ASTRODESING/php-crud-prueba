<?php

$servidor = "localhost";
$basedatos = "app";
$usuario = "admin";
$contraseña = "123";

try {
    $conection = new PDO("mysql:host=$servidor;dbname=$basedatos;", $usuario, $contraseña);
} catch (Exception $e) {
    echo $e->getMessage();
}
