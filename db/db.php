<?php

class BD
{
    // Creacion de la base de datos, la variable bd es la que se retorna con el metodo getConexion();
    protected static $bd = null;
    const DB_HOST = 'localhost';
    // const DB_PORT = '3306';
    const DB_DATABASE = 'daw_ajax';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';

    public function __construct()
    {
        self::$bd = new PDO("mysql:host=" . BD::DB_HOST . ";dbname=" . BD::DB_DATABASE, BD::DB_USERNAME, BD::DB_PASSWORD);
        self::$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getConexion()
    {
        if (!self::$bd) {
            new BD();
        }
        return self::$bd;
    }
};
