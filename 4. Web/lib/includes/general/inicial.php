<?php

function contentindex($conn,$sql){

    //Pedimos que nos muestre las encuestas disponibles
    $resultat = mysqli_query($conn, $sql);

    echo "<div class=\"encuestas\">";

    if (mysqli_num_rows($resultat) > 0) {
        // Si hay resultados

        while ($row = mysqli_fetch_assoc($resultat)) {
            $id = $row['id'];
            echo"<a href='/encuesta/index.php?id=$id'><div class=\"encuesta\">";
            echo "
                <p class='encuesta-titulo'>$row[pregunta]</p>
                <span class='encuesta-fecha'>$row[fecha]
            ";
            echo"</div></a>";

        }
        
    }else //Si no hay resultados
        echo"<a>No se han encontrado votaciones todavía.</a>";

    echo "</div>";

}

?>
