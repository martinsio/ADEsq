<?php
function deletequestion($conn, $encuesta){
    //Borramos todas las respuestas
    $delete = "DELETE FROM `resultados` WHERE `resultados`.`id_encuesta` = '$encuesta'";
    mysqli_query($conn, $delete);
    if ($conn->query($delete) === FALSE)
        echo "Error al eliminar 1 " . $conn->error;
    else{
        $delete = "DELETE FROM `opciones` WHERE `opciones`.`id_pregunta` = '$encuesta'";
        mysqli_query($conn, $delete);
        if ($conn->query($delete) === FALSE)
            echo "Error al eliminar 2 " . $conn->error;
        else{
            $delete = "DELETE FROM `encuesta` WHERE `encuesta`.`id` = '$encuesta'";
            mysqli_query($conn, $delete);
            if ($conn->query($delete) === FALSE)
                echo "Error al eliminar 3 " . $conn->error;
            else
                return "TRUE";
        }
    }
}


function deleteuser($conn, $email){
    $delete = "DELETE FROM `usuarios` WHERE `usuarios`.`email` = '$email'";
    mysqli_query($conn, $delete);
        if ($conn->query($delete) === FALSE)
            echo "Error al eliminar 2 " . $conn->error;
        else
            return "TRUE";
}
?>