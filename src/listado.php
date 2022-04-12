<?php
require('../model/Usuario.php');
$voto = $_POST['voto'];
$idProducto = $_POST['id'];
$idUsuario = $_SESSION['ID'];

$result = Usuario::mivoto($voto,$idProducto,$idUsuario);
$estrellas = Usuario::getVotos($idProducto);
$response = ["result" => $result,"estrellas" => $estrellas,"id" => $idProducto];
echo json_encode($response);
