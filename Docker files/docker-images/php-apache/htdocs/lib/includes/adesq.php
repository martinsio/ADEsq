<?php
require_once "recaptchalib.php";
#Para arreglar el fallo de ruta
$ruta =  $_SERVER['DOCUMENT_ROOT'] . '/lib/PHPMailer/alerts/mailalert.php';
require_once($ruta);

//filtrado de datos
function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

//Generador de contraseña
function contra() {
    $caracteres = '0123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$#@!?%-*';
    $caractereslong = strlen($caracteres);
    $clave = '';
    for($i = 0; $i < 24; $i++) {
        $clave .= $caracteres[rand(0, $caractereslong - 1)];
    }
    return $clave;
}

//Generador de contraseña
function linkiar() {
    $caracteres = '0123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$#@!?%-*';
    $caractereslong = strlen($caracteres);
    $clave = '';
    for($i = 0; $i < 4; $i++) {
        $clave .= $caracteres[rand(0, $caractereslong - 1)];
    }
    return $clave;
}

//Función que valida el capcha:
function valcapcha(){
    //Validamos que se ha rellenado el capcha:
    $secret = "6LfIVvIUAAAAANo7jNLMFh-2B3WWeKfD_4B4F611";
    $response = null;
    // comprueba la clave secreta
    $reCaptcha = new ReCaptcha($secret);

    if ($_POST["g-recaptcha-response"]) {
        $response = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
        );
    }
    //Inserción de los datos según el resultado del capcha
    if ($response != null && $response->success)
        return "True";
    else
        return "False";
}

//Conectar a BD:
function bdconnect(){
    //parámetros bd
    $servername = "mariadb";
    $database = "voto";
    $bdusername = "adminappvoting";
    $password = "13Ao^W%UIFTc";

//creamos la conexión:
    $conn = mysqli_connect($servername, $bdusername, $password, $database);
    return $conn;
}

//Comprobar si un usuario existe:
function valuser($conn, $email){
    //Comprobamos que el usuario existe
    $resultado = mysqli_query($conn, "SELECT email FROM usuarios WHERE email = '$email'");
    $fila = mysqli_fetch_row($resultado);

    if (empty($fila[0]))
        return "False";
    else
        return "True";
}

//Saber si el usuario puede crear mas encuestas
function counteq($conn, $email){
    $sql = "select count(id) from encuesta where email='$email';";
    $resultado = mysqli_query($conn, $sql);
    if ($resultado >10)
        return "False";
    else
        return "True";
}

//Enviar correos
function envcorreo($correo,$code) {
    //iniciamos la instancia
    $mail = new PHPMailer();
    $mail->IsSMTP();

//config sv
    $mail->From = "adesq2020@outlook.com";
    $mail->FromName = "ADESQ Team";
    $mail->Encoding = 'base64';
    $mail->CharSet = 'UTF-8';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls'; //seguridad
    $mail->Host = "smtp.office365.com"; // servidor smtp
    $mail->Port = 587; //puerto
    $mail->Username ='adesq2020@outlook.com'; //nombre usuario
    $mail->Password = '1H7*dC$bJoIz'; //contraseña
    $mail->isHTML(true);
    
    //datos del correo
    $mail->AddAddress($correo);
    $mail->Subject = "Nuevo inicio de sesión en Sistema de Voto";
    $mail->Body = mailalert($code);
    #$mail->Body = "Para acceder a sistema de voto debes utilizar el siguiente código: \n$code";

//Avisar si fue enviado o no y dirigir al index
    if ($mail->Send())
        return "OK";
    else {
        echo'<script type="text/javascript">
           alert("No se ha podido enviar el código. Intentalo de nuevo.");
        </script>';
        return "NO";
    }
}


?>
