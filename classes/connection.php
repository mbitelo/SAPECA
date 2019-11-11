<?php
Class Connection{

    var $server = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "ptsi_mikhaelbitelo";

    function __construct(){
        date_default_timezone_set('America/Sao_Paulo');
    }

    function Conectar(){
        $conectar = mysqli_connect($this->server,$this->username,$this->password,$this->database);
        $conectar->set_charset('utf8');
        if(!($conectar)){
                echo "Erro ao tentar conectar ao banco de dados";
        }
        return $conectar;
    }
}
?>