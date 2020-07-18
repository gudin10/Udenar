<?php

/* 
 */
require_once dirname(__FILE__) . '/../../clases/Trabajador.php';
require_once dirname(__FILE__) . '/../../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../../clases/InscripcionCursos.php';

foreach ($_POST as $Variable => $Valor)${$Variable}=$Valor;
foreach ($_GET as $Variable => $Valor)${$Variable}=$Valor;



switch ($accion) {
    case 'inscrito':
        $inscripcionCursos=new InscripcionCursos(null, null);
        $fecha= ConectorBD::ejecutarQuery("select now()", null)[0][0];
        $inscripcionCursos->setFecha($fecha);
        $inscripcionCursos->setIdCursos($idCursos);
        $inscripcionCursos->setIdTrabajador($idTrabajador);
        if($inscripcionCursos->grabar()){
            echo 'true';
        }else{
            echo 'false';
        }
    break;
    case 'noInscrito':
        $inscripcionCursos=new InscripcionCursos(null, null);
        $inscripcionCursos->setIdCursos($idCursos);
        $inscripcionCursos->setIdTrabajador($idTrabajador);
        if($inscripcionCursos->eliminarCombinado()){
            echo 'true';
        }else{
            echo 'false';
        }
    break;
}
//header("Location: ../principal.php?CONTENIDO=egresado/$tipo.php");