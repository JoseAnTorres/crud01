<?php
session_start();
require "../vendor/autoload.php";
use Clases\User;
//Arrojar error dentro de la pagina login (php_self)
function error($texto){
    $_SESSION['error']=$texto;
    header("Location:{$_SERVER['PHP_SELF']}");
    die();
}
//Al pinchar el boton con el id login se recogera los campos sin espacios en blanco
if(isset($_POST['login'])){
    $nombre=trim($_POST['nombre']);
    $pass=trim($_POST['pass']);
    //Si los campos estan vacios mostrara un mensaje de error
    if(strlen($nombre)==0 || strlen($pass)==0){
        error("Campos vacios");
    }
    //crear objeto usuario
    $user = new User();
    $passHasheado=hash('sha256',$pass);
    //validacion booleana sujeta bajo una condicion (metodo procedente de user)
    if($user->validar($nombre,$passHasheado)){
        $user=null;//borrar usuario una vez buscado dentro de la tabla (metodo validar de user)
        die("Usuario cargado");
    }else{
        $user=null;
        error("Usuario no cargado");
    }
}else{
?>
<!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Login</title>
    </head>

    <body style="background-color:lightblue">
        <h3 class="text-center mt-3">Cargar usuario</h3>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <div class="container mt-3 mb-4">
            <?php
            if (isset($_SESSION['error'])) {
                echo "<p class='my-3 p-3 bg-dark text-danger font-weight-bold'>{$_SESSION['error']}</p>";
                unset($_SESSION['error']);
            }
            ?>
            <div class="card text-white bg-secondary mb-3 m-auto mt-5" style="max-width: 48rem;">
                <div class="card-header text-center">Login</div>
                <div class="card-body">
                    <form name="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group">
                            <label for="nu">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="nu" placeholder="Ingrese su nombre" name="nombre" required>

                        </div>
                        <div class="form-group">
                            <label for="np">Password</label>
                            <input type="password" class="form-control" id="np" placeholder="Password" name="pass" required>
                        </div>
                        <button type="submit" class='btn btn-primary' name='login'><i class="fas fa-sign-in-alt mr-2"></i>Login</button>
                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php } ?>