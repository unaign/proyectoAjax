<?php
class Pelicula extends Conexion{
    private $conexion = null;
    function __construct() {
        $this->conexion = parent::__construct();
    }



/*     function mostrarPelicular 
 */




/* 
    SELECT Pl.*, G.DESCRIPCION as genero, P.NOMBRE, H.HORARIO, S.DESCRIPCION as sala FROM PELICULAS Pl 
    left JOIN GENEROS G ON Pl.IDGENERO = G.IDGENERO
    left JOIN peliculas_personas pr on pr.idpelicula = pl.idpelicula
    left join personas p on p.idpersona = pr.idpersona
    left join peliculas_fechas_horarios_salas pfhs on pfhs.idpelicula = pl.idpelicula
    left join fechas f on f.idfecha = pfhs.idfecha
    left join horarios h on h.idhorario = pfhs.idhorario
    left join salas s on s.idsala = pfhs.idsala;




    arreglar anteriores consultas porque he creado una tabla nueva en la base de datos
 */



}