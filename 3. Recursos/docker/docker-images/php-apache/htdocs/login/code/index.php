<?php
require '../../lib/includes/style.php'; //Lib elementos comunes
require '../../lib/includes/general/login.php'; //Lib específica login

session_start();


head("Acceso con código");
navbar();


echo"<div class=\"container-fluid d-flex flex-column justify-content-center\">";
echo"<div class=\"container my-5 p-5 login\">";

if(isset($_SESSION["logged"]))
    echo"<a>Ya tienes una sesión iniciada. Debes cerrar sesión antes de iniciar otra.</a>";
else {
    echo '
    <h1 class="login-titulo">Iniciar sesión</h1>
        <form method="POST" action="sendlogin.php" class="login-form">
            <label for="email">Introduce el código que has recibido en tu correo:<br>
                <input type="password" name="passwd" id="passwd" placeholder="Introduce tu código" required>
            </label>
            <br>
            <input type="submit" value="¡Acceder!" class="btn btn-primary">
            <br><br>
            <p>¿No has recibido el código? <a href="../">Solicita uno nuevo.</a></p>
            <p>¿No tienes cuenta? <a href="../../registro">Registrate.</a> </p>
        </form>
';
}


echo"</div></div>";

footer();
?>