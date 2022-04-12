<?php

include('../model/Usuario.php');
$nombre = $_GET['user'];
$password = $_GET['pass'];

$usuario = new Usuario($nombre,$password);

$result = $usuario->registerUser();
if ($usuario) {
    echo true;
}else{

    echo false;
}