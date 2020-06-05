<?php
require '../lib/includes/style.php'; //Lib elementos comunes
require '../lib/includes/general/inicial.php'; //Lib elementos propios

session_start();



if (isset($_SESSION['logged'])){
    head("Ya estas registrado");
    
    echo "<div class=\"container-fluid d-flex flex-column justify-content-center\">";
    echo "<div class=\"container my-5 p-5\">";
    echo "<p><a>No puedes registrarte de nuevo mientras tengas una sesión iniciada.<a><br><a href='/'>Ir al inicio</a></p>";
    echo "</div></div>";
}
else {
    head("Registro");
    navbar();
    echo '
    <div class="container-fluid d-flex flex-column justify-content-center">
    <div class="container my-5 p-5 registro">
    <h1 class="registro-titulo">Registrate</h1>
        <form method="POST" action="sendregistro.php" class="registro-form">
            <label for="nombre">
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
            </label>
            <br>
            <label for="apellido1">
                <input type="text" name="apellido1" id="apellido1" placeholder="Primer apellido" required>
            </label>
            <br>
            <label for="apellido2">
                <input type="text" name="apellido2" id="apellido2" placeholder="Segundo apellido" required>
            </label>
            <br>
            <label for="email">
                <input type="email" name="email" id="email" placeholder="Correo electrónico" required>
            </label>
            <br>
            <label>
                <div class="g-recaptcha" data-sitekey="6LfIVvIUAAAAABfcKlbCn9BHZnp9jtPXSdygQEeU" data-theme="dark" aria-required="true"></div>
            </label>
            <br>
            <input type="submit" value="¡Regístrame!" class="btn btn-primary">
            <p>¿Ya tienes cuenta? <a href="../login">Inicia sesión</a></p>
        </form>
    </div></div>
';
}



footer();

?>