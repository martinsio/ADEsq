<?php

require '../lib/includes/adesq.php';
require '../lib/includes/style.php';
require '../lib/includes/general/delete.php';
session_start();

$conn = bdconnect();



head("Pregunta eliminada");
navbar();

echo"<div class=\"container-fluid d-flex flex-column justify-content-center\">";
echo"<div class=\"container my-5 p-5\">";

    $encuesta=$_SESSION['lastenc'];
    if(deletequestion($conn,$encuesta)=='TRUE')
        header("Location: /");


echo"</div></div>";

footer();
?>