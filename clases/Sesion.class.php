<?php
class Sesion extends Conexion{
    private $conexion = null;
    function __construct() {
        $this->conexion = parent::__construct();
    }

        public function iniciarSesion($email, $contrasena){
        $campos= "email, password";
        $tablas="usuarios";
        $where="email = '$email'";    

        $usuario=$this->conexion->leerSelect($campos, $tablas, $where);
    
        if($usuario && count($resultado) == 1){
    /*             $usuario = mysqli_fetch_assoc($resultado);
    */		
                // Comprobar la contraseña
                $verify = password_verify($contrasena, $usuario['password']);
                
                if($verify){
                    // Utilizar una sesión para guardar los datos del usuario logueado
                    $_SESSION['email'] = $usuario;
                    $redireccion = true;
                    echo'Inicio de sesion correcto';
                }else{
                    // Si algo falla enviar una sesión con el fallo
                    $_SESSION['error_login'] = "<p class='error'>*Contraseña incorrecta.</p>";
                    $redireccion = false;
                }
            }else{
                $_SESSION['error_login'] = "<p class='error'>*El email no existe en la base de datos.</p>";
                $redireccion = false;
            }
            
            if($redireccion==true){
            header('Location: ..controlador/acerca.php');
            
            }else{
            header('Location: ../controlador/iniciar.php');	
            }
        
        
        
        
        }

}