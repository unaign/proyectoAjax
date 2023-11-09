<?php
require "funciones.php";
$con = new Conexion();
if(isset($_GET)){
    $id = $_GET['idpelicula'];
    $campos = "*";
    $tabla = "peliculas";
    $where = "idpelicula = ".$id."";
    $resultado = $con->leerSelect($campos, $tabla, $where);
    $generos = $con->leerSelect("*", "generos");
    $generoPeli = $con->leerSelect("*","generos right join peliculas on generos.idgenero = peliculas.idgenero", "idpelicula = ".$id."");

}

if(isset($_SESSION['registrado'])&& ($_SESSION['registrado']    )){
    $twig = iniciar_twig();

    echo $twig -> render("editarPelicula.twig",  
                array(
                    'resultado'=>$resultado,
                    'generos'=>$generos,
                    )
    );   
}else{
    echo 'Tienes que iniciar sesión para entrar en esta página.<br>';
    echo '<a href="../controlador/acerca.php">Volver al inicio</a>';
}
 


