<?php
require "funciones.php";
$errores = "";

if(isset($_SESSION['error_login'])){ 
    $errores = $_SESSION['error_login'];
}
 $twig = iniciar_twig();
echo $twig -> render("inicioSesion.twig",  
            array(
            'errores'=>$errores
            )
);


