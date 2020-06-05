<?php
session_start();

require '../lib/includes/adesq.php';
require '../lib/includes/general/delete.php';

$conn=bdconnect();

$email=$_SESSION['logged'];

$sql = "SELECT id FROM `encuesta` WHERE `email` LIKE '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result))
            if(deletequestion($conn, $row[id])=="TRUE"){
                if(deleteuser($conn,$email)=="TRUE"){
                    session_destroy();
                    header("Location: /");
                }else
                    echo"No se ha podido borrar el usuario";
            }else
                echo"No se han podido borrar las encuestas del usuario";
}else {
    if (deleteuser($conn, $email) == "TRUE") {
        session_destroy();
        header("Location: /");
    } else
        echo "No se ha podido borrar el usuario";
}

?>