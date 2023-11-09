<?php
require "funciones.php";
if(isset($_SESSION['registrado'])&& ($_SESSION['registrado']    )){
    $twig = iniciar_twig();

    echo $twig -> render("verPeliculas.twig",  
                array(
    
                    )
    );   
}else{
    echo 'Tienes que iniciar sesión para entrar en esta página.<br>';
    echo '<a href="../controlador/acerca.php">Volver al inicio</a>';
}
 

