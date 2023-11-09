<?php
require "funciones.php";
$con = new Conexion();
$columnas=["p.idpelicula", "p.titulo", "p.sinopsis", "p.poster", "p.duracion, g.descripcion"];
$condicion=(!empty($_POST['fecha']))?$_POST['fecha']:null;
$condicion2="2023-04-20";
$condicion3= $_POST['fecha'];
$groupBy = "p.idpelicula";
 if ($condicion3 == ""){
    $where = " F.fecha = CURDATE()";
    $enviar = 'CURDATE()';
}  else{
    $where = " F.fecha = '{$condicion3}'";
    $enviar = $condicion3;

}
$resultado=$con->leerSelect($columnas,"PELICULAS P 
LEFT JOIN PELICULAS_FECHAS_HORARIOS_SALAS PFHS ON P.IDPELICULA = PFHS.IDPELICULA 
LEFT JOIN FECHAS F ON PFHS.IDFECHA = F.IDFECHA 
LEFT JOIN GENEROS G ON G.IDGENERO = P.IDGENERO", $where, $groupBy);
$html="";

 if($resultado){ 
/*     print_r($resultado);
 */    foreach($resultado as $key=>$linea){
        $html .="<section id='sectionMostrar'>";
        $html .="<img src='https://image.tmdb.org/t/p/w185".$linea['poster']."' alt='poster' class='foto'>";
        $html .="<article id='mostrarPelicula'>";
        $html .="<p>".$linea['titulo']."</td>";
        $html .="<p>".$linea['sinopsis']."</p>";
        $html .="<p>".$linea['duracion']." min</p>";
        $html .="<p>".$linea['descripcion']."</p>";
        $html .="<a href='../controlador/estrenos.php?idpelicula=".$linea['idpelicula']."&fecha=$enviar'><button type='button' id='botonMostrar' class='btn btn-primary'>Consultar horarios</button></a>";
        $html .="</article>";
        $html .="</section>";

    };
   
}else{
    $html .= "<h4 id='sinPelicula'>Lo sentimos, no hay peliculas en taquilla ese día.</h4>" ;

} 
$datos["html"]=$html;
$datos["json"]=$resultado;
echo json_encode($datos,JSON_UNESCAPED_UNICODE);
