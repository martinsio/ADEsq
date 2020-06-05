<?php
session_start();

require '../lib/includes/adesq.php';
require '../lib/includes/style.php';
require '../lib/includes/general/inicial.php';

head("Perfil de usuario");
navbar();

//Conectamos con la bd
$conn=bdconnect();

echo"<div class=\"container-fluid d-flex flex-column justify-content-center\">";
echo"<div class=\"container my-5 p-5 perfil\">";

    //Si la sesión está iniciada
    if(isset($_SESSION["logged"])) {
        $email = $_SESSION['logged'];

        //Buscamos los datos del usuario;
        $sql = "SELECT email, nombre, apellido1, apellido2 FROM usuarios WHERE email='$email'; ";
        $resultado = mysqli_query($conn, $sql);

        echo"<h2>Datos del usuario</h2>";
        echo"<div><table>";

        if (mysqli_num_rows($resultado) > 0) {//Si se encuentran resultados:
            $row = mysqli_fetch_assoc($resultado);
            echo "<tr>
                     <td>Correo electrónico</td>
                     <td>$row[email]</td>
                  </tr>
                  <tr>
                     <td>Nombre</td>
                     <td>$row[nombre] <br>
                  </tr>
                  <tr>
                     <td>Primer apellido</td>
                     <td>$row[apellido1]</td>
                  </tr>
                  <tr>
                     <td>Segundo apellido</td>
                     <td>$row[apellido2]<br>
                  </tr>
              </table>
            ";
        } else {//Si no se encuentra ningún resultado.
            echo "<tr >
                     <td colspan='2'>Ha habido un error al buscar tus datos. Intentalo de nuevo en otro momento. </td>
                  </tr>
            </table>
            <br><br>";
        }


    //-------------------------------------Encuestas del susuario-----------------------------------------------------------

        
        //mostramos el contenido de la página (privadas)
        echo"<h4>Tus encuestas privadas:</h4>";
        $sql = "SELECT * FROM `encuesta` WHERE `email` LIKE '$email' AND `private` = 1 ORDER BY `fecha` ASC";
        contentindex($conn, $sql);

        //mostramos el contenido de la página (Públicas)
        echo"<h4>Encuestas públicas: </h4>";
        $sql = "SELECT * FROM `encuesta` WHERE `email` LIKE '$email' AND `private` = 0 ORDER BY `fecha` ASC";
        contentindex($conn, $sql);

        //AÑADIR OPCIÓN PARA MODIFICAR/ELIMINAR LOS DATOS
        echo"<div><a class=\"btn btn-primary\" role=\"button\" href=''>Modificar mis datos (NO DISPONIBLE)</a>
                 <br>
                 <br>
             <a class=\"btn btn-primary\" role=\"button\" href='drop.php'>Eliminar mi cuenta</a><br></div>";


    }else//En caso de que no haya una sesión iniciada.
        header("Location: ../registro");

echo"</div>";
echo"</div>";
footer();
?>