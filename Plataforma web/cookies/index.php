<?php
require '../lib/includes/style.php'; //Lib elementos comunes

head("Uso de cookies");
navbar();

echo'
<div class="container-fluid d-flex flex-column justify-content-center">
    <div class="container my-5 p-5">
        <p class="cookies-text">
        <h2 align="center">Declaración sobre cookies</h2>
        Nuestro sitio web utiliza cookies y otras tecnologías similares para proporcionarle una experiencia de navegación más completa y eficiente.
        <br>Visitando la web de ADESQ con el navegador configurado para aceptar cookies autoriza la utilización de cookies y otras tecnologías necesarias para la visualización, como se describe en esta nota informativa.
        <br><br><h3 class="cookies">Información sobre cookies</h3>
        Las cookies son pequeños archivos de texto que el sitio web guarda en la memoria del navegador o en su dispositivo durante la navegación. Como la mayoría de otros sitios web, utilizamos las cookies para entender cómo los usuarios utilizan nuestros servicios y mejorar en consecuencia.
        <br><br><h3 class="cookies">Autenticación y navegación</h3>
        Los visitantes anónimos son seguidos por una cookie de sesión que nos permite, por ejemplo, saber que usuarios visitaron nuestro sitio, cuánto tiempo navegaron y que página les gustó más. Esta información nos ayuda a mejorar continuamente nuestro sitio web y asegurar una evolución que cumpla con las expectativas del usuario.
        <br>Las cookies de sesión no recopilan información personal y se eliminan al final de la sesión de navegación o cerrar el navegador.
        <br><br>
        <h3 class="cookies">Estadística y navegación</h3>
        Las cookies nos permiten entender cómo los visitantes usan nuestros servicios y qué características o contenidos son más apreciados por los usuarios; Por ejemplo, las cookies nos proporcionan información sobre el número de usuarios que han visitado una página en particular o qué palabras clave han utilizado para llegar hasta allí.
        <br><br>
        <h3 class="cookies">Publicidad</h3>
        ADESQ puede utilizar cookies y balizas web para evaluar, por ejemplo, el rendimiento y la eficacia de los anuncios y boletines de noticias con el fin de proporcionar contenido de alta calidad e interés.
        <br><br>
        <h3 class="cookies">Rechazar o eliminar las cookies</h3>
        Puede cambiar la configuración en la mayoría de los navegadores web para que no acepten/rechacen cookies, o que se requiera su permiso cada vez que un sitio web intente enviarle una cookie. Aunque para algunas partes de nuestros servicios, las cookies no son necesarias, en caso de su completa desactivación el sitio web de ADESQ puede no funcionen correctamente.
        <br><br><b>También puede eliminar las cookies que ya están almacenadas en su dispositivo:</b>
        <br>Lea las instrucciones sobre la gestión de cookies en <a href="https://support.microsoft.com/es-es/help/17442/windows-internet-explorer-delete-manage-cookies">Internet Explorer</a>
        <br>Lea las instrucciones sobre la gestión de cookies en <a href="https://support.mozilla.org/es/kb/impedir-que-los-sitios-web-guarden-sus-preferencia">Firefox</a>
        <br>Lea las instrucciones sobre la gestión de cookies en <a href="https://support.google.com/chrome/answer/95647?co=GENIE.Platform%3DDesktop&hl=es">Google Chrome</a>
        <br>Lea las instrucciones sobre la gestión de cookies en <a href="https://support.apple.com/es-es/guide/safari/sfri11471/mac">Safari</a>
        <br>Lea las instrucciones sobre la gestión de cookies en <a href="https://help.opera.com/en/latest/web-preferences/#cookies">Opera</a>
        <br>Lea las instrucciones sobre la gestión de cookies en <a href="https://support.microsoft.com/es-es/help/4468242/microsoft-edge-browsing-data-and-privacy">Microsoft Edge</a>
        </p>
    </div>
</div>';

footer();

?>