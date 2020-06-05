<?php
function fun1($conn, $email, $nombre, $apellido1, $apellido2){
//Si el usuario existe
    if (valuser($conn, $email)=="True")
        echo "<a>La dirección de correo $email ya se encuentra asociada a otra cuenta. \n</a><br><a href='./'>Registrate con otro correo.</a>";
    else {
        //Generamos una contraseña
        $pass = contra();
        $passhashed = hash('sha256', $pass);

        //insertamos los datos:
        $sql = "INSERT INTO usuarios (nombre, apellido1, apellido2, email, pass) VALUES ('$nombre', '$apellido1', '$apellido2','$email','$passhashed')";

        //comprobación inserción de datos
        if (mysqli_query($conn, $sql)){
            if(envcorreo($email,$pass)=='OK'){
                $_SESSION['user']=$email;
                header("Location: /login/code");
            }
                
        }
    else
        echo "<br>No ha sido posible registrarte, intentalo de nuevo mas tarde.";
    }
}
?>