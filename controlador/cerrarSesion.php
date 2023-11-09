<?php 
require "funciones.php";
unset($_SESSION['email']);
session_destroy();

if(session_status()==PHP_SESSION_ACTIVE){
    echo 'sesion activa';
}else{
    echo 'sesion cerrada';
    header('Location: ../controlador/acerca.php'); 
}

