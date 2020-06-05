<?php
session_start();

require '../lib/includes/adesq.php';
require '../lib/includes/style.php';

head("Votar");
navbar();
echo"<div class=\"container-fluid d-flex flex-column justify-content-center\">";
echo"<div class=\"container my-5 p-5\">";

$conn = bdconnect();

if(isset($_SESSION["logged"])) {

    // mail del usuario
    $usuario = $_SESSION['logged'];


    // Si usuario existe
    if (valuser($conn,$usuario)=="True") {

    //Obtenemos la respuesta
        $respuesta = test_input($_POST["respuesta"]);// Aqui recibimos la ID de la respuesta

    //Obtenemos la id de la pregunta
        $encuesta=$_COOKIE['encuesta'];

        $insert = "INSERT INTO `resultados` (`id_voto`, `id_encuesta`, `email`, `id_respuesta`) VALUES (NULL, '$encuesta', '$usuario', '$respuesta')";
        if ($conn->query($insert) === TRUE)
            header("Location: /encuesta/index.php?id=$encuesta");
          else
            header("Ha ocurrido un error. <h1>404<h1>");

    }else
        header("Location: ../login");


    setcookie("encuesta", "", time() - 3600);

}else{
    header("Location: ../registro");
}

echo "</div></div>";
footer();
?>