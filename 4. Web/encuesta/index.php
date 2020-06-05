



<?php
session_start();

require '../lib/includes/adesq.php';
require '../lib/includes/style.php';

$conn = bdconnect();


head("Ver encuesta");
navbar();

echo"<div class=\"container-fluid d-flex flex-column justify-content-center\">";
echo"<div class=\"container my-5 p-5 votacion\">";


//Si la sesión ha sido iniciada.
if(isset($_SESSION["logged"])) {
    $usuario = $_SESSION['logged'];

    //Si el usuario existe
    if (valuser($conn,$usuario)=="True") {
        $encuesta = test_input($_GET["id"]);


        // Consulta si la encuesta existe
        $sql = "SELECT * FROM `encuesta` WHERE `id` LIKE '$encuesta'";
        $resultadoencuesta = mysqli_query($conn, $sql);

        if (mysqli_num_rows($resultadoencuesta) > 0){
            // Imprimimos pregunta
            $row = mysqli_fetch_row($resultadoencuesta);
            echo '<h1 class="votacion-titulo">' . $row[1] . '</h1>';

            // Consulta para ver votos de la encuesta
            $sql="SELECT * FROM `resultados` WHERE `id_encuesta` LIKE '$encuesta'";
            $resultado = mysqli_query($conn, $sql);

            if (mysqli_num_rows($resultado) > 0){//Si tiene votos

                // Para imprimir los votos
                $row = mysqli_fetch_row($resultado);
                $votostotales = mysqli_num_rows($resultado);
                echo "<p class='resultado-encuesta-vtotal'>Votos totales: " . $votostotales . "</p>";

            }else
                echo "No hay votos todavía";

            // Comprobamos si el usuario ha votado
            $sql = "SELECT * FROM `resultados` WHERE `id_encuesta` LIKE '$encuesta' AND `email` LIKE '$usuario'";
            $votado = mysqli_query($conn, $sql);

            if (mysqli_num_rows($votado) > 0){//Si ha votado
                echo "<br><p>Ya has votado.</p><p>Resultados:</p>";

                $sql="SELECT COUNT(*) AS 'count', o.respuesta FROM resultados AS r INNER JOIN opciones AS o ON (o.id_respuesta = r.id_respuesta) WHERE r.id_encuesta = '$encuesta' GROUP BY r.id_respuesta";
                $cosarara = mysqli_query($conn, $sql);
    
                while ($row = mysqli_fetch_row($cosarara)) {
                    
                    echo "<p hidden class='resultado-encuesta-opcion'>$row[1]</p>";
                    echo "<p hidden class='resultado-encuesta-votos'>$row[0]</p>";
                }
                echo '<div id="chartdiv"></div>';

            }else{
                setcookie('encuesta', $encuesta, time() + 300, "/encuesta/");

                echo '<br><p>¿Deseas votar?</p>';

                //Mostramos las respuestas poasibles
                $sql = "SELECT id_respuesta, respuesta FROM `opciones` WHERE `id_pregunta` = '$encuesta' ";
                $resultado = mysqli_query($conn, $sql);

                echo"<br><form action='votar.php' method='post' class='votacion-form'>";
                echo "<div class='radio'>";
                while ($row = mysqli_fetch_assoc($resultado))
                    echo "  <input type='radio' required id='$row[id_respuesta]' name='respuesta' value='$row[id_respuesta]'> 
                            <label for='$row[id_respuesta]'>$row[respuesta] </label>
                            ";
                echo "</div>";
                echo" <input type='submit' value='Votar' class='btn btn-primary'>
                    </form>";
            }
            setcookie('encuesta', $encuesta, time() + 300, "/encuesta/");
            $_SESSION['lastenc']=$encuesta;

            //Comprobamos si la persona que accede es administrador de la pregunta
            $sql="SELECT * FROM `encuesta` WHERE `id` = '$encuesta' AND `email` LIKE '$usuario'";
            $resultado = mysqli_query($conn, $sql);
            if (mysqli_num_rows($resultado) > 0){
                echo"<br><a href='delete.php'>Eliminar encuesta</a>";
            }
        }else{
            header("Location: /");
        }
    }else{
        header("Location: ../registro");
    }
}else{
    header("Location: ../registro");
    }
echo "</div></div>";
echo '
        <script src="https://www.amcharts.com/lib/4/core.js"></script>
        <script src="https://www.amcharts.com/lib/4/charts.js"></script>
        <script src="https://www.amcharts.com/lib/4/themes/dark.js"></script>
        <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
        <script src="app.js"></script>

';
footer();
?>