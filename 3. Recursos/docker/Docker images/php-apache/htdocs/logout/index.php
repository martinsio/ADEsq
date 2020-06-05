<?php
require '../lib/includes/style.php';

echo"dsds",

session_start();
head("Cerrar sesión");

session_destroy();

header("Location: /");
?>
