<?php
require '../vendor/autoload.php';
/* En use se utiliza para decir donde está los ficheros */
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
/* Metodo  para cargar automaticamente una clase
en este caso se registra la funcion autoload para que se ejecute automáticamente
cuando no se indica donde está la descripción de la clase
*/
spl_autoload_register("autoload"); 
session_start();

function autoload ($clase){
    require_once __DIR__. "/../clases/$clase.class.php";
}
function iniciar_twig(){
    $loader = new FilesystemLoader( '../templates');
    $twig = new Environment($loader);
    if (isset($_SESSION['registrado'])){
        $twig->addGlobal('registrado', $_SESSION['registrado']);
    }
    else {
        $twig->addGlobal('registrado', false);
    }
    return $twig;
}