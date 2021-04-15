<?php
require '../vendor/autoload.php';
use Clases\Datos;
$usu=new Datos('users',50);//crear datos con 50 usuarios
echo "<h2>Usuarios creados</h2>";