<?php
class Connection
{
    public static function Connect()
    {
        define('server', 'localhost');
        define('dbName', 'check_dollar');
        define('user', 'root');
        define('password', '');
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        try {
            $conection = new PDO("mysql:host=" . server . "; dbname=" . dbName, user, password, $options);
            return $conection;
        } catch (Exception $e) {
            die("El error de Conexión es: " . $e->getMessage());
        }
    }
}