<?php

namespace Clases;
use PDO;
use PDOException;

class Conextion{//mismo nombre que el archivo creado
    protected static $conexion;

    public function __construct()
    {
        if(self::$conexion==null){//self = $this pero conexion es estatica
            self::conectar();
        }
    }
    public static function conectar(){
        //extraer los datos procedentes del archivo .config y definirlos en los siguientes atributos
        $param=parse_ini_file('../.config');
        $base=$param["bbdd"];
        $user=$param["usuario"];
        $pass=$param["pass"];
        $host=$param["host"];
        //dns para acotar los datos para la conexion posterior, leyendo el host, la base de datos donde se aloja
        //y el tipo de formato de texto
        $dns="mysql:host=$host;dbname=$base;charst=utf8mb4";
        try{
            //Establecer la conexion si tiene exito con el dns, user y pass con setAttribute para que nos arroje
            //los errores mysql del pdo
            self::$conexion=new PDO($dns, $user, $pass);
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $ex){
            die("Error no hay conexion".$ex->getMessage());
        }
    }
}