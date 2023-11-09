<?php
require "funciones.php";

$id = $_GET['idpelicula'];
$con = new Conexion();
$columnas = "Pl.*, G.DESCRIPCION as genero, P.NOMBRE, H.HORARIO, S.DESCRIPCION as sala";
$where = "pl.idpelicula = ".$id."";
/* $groupBy = "pl.idpelicula";
 */

$resultado = $con->leerSelect($columnas, "PELICULAS Pl 
left JOIN GENEROS G ON Pl.IDGENERO = G.IDGENERO
left JOIN peliculas_personas pr on pr.idpelicula = pl.idpelicula
left join personas p on p.idpersona = pr.idpersona
left join peliculas_fechas_horarios_salas pfhs on pfhs.idpelicula = pl.idpelicula
left join fechas f on f.idfecha = pfhs.idfecha
left join horarios h on h.idhorario = pfhs.idhorario
left join salas s on s.idsala = pfhs.idsala", $where/* , $groupBy */); 

$twig = iniciar_twig();
echo $twig -> render("estrenos.twig",  
            array(
                'resultado'=>$resultado,
            )
);
