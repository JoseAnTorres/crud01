<?php
namespace Clases;
require "../vendor/autoload.php";
use Faker\Factory;
use Clases\User;

class Datos{
    public $faker;
    //llamar a la clase datos en lugar de llamar el metodo
    public function __construct($cantidad)
    {
        $this->faker=Factory::create('es_ES');
        $this->crearUser($cantidad);
    }
    //para crear un usuario por defecto y cada ususario aleatorio a x cantidad
    public function crearUser($n){
        //usuario por defecto
        $user = new User();
        $user->borrar();
        $user->setNombre("Jose");
        $user->setApellidos("Antonio");
        $user->setUser("admin");
        $user->setMail("joseantorrecillas97@gmail.com");
        $pass=hash('sha256',"secret0");
        $user->setPass($pass);
        $user->crear();
        //crear x cantida de usuarios con un bucle for y crearlos hasta la cantidad,
        //la informacion random se crea gracias a la libreria faker y el atributo unique para que no se repita
        for($i=0;$i<$n-1;$i++){
            $user->setNombre($this->faker->firstName());
            $user->setApellidos($this->faker->lastName()." ".$this->faker->lastName());
            $user->setUser($this->faker->unique()->userName);
            $user->setMail($this->faker->unique()->email);
            $user->setPass($this->faker->sha256);
            $user->crear();
        }
        $user=null;
    }
}