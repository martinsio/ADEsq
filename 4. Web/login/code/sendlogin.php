<?php
session_start();
//Añadimos librerias
require_once "../../lib/includes/recaptchalib.php";
require '../../lib/PHPMailer/PHPMailerAutoload.php';
require '../../lib/includes/adesq.php';
require '../../lib/includes/style.php'; //Lib elementos comunes
require '../../lib/includes/general/login.php'; //Lib específica login

//Establecemos conexión con la bd
$conn = bdconnect();


//Obtención datos usuario:
$email=$_SESSION['user'];
$passwd=test_input($_POST['passwd']);


//Iniciamos la página
head("Acceso con código");
navbar();

echo"<div class=\"container-fluid d-flex flex-column justify-content-center\">";
echo"<div class=\"container my-5 p-5\">";

//Buscamos sesión para determinar si el usuario ya ha iniciado sesión
if(isset($_SESSION["logged"]))
    echo"<a>Ya tienes una sesión iniciada. Debes cerrar sesión antes de iniciar otra.</a>";
else {
        //Comprobamos que el usuario existe
        if (valuser($conn, $email)=="False")
            echo "<a>No hay ningún usuario registrado con la dirección $email.</a><br><a href='../'>Probar con otro email</a><br><a href='../../registro'>Registrate</a>";
        else {
            $passhashed = hash('sha256', $passwd);
            $sql = "SELECT * FROM usuarios WHERE email='$email' and pass='$passhashed'";
            $resultado=mysqli_query($conn, $sql);
            $log = mysqli_fetch_row($resultado);

            if (!empty($log[0])) {
                //Creamos la sesión
                $_SESSION["logged"] ="$email";
                //La contraseña coincide
                header("Location: /");
                //Generamos una nueva contraseña para dejar invalidada la anterior. En este caso no se envía por mail.
                $pass = contra();
                $passhashed = hash('sha256', $pass);
                $sql = "UPDATE usuarios SET pass='$passhashed' WHERE email='$email'";
                mysqli_query($conn, $sql);

            }else //La contraseña no coincide
                echo"<p><a>El código que has introducido no es correcto.</a><br><a href='./'>Intentalo de nuevo </a></p>";
        }
}
echo"</div></div>";


footer();
mysqli_close($conn);
?>