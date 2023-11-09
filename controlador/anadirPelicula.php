<?php
require "funciones.php";
$con = new Conexion();
$campos = "*";
$tablas = "generos";
$resultado = $con->leerSelect($campos, $tablas);
if(isset($_SESSION['registrado'])&& ($_SESSION['registrado']    )){
    $twig = iniciar_twig();
    echo $twig -> render("anadirPelicula.twig",  
                array(
                    'resultado'=>$resultado,
                    )
    );
    
}else{
    echo 'Tienes que iniciar sesión para entrar en esta página.<br>';
    echo '<a href="../controlador/acerca.php">Volver al inicio</a>';
    
}
 


