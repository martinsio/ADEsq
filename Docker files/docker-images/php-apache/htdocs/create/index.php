<?php
require '../lib/includes/style.php';
require '../lib/includes/recaptchalib.php';
require '../lib/includes/general/create.php';
require '../lib/includes/adesq.php';



session_start();
head("Crear encuesta");
navbar();
echo"<div class=\"container-fluid d-flex flex-column justify-content-center\">";
echo"<div class=\"container my-5 p-5 create\">";
$conn=bdconnect();

if ($_SESSION['logged']){ //Si existe una sesión
    $correo=$_SESSION['logged'];

    if (valuser($conn,$correo)){//Si el usuario que ha iniciado sesión existe
        echo "<h1 class='create-titulo'>Crear encuesta</h1>";
        contenidocreate();

    }else{
        session_destroy();
        header("Location: ./login");
}}else
    header("Location: ../login");

echo"</div></div>
<script>
const boton = document.getElementById('add');
boton.addEventListener(\"click\", function() {
    var i = document.getElementById('create-input').childElementCount;
    if (i <= 9){
        i++;
        const label = document.createElement('label');
        label.id = 'respuesta'+i;
        label.className = 'create-input-respuesta';

        const td = document.createElement('td');

        const select = document.getElementById('create-input').appendChild(label);

        select.innerHTML = '<input required type=\"text\" name=\"respuesta'+i+'\" placeholder=\"Respuesta '+i+'\"  />' +
        '<button type=\"button\" name=\"remove\" id=\"'+i+'\" class=\"btn btn-danger btn_remove\" onclick=\"deleteinput(this)\">X</button>' ;
    }
    else {
        alert (\"No puedes crear más\");
    }
});

function deleteinput(_this) {
   var el = document.getElementById( _this.id );
   el.parentNode.parentNode.removeChild( el.parentNode );

   var elements = document.getElementById('create-input').children;
   var count = document.getElementById('create-input').childElementCount;
   for(let i = 0; i < count ; i++){
       if (i > 1){
            let inputid = i+1;
            elements[i].id = 'respuesta'+inputid;
            labels = elements[i].children            
            labels[0].setAttribute('name','respuesta'+inputid)
            labels[0].setAttribute('placeholder','Respuesta '+inputid)
            labels[1].id = inputid
            console.log(inputid)
                
            
       }
   }


}

</script>
";
footer();

?>