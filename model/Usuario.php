<?php
session_start();
require('../db/db.php');

class Usuario
{

    protected $name, $password;
    public function __construct($name = null, $password = null)
    {
        $this->name = $name;
        $this->password = $password;
    }

    public function registerUser()
    {

        $bd = new BD();
        $conn = $bd->getConexion();
        $query = "INSERT INTO usuario VALUES (null,'$this->name','$this->password')";
        $stm = $conn->prepare($query);
        $result = $stm->execute();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public static function login($name, $password)
    {

        if (isset($name) && isset($password)) {

            $bd = new BD();
            $conn = $bd->getConexion();
            $query = "SELECT * FROM USUARIO WHERE usernamerating = '$name' AND password ='$password'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch();
            $response = array();
            if ($result) {
                $sql = "SELECT id from USUARIO where usernamerating = '$name'";
                $estado = $conn->prepare($sql);
                $estado->execute();
                $resultado = $estado->fetch();

                // $response = [
                //     'result' => true,"ID" => $resultado];
                $_SESSION['ID'] = $resultado[0];
                return true;
            } else {
                return false;
            }
        } else {
            return "invalido no llego data";
        }
    }


    public static function miVoto($voto, $idProducto, $idUsuario)
    {

        // FAlta comprobar si el usuario ya ha votado.
        try {
            $bd = new BD();
            $conn = $bd->getConexion();
            if (self::usuarioVoto($idProducto, $idUsuario)) {
                return false;
            }
            $query = "INSERT INTO votos VALUES ('$voto','$idProducto','$idUsuario')";
            $stmt = $conn->prepare($query);
            $result = $stmt->execute();

            if ($result) {
                $sql = "SELECT ROUND((SUM(voto)/ count(*)),1) as estrellas from votos group by idProducto having idProducto = $idProducto;";
                $estado = $conn->prepare($sql);
                $result = $estado->execute();
                 if ($result) {
                    $sql = "UPDATE productos p set voto = (select ROUND((SUM(voto)/ count(*)),1) as estrellas from votos group by idProducto having idProducto = $idProducto ) where id = $idProducto;";
                    $estado = $conn->prepare($sql);
                    $result = $estado->execute();
                    if ($result) {
                        return true;
                    } else {
                        return false;
                    }
                 }
            }
        } catch (Exception $e) {
            return $e;
        }
    }


    public static function getVotos($idProducto)
    {
        $bd = new BD();

        // SELECT ROUND((SUM(voto) / SUM(idUsuario)),1) as estrellas from votos where idProducto = 1 group by idProducto;
        //select count(*) from votos group by idProducto having idProducto = 2;
        // select (SUM(voto)/ count(*)) from votos group by idProducto having idProducto = 2;
        // select ROUND((SUM(voto)/ count(*)),1) as estrellas from votos group by idProducto having idProducto = 2; Esta es la buena.
        // ACTUALIZACION DE VOTO
        //update productos p set voto = (select ROUND((SUM(voto)/ count(*)),1) as estrellas from votos group by idProducto having idProducto = p.id ) where id = p.id;
        // Falta hacer el calculo entre las personas que han votado y cuantas estrellas son 
        $conn = $bd->getConexion();
        // $query = "SELECT ROUND((SUM(voto) / SUM(idUsuario)),1) as estrellas from votos where idProducto = $idProducto;";
        $query = "select ROUND((SUM(voto)/ count(*)),1) as estrellas from votos group by idProducto having idProducto = $idProducto;";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            return $result;
        }else{
            return "Sin Asignar";
        }
        
    }


    public static function usuarioVoto($idProducto = 3, $idUsuario = 3){

        $bd = new BD();
        $conn = $bd->getConexion();
        $query = "SELECT * FROM votos where idProducto = $idProducto and idUsuario = $idUsuario";
        $stmt = $conn->prepare($query);
        $result = $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
}
