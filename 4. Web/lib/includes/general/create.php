<?php

function contenidocreate(){
    echo'
            <form name="Questionari" id="Questionari" action="name.php" method="POST" class="create-form">
            <!-- hace que la tabla sea responsive como pone en la classe -->                                 
                    <label><input required type="text" name="titulo" placeholder="Título o pregunta"></label>
                <div id="create-input" class="create-form">
                
                    <label><input required type="text" name="respuesta1" placeholder="Respuesta 1"/></label>

                    <label><input required type="text" name="respuesta2" placeholder="Respuesta 2"/></label>
                </div>
  
                    <button type="button" name="add" id="add" class="btn btn-primary">Añadir más opciones</button>
                    <span>Escoje el tipo de votación que prefieras:</span>        
                        <label><input type="radio" name="publipriv" value="1">Votacion Privada</label>
                        <label><input type="radio" name="publipriv" value="0" checked>Votacion Pública</label>
                    <!-- aqui va el captcha -->
                    <input class="btn-primary" type="submit" value="Crear encuesta">

                
            </form>';
}

?>