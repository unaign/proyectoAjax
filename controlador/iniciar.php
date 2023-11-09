<?php 
 require "funciones.php";

if(isset($_POST)){ 
    $email=$_POST ['email'] ?? null;
    $contrasena=$_POST['contrasena'] ?? null;

    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
         iniciarSesion($email, $contrasena);
 
    }else{
        $_SESSION['error_login']="Error";
   }


}else{
    echo 'error';
 }

    function iniciarSesion($email, $contrasena){
    $con = new Conexion();
    $campos= "email, password";
    $tablas="usuarios";
    $where="email = '$email'";    
    $_SESSION['error_login']= "";
    $_SESSION['registrado'] = false;

    $resultado=$con->leerSelect($campos, $tablas, $where);

        if($resultado && count($resultado) == 1){
            // Comprobar la contraseña
            $usuario=$resultado[0];
          
          if(strcmp($contrasena, $usuario['password']) == 0){
                $_SESSION['email'] = $email;
                $_SESSION['registrado'] = true;
                header('Location: ../controlador/verPeliculas.php'); 
                exit;
            }else{

            echo 'error';
            $_SESSION['error_login']="Contraseña incorecta";
            header('Location: ../controlador/inicioSesion.php'); 
        }
        } else{

           $_SESSION['error_login']="Email incorrecto";
            header('Location: ../controlador/inicioSesion.php'); 
        } 
}



