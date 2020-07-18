<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once dirname(__FILE__) . '/../../clases/TipoNovedad.php';
include_once dirname(__FILE__) . '/../../clases/Novedad.php';
include_once dirname(__FILE__) . '/../../clases/Entidad.php';
require_once dirname(__FILE__) . '/../../clasesGenericas/ConectorBD.php';

foreach ($_POST as $variable => $valores) {
    ${$variable} = $valores;
}


$respuesta = ConectorBD::ejecutarQuery("select count(novedad) as total from novedad ".$cadenaSQL, NULL);

if ($accion == "contar") {
    //if($respuesta[0][0]>5){
    $num = ceil(($respuesta[0][0])/5);
        echo  $num; // Encontrasmos la cantidad de items.
    //}else{
      //  echo 1;
    //}
    
    
} else {
    // Obtenemos datos.
    $datos = ConectorBD::ejecutarQuery("select id, nombre, fechaInicio, fechaFin, descripcion, lugar, tipoNovedad, idEntidad, idCategoria from novedad $cadenaSQL offset $posicion limit 5 ", NULL);
    //Encapsulamos los datos con con su repectiva clase.
    $listasEs = array();
    for ($i = 0; $i < count($datos); $i++) {
        $novedad = new Novedad($datos[$i], NULL);
        $listasEs[$i] = $novedad;
    }

    $listadoNovedades = '';
    $listadoNovedades = '<table class="table" id="datosNovedad">
                <th>Inicio</th>
                <th>Fin</th>
                <th>Evento</th>
                <th>Tipo Evento</th>
                <th>Entidad</th>
                <th>Lugar</th>
                <th>Descripción</th>
                <th># inscritos</th>
                <th><a href="principal.php?CONTENIDO=administrador/novedadFormulario.php&accion=Adicionar"><img src="../presentacion/imagenes/iconos/adicionar.png"></a></th>';
    
    //cargamos los datos que vamos a devolber.
    for ($i = 0; $i < count($listasEs); $i++) {
        $novedadObjeto = $listasEs[$i];
        $listadoNovedades .= "<tr>";
        $listadoNovedades .= "<td>{$novedadObjeto->getFechaInicio()}</td><td>{$novedadObjeto->getFechaFin()}</td><td>{$novedadObjeto->getNombre()}</td><td>{$novedadObjeto->getIdTipoNovedadEnObjeto()}</td><td>{$novedadObjeto->getIdEntidadEnObjeto()->getNombre()}</td><td>{$novedadObjeto->getLugar()}</td><td>{$novedadObjeto->getDescripcion()}</td><td>{$novedadObjeto->getNumerosInscritos()}</td>";
        $listadoNovedades .= "<td><a href='principal.php?CONTENIDO=administrador/novedadFormulario.php&accion=Modificar&id={$novedadObjeto->getId()}'><img src='../presentacion/imagenes/iconos/modificar.png' title='Modificar'></a>";
        $listadoNovedades .= "<a href='principal.php?CONTENIDO=administrador/inscritosNovedad.php&id={$novedadObjeto->getId()}'><img src='../presentacion/imagenes/iconos/inscritos.png' title='Inscritos'></a>";
        $listadoNovedades .= "<a href='#'><img src='../presentacion/imagenes/iconos/eliminar.png' title='Eliminar' onclick='eliminar({$novedadObjeto->getId()})'></a>";
        $listadoNovedades .= "</tr>";
    }
    $listadoNovedades .= '</table>';
    echo $listadoNovedades;
}
    