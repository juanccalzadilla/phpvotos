<?php
require('../model/Usuario.php');

$nombre = $_GET['user'];
$password = $_GET['pass'];

// $nombre ="tester";
// $password="test";

if (!empty($nombre) && !empty($password)) {
    $usuario = new Usuario($nombre, $password);
    $result = $usuario->login($nombre,$password);
    if ($result) {
        echo true;
    } else {
        echo false;
    }
} else {
    echo "No se encontro el usuario / fallo de conexion";   
}