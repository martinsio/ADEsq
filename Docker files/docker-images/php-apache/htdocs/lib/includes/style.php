<?php

//Head para todas las pags. $title es el título de la página.
function head($title){
    $ruta_imagen=$_SERVER["DOCUMENT_ROOT"] . "/lib/includes/favicon.ico";
    echo "
        <!DOCTYPE html>
        <html lang=\"es\">
            <head>
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                <meta charset=\"UTF-8\">
                <title>$title</title>
                <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css\" integrity=\"sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk\" crossorigin=\"anonymous\">
                <link href=\"https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap\" rel=\"stylesheet\"> 
                <link rel=\"stylesheet\" href=\"/lib/includes/css/font-awesome-4.7.0/css/font-awesome.min.css\">
                <link rel=\"stylesheet\" href=\"/lib/includes/css/style.css\">
                <link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css\"/>
                <script src=\"https://www.google.com/recaptcha/api.js\" async defer></script>
                <link rel='icon' href='https://i.imgur.com/BD40H3s.png' type='image/png' />
            </head>

            <body>
";
}
function footer(){
    echo'
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
            <script>
            window.cookieconsent.initialise({
            "palette": {
                "popup": {
                "background": "#383b75"
                },
                "button": {
                "background": "#f1d600"
                }
            },
            "theme": "classic",
            "content": {
                "message": "Utilizamos cookies propias y de terceros para mejorar nuestros servicios. Si continúa con la navegción consideraremos que acepta este uso.",
                "dismiss": "Entendido!",
                "link": "Leer más",
                "href": "/cookies"
            }
            });
            </script>
            
            </body>
            
            <footer>
           
            </footer>
            </html>

    ';
}

function navbar(){
    /* 
    *
    * Si no ha iniciado sesión menú de registrarse e iniciar sesión
    * Si ha iniciado sesión, que aparezca su nombre de usuario para ir a su perfil, botón de añadir encuesta y cerrar sesión.
    * 
    */

    $imagen='/lib/includes/';

    if(isset($_SESSION["logged"])) {
        $conn = bdconnect();
        // mail del usuario
        $usuario = $_SESSION['logged'];
        // Consulta si el usuario existe
        $sql = "SELECT email, nombre, apellido1, apellido2 FROM usuarios WHERE email='$usuario'; ";
        $resultado = mysqli_query($conn, $sql);
        

        // Si existe
        if (mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_row($resultado);
            echo "
            <nav class='navbar navbar-expand-lg bg-dark'>
                <a class='navbar-brand' href='/'><img src='https://i.imgur.com/kNaUxb2.png' class='logo-navbar' /></a>
                <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNavAltMarkup' aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='dropdown ml-auto d-flex flex-column justify-content-center align-items-center'>
                    <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        <span>Hola, $row[1]</span> <i class='fa fa-user-circle-o' aria-hidden='true' width='px'></i>
                    </a>
                    <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                        <a class='dropdown-item' href='/create'>Crear encuesta</a>
                        <a class='dropdown-item' href='/profile'>Perfil</a>
                        <a class='dropdown-item' href='/logout'>Cerrar sesión</a>
                    </div>
                </div>
            </nav>
            ";
        }
        
    } else{
            
        echo "
        <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
            <a class='navbar-brand' href='/'><img src='https://i.imgur.com/kNaUxb2.png' class='logo-navbar' /></a>
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNavAltMarkup' aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarNavAltMarkup'>
                <div class='navbar-nav ml-auto'>
                    <a class='nav-item nav-link' href='/login'>Iniciar sesión</a>
                    <a class='nav-item nav-link' href='/registro'>Registrarse</a>
                </div>
            </div>
        </nav>
            ";


    }

}
?>
