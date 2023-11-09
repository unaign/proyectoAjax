<?php 
require "funciones.php";
$con = new Conexion();
$validado = 0;
if(isset($_POST)){
$id = $_POST['idpelicula'];
$titulo = $_POST['titulo'];
$tituloo = $_POST['tituloo'];
$sinopsis = $_POST['sinopsis'];
$idiomao = $_POST['idiomao'];
$fondo = $_POST['fondo'];
$poster = $_POST['poster'];
$estreno = $_POST['estreno'];
$duracion = $_POST['duracion'];
$trailer = $_POST['trailer'];
$estado = $_POST['estado'];
$generos = $_POST['generos'];

if(!empty($titulo)){
    $validado++;
} 
if(!empty($tituloo)){
    $validado++;
} 
if(!empty($sinopsis)){
    $validado++;
} 
if(!is_numeric($idiomao)){
    $validado++;
} 

if(!empty($estreno) && !is_numeric($estreno)){
    $validado++;
} 

if(!empty($duracion) && is_numeric($duracion)){
    $validado++;
} 

if(!empty($estado) && !is_numeric($estado)){
    $validado++;
} 

if(is_numeric($generos)){
    $validado++;
} 

	if($validado == 8){

$insertar = [
    "id" => $id,
    "titulo" => $titulo,
    "tituloo" => $tituloo,
    "sinopsis" => $sinopsis,
    "idiomao" => $idiomao,
    "fondo" => $fondo,
    "poster" => $poster,
    "estreno" => $estreno,
    "duracion" => $duracion,
    "trailer" => $trailer,
    "estado" => $estado,
    "generos" => $generos
];

    $resultado =$con->sqlActualizar($insertar);
if($resultado){
    echo 'actualizado correctamente';
}else{
    print_r($resultado);
    echo 'error al actualizar';
}
}else{
    echo 'error al validar';
}

}