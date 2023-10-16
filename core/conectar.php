<?php
class Conectar{
    private $driver;
    private $host, $user, $pass, $database, $charset;
    public function __construct() {
        $db_cfg = require_once  __DIR__ .'/../config/database.php';
        $this->driver=DB_DRIVER;
        $this->host=DB_HOST;
        $this->user=DB_USER;
        $this->pass=DB_PASS;
        $this->database=DB_DATABASE;
        $this->charset=DB_CHARSET;
    }
    public function Connection(){
        $bd = $this->driver .':host='. $this->host .  ';dbname=' . $this->database . ';charset=' . $this->charset;
        //$bd = ' mysql:host=localhost;dbname=mvc1;charset=utf8';
        try {
            $connection = new PDO($bd, $this->user, $this->pass);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            //We throw the exception
            throw new Exception('Problema ao estabelecer conexão!');
        }
    }
}
?>