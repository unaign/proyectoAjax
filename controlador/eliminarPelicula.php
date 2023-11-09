<?php 
require "funciones.php";
$con = new Conexion();

if(isset($_GET)){
    $id = $_GET['idpelicula'];
    $tabla = "peliculas";
    $resultado = $con->sqlEliminar($tabla, $id);
    if($resultado){
        header('Location: ./verPeliculas.php'); 
    }
}else{
    echo 'error';
}
