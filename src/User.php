<?php
namespace Clases;
use Clases\Conextion;
use PDO;
use PDOException;

class User extends Conextion{
    private $id;
    private $nombre;
    private $apellidos;
    private $user;
    private $mail;
    private $pass;

    public function __construct()
    {
        parent::__construct();
    }

    public function crear(){
        //insertar datos a la tabla users con parametros
        $conexion = "insert into users(nombre, apellidos, username, mail, pass) values(:n, :a, :u, :m, :p)";
        //preparar el codigo de insertar para conexion
        $stmt = parent::$conexion->prepare($conexion);
        //ejecucion para insertar con los atributos recogidos y guardados con los parametros
        try{
            $stmt->execute([
                ':n'=>$this->nombre,
                ':a'=>$this->apellidos,
                ':u'=>$this->user,
                ':m'=>$this->mail,
                ':p'=>$this->pass
            ]);
        }catch(PDOException $ex){
            die("Error al crear usuario: ".$ex->getMessage());
        }
    }

    public function borrar(){
        //codigo sql de borrado de users
        $conexion="delete from users";
        //preparar conexion y codigo sql
        $stmt=parent::$conexion->prepare($conexion);
        //ejecutar
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die("Error al borrar los usuarios".$ex->getMessage());
        }
    }

    public function validar($nombre, $pass){
        //codigo mysql para encontrar en los users el nombre y el codigo respectivamente
        $conexion="select * from users where username=:u and pass=:p";
        //preparar conexion y codigo sql
        $stmt=parent::$conexion->prepare($conexion);
        //ejecutar el comando con los parametros suministrados por el usuario final
        try{
            $stmt->execute([
                ':u'=>$nombre,
                ':p'=>$pass
            ]);
        }catch(PDOException $ex){
            die("Error en el usuario".$ex->getMessage());
        }
        //encontrar el objeto con estos parametros para arrojar un resultado booleano
        $fila=$stmt->fetch(PDO::FETCH_OBJ);
        return ($fila!=null)?true:false;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellidos
     */ 
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */ 
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of pass
     */ 
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set the value of pass
     *
     * @return  self
     */ 
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }
}