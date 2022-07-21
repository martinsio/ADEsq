<?php
session_start();
require_once "../lib/includes/recaptchalib.php";
require '../lib/includes/adesq.php';
require '../lib/includes/style.php'; //Lib elementos comunes
require '../lib/includes/general/registro.php'; //Lib elementos propiosç
require '../lib/PHPMailer/PHPMailerAutoload.php';


//creamos la conexión:
$conn = bdconnect();

//Obtención datos del formulario:
$nombre=test_input($_POST['nombre']);
$apellido1=test_input($_POST['apellido1']);
$apellido2=test_input($_POST['apellido2']);
$email=test_input($_POST['email']);


head("Registro");
navbar();

echo"<div>";
if (valcapcha()=="True") //Si el capcha es valido
    fun1($conn, $email, $nombre, $apellido1, $apellido2);
else//Si el capcha no es válido
    echo"<p><a>Debes completar el capcha para poder continuar.</a><br><a href='./'>Volver a intentar. </a></p>";
echo"</div>";


//cerramos conexión
footer();
mysqli_close($conn);
?>
