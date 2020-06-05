<?php
session_start();


//Añadimos librerias
require_once "../lib/includes/recaptchalib.php";
require '../lib/includes/adesq.php';


//creamos la conexión:
$conn = bdconnect();


//Obtenemos la pregunta y sus valores del formulario y sesión
$titulo=test_input($_POST['titulo']);
$publipriv=$_POST['publipriv'];
$email=$_SESSION['logged'];


//Generamos una id
$campo=contra().$email.date("dmyhis");
$id=hash('sha256', $campo);


//insertamos los datos:
$sql = "INSERT INTO `encuesta` (`id`, `pregunta`, `email`, `private`, `fecha`) VALUES ('$id', '$titulo', '$email', '$publipriv', NOW())";
if(mysqli_query($conn, $sql)){
    
    $idpregunta=$id;

//Obtenemos todas las respuestas del formulario
    $respuestas=array();

    for ($i = 1; $i <= 10; $i++) {
        $resp="respuesta".$i;
        if (isset($_POST[$resp]))
            array_push($respuestas, test_input($_POST[$resp]));
    }


//saco el numero de elementos
    $longitud = count($respuestas);


//Recorro todos las opciones y las inserto
    for($i=0; $i<$longitud; $i++) {
        $sql = "INSERT INTO `opciones` (`id_respuesta`, `id_pregunta`, `respuesta`) VALUES (NULL, '$idpregunta', '$respuestas[$i]')";
        mysqli_query($conn, $sql);
    }
}

header("Location: ../encuesta/index.php?id=$idpregunta'");
?>