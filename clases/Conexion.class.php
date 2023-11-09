<?php
class Conexion {
    private $host = "localhost";
    private $usuario = "root";
    private $contrasenia = "";
    private $base_de_datos = "cine";
    private $charset = "utf8";
    private $conexion = null;
    function __construct() {
        try{
            $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasenia, $this->base_de_datos);
            if ($this->conexion->connect_errno) {
                echo "Falló la conexión a MySQL: (" . $this->conexion->connect_errno . ") " . $this->conexion->connect_error;
                return false;
            }
            $this->conexion->query("SET NAMES {$this->charset}");
            $this->conexion->query("SET CHARACTER SET {$this->charset}");
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $this->conexion;
    }
    public function leerSelect($campos, $tablas, 
            $where = null, 
            $groupBy = null, 
            $having = null, 
            $orderBy = null,
            $limit = null){ 
        $sql = $this->sqlSelect($campos, $tablas, $where, $groupBy, $having,  $orderBy, $limit ); 
        $stmt = $this->conexion->query($sql);
        $resultado = $stmt->fetch_all(MYSQLI_ASSOC);
        return $resultado;
        
    }
    public function sqlSelect($campos, $tablas, 
            $where = null, 
            $groupBy = null, 
            $having = null, 
            $orderBy = null,
            $limit = null ){
        if (is_array($campos)){
            $listaCampos = implode(",",$campos);
        }else{
            $listaCampos = $campos;
        }
        $sql="SELECT $listaCampos FROM $tablas ";
        if ($where   != null)   $sql .=" WHERE $where ";
        if ($groupBy != null)   $sql .=" GROUP BY $groupBy ";
        if ($having  != null)   $sql .=" HAVING $having ";
        if ($orderBy != null)   $sql .=" ORDER BY $orderBy ";
        if ($limit   != null)   $sql .=" LIMIT $limit ";
        return $sql;
    }
    public function sqlEliminar($tabla, $id){
        $stmt = $this->conexion->prepare("DELETE FROM $tabla WHERE idpelicula = ?");
        if ($stmt){
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return true;
        }
        return false;
    }

    public function sqlInsertar($insertar){
        $titulo = $insertar['titulo'];
$tituloo = $insertar['tituloo'];
$sinopsis = $insertar['sinopsis'];
$idiomao = $insertar['idiomao'];
$fondo = $insertar['fondo'];
$poster = $insertar['poster'];
$estreno = $insertar['estreno'];
$duracion = $insertar['duracion'];
$trailer = $insertar['trailer'];
$estado = $insertar['estado'];
$generos = $insertar['generos'];   
        
        $sql = "INSERT INTO peliculas /* (titulo, titulooriginal, sinopsis, idiomaoriginal, fondo, poster, estreno, duracion, trailer, estado, idgenero) */ VALUES
                                    (null, '$titulo', '$tituloo', '$sinopsis', '$idiomao', '$fondo', '$poster', '$estreno', $duracion, '$trailer', '$estado', $generos)";
       
        if (mysqli_query($this->conexion,$sql)) {
            echo "New record created successfully";
      } else {
            echo "Error";
      }
       /*  $stmt = $this->conexion->prepare("INSERT INTO peliculas SET titulo=? ,titulooriginal=? ,sinopsis=? ,idiomaoriginal=? ,fondo=? ,poster=? ,estreno=? ,duracion=? ,trailer=? ,estado=? ,idgenero=?");
        if ($stmt){
            $stmt->bind_param("sssssssissi", "dsc", "dsc", "dsc", "dsc", "dsc", "dsc", "dsc", 1, "ads", "cas", 2); */

          /*   $stmt->bind_param("s", $insertar['titulo']);
            $stmt->bind_param("s", $insertar['tituloo']);
            $stmt->bind_param("s", $insertar['sinopsis']);
            $stmt->bind_param("s", $insertar['idiomao']);
            $stmt->bind_param("s", $insertar['fondo']);
            $stmt->bind_param("s", $insertar['poster']);
            $stmt->bind_param("s", $insertar['estreno']);
            $stmt->bind_param("i", $insertar['duracion']);
            $stmt->bind_param("s", $insertar['trailer']);
            $stmt->bind_param("s", $insertar['estado']);
            $stmt->bind_param("i", $insertar['generos']); */

      /*       $stmt->execute();
            return true;
        } */
/*         return false;
 */    }


public function sqlActualizar($insertar){
    $id = $insertar['id'];
    $titulo = $insertar['titulo'];
    $tituloo = $insertar['tituloo'];
    $sinopsis = $insertar['sinopsis'];
    $idiomao = $insertar['idiomao'];
    $fondo = $insertar['fondo'];
    $poster = $insertar['poster'];
    $estreno = $insertar['estreno'];
    $duracion = $insertar['duracion'];
    $trailer = $insertar['trailer'];
    $estado = $insertar['estado'];
    $generos = $insertar['generos'];   
   
   $stmt = $this->conexion->prepare("UPDATE peliculas
   SET titulo=?, titulooriginal=?, sinopsis=?, idiomaoriginal=?, fondo=?, poster=?, estreno=?, duracion=?, trailer=?, estado=?, idgenero=?
   WHERE idpelicula = ?");

$stmt->bind_param("sssssssissii", $titulo, $tituloo, $sinopsis, $idiomao, $fondo, $poster, $estreno, $duracion, $trailer, $estado, $generos, $id);
/* $stmt->bind_param("s", $tituloo);
$stmt->bind_param("s", $sinopsis);
$stmt->bind_param("s", $idiomao);
$stmt->bind_param("s", $fondo);
$stmt->bind_param("s", $poster);
$stmt->bind_param("s", $estreno);
$stmt->bind_param("i", $duracion);
$stmt->bind_param("s", $trailer);
$stmt->bind_param("s", $estado);
$stmt->bind_param("i", $generos);
 */

$stmt->execute();

if($stmt){
    return true;
}else{
    return false;
}
}
}
?>