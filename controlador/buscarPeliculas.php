<?php
require "funciones.php";
$con = new Conexion();
$columnas=["idpelicula","titulo", "titulooriginal","sinopsis","idiomaoriginal","fondo","poster","estreno" ,"duracion","trailer" ,"estado"];
$condicion=(!empty($_POST['campo']))?$_POST['campo']:null;
$column=["titulo", "titulooriginal","sinopsis"];
$where =null;
if ($condicion != null){
    $where = " (";
    $count=count($column);
    for($i = 0; $i < $count; $i++){
        $where .= $column[$i]." LIKE '%".$condicion."%' OR ";
    }
    $where = substr_replace($where,"", -3);
    $where .= ")";
}
$resultado=$con->leerSelect($columnas,"peliculas",$where);
$html="";
foreach($resultado as $linea){
    $html .="<section id='sectionMostrar'>";
    /*     $html .="<td class='col px-2 text-center'>".$linea['idpelicula']."</td>";
 */         $html .="<img src='https://image.tmdb.org/t/p/w185".$linea['poster']."' alt='poster' class='foto'>";  
 $html .="<article id='mostrarPelicula'>";
 
 $html .="<p>".$linea['titulo']."</td>";
 $html .="<p>".$linea['sinopsis']."</p>";
 $html .="<p>".$linea['duracion']." min</p>";
 $html .="<a href='editarPelicula.php?idpelicula=".$linea['idpelicula']."'><button type='button' class='btn btn-primary'>Editar Película</button></a>";
 $html .="<a href='eliminarPelicula.php?idpelicula=".$linea['idpelicula']."'><button type='button' id='botonEliminar' class='btn btn-danger'>Eliminar Película</button></a>";
    $html .="</article>";
    $html .="</section>";}
echo json_encode($html,JSON_UNESCAPED_UNICODE);