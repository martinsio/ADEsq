<?php
session_start();

//Añadimos librerias
require_once "../lib/includes/recaptchalib.php";
require '../lib/PHPMailer/PHPMailerAutoload.php';
require '../lib/includes/adesq.php';
require '../lib/includes/style.php'; //Lib elementos comunes
require '../lib/includes/general/login.php'; //Lib específica login

//Establecemos conexión con la bd
$conn = bdconnect();

//Obtención datos usuario:
$email=test_input($_POST['email']);

head("Solicitar código");
navbar();

echo"<div class=\"container-fluid d-flex flex-column justify-content-center\">";
echo"<div class=\"container my-5 p-5 login\">";


//Buscamos sesión para determinar si el usuario ya ha iniciado sesión
if(isset($_SESSION["logged"]))
    echo"<p><a>Ya tienes una sesión iniciada.</a><br><a href='/'>Ir a la página de inicio.</a></p>";
else {
    //Inserción de los datos según el resultado del capcha
    if (valcapcha()=="True") {
        //Verificamos que el usuario existe
        if (valuser($conn, $email)=="False")
            echo "<p><a>No hay ningún usuario registrado con la dirección $email.</a><br><a href='./'>Probar con otro email</a><br><a href='../../registro'>Registrate</a></p>";
        else {
            //Creamos una cookie para determinar cada cuanto tiempo puede intentar iniciar sesión un usuario.
            if (isset($_COOKIE["tiempo"])){
                echo 'Debes esperar 5 minutos desde tu última solicitud para volver a intentarlo. <br> 
                <form method="get" action="./">
                    <button type="submit" class="btn btn-primary">Acceder con otra cuenta</button>
                </form>';}
            
            else {
                setcookie("tiempo", 1, time() + 300);
                $pass = contra();
                $passhashed = hash('sha256', $pass);
                $sql = "UPDATE usuarios SET pass='$passhashed' WHERE email='$email'";
                mysqli_query($conn, $sql);
                if (envcorreo($email, $pass)=='OK'){
                    $_SESSION['user']=$email;
                    header("Location: ./code");
                }
            }
        }
    } else // Si el código capcha no es válido, lanzamos mensaje de error al usuario
        echo "<p><span>Debes completar el capcha para poder continuar.</span><br><a href='./' class='btn btn-primary'>Volver a intentar. </a></p>";
}

echo"</div></div>";
footer();
mysqli_close($conn);
?>