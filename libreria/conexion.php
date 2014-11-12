<?php
    $con= new conexion($confi['server'],$confi['usuario'],$confi['pass'],$confi['base']);
class conexion{

    public $enlace;

    function __construct($server,$usuario,$pass,$base){
    $this->enlace = mysql_connect($server,$usuario,$pass);
    mysql_select_db($base);
    }

    function __destruct(){
    mysql_close($this->enlace);
    }
  }
?>