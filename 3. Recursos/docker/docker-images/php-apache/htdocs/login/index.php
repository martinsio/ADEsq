<?php
require '../lib/includes/style.php'; //Lib elementos comunes
require '../lib/includes/general/login.php'; //Lib específica login


session_start();

head("Iniciar sesión");
navbar();

echo"<div>";

if(isset($_SESSION["logged"]))

    echo"<p><a>Ya tienes una sesión iniciada. Debes cerrar sesión antes de iniciar otra.</a><br><a href='../'>Ir a la página de inicio.</a></p>";
else {
    echo '
    <div class="container-fluid d-flex flex-column justify-content-center">
    <div class="container p-5 login">
    <h1 class="login-titulo">Iniciar sesión</h1>
        <form method="POST" action="sendlogin.php" class="login-form">
            <label for="email">
                <input type="email" name="email" id="email" placeholder="Correo electrónico" required>
            </label>
            <br>
            <label>
                <div class="g-recaptcha" data-sitekey="6LfIVvIUAAAAABfcKlbCn9BHZnp9jtPXSdygQEeU" data-theme="dark" aria-required="true"></div>
            </label>
            <br>
            <input type="submit" value="Iniciar sesión" class="btn btn-primary">
            </form>
    </div></div>
';
}


echo"</div>";

footer();
?>