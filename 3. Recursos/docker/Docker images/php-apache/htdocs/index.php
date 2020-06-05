<?php
require './lib/includes/adesq.php';
require './lib/includes/style.php'; //Lib elementos comunes
require './lib/includes/general/inicial.php'; //Lib elementos propios
require './lib/includes/general/login.php'; //Lib específica login


//Inicio de la sesión bd y web
session_start();
$enllaç = bdconnect();


//Abrimos la web
head("Inicio | ADESQ");

//Cargamos la barra de navegación
navbar();
echo"<div class=\"container-fluid d-flex flex-column justify-content-center\">";
echo"<div class=\"container my-5 p-5\">";
echo"<h2 class=\"titulo-encuesta-banner\">Encuestas</h2>";
    //Si la sesión está iniciada:
    if(isset($_SESSION["logged"])){
        $email = $_SESSION["logged"]; //extraemos el valor de la sesión

        //Si el usuario existe
        if ( valuser($enllaç, $email) == "True" ){

            echo"<div><h3>Tus encuestas</h3>";
            //mostramos el contenido de la página (privadas)
            echo"<h4>Privadas:</h4>";
            $sql = "SELECT * FROM `encuesta` WHERE `email` LIKE '$email' AND `private` = 1 ORDER BY `fecha` ASC";
            contentindex($enllaç, $sql);

            //mostramos el contenido de la página (privadas)
            echo"<h4>Públicas:</h4>";
            $sql = "SELECT * FROM `encuesta` WHERE `email` LIKE '$email' AND `private` = 0 ORDER BY `fecha` ASC";
            contentindex($enllaç, $sql);
            //mostramos el contenido de la página (Públicas)
            echo"<br><h3>Encuestas públicas: </h3>";
            $sql = "SELECT * FROM `encuesta` WHERE `email` NOT LIKE '$email' AND `private` = 0 ORDER BY `fecha` ASC";
            contentindex($enllaç, $sql);
            echo"</div>";

        } else { //Si el usuario ha iniciado una sesión pero su usuario no existe
            session_destroy();
            header("Location: ./login");
        }

    } else{ //Si no hay una sesión iniciada
        $sql = "SELECT * FROM `encuesta` WHERE `private` = 0 ORDER BY `fecha` ASC";
        contentindex($enllaç, $sql);
}

echo "</div>";
echo "</div>";


//Cerramos la web
footer();
mysqli_close($enllaç);

?>