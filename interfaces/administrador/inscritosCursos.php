<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once dirname(__FILE__) . '/../../clases/Cursos.php';
include_once dirname(__FILE__) . '/../../clases/InscripcionCursos.php';
include_once dirname(__FILE__) . '/../../clases/Trabajador.php';

$idCursos = $_GET['id'];
$cursos = new Cursos('id', $idCursos);
$inscritosCursos = InscripcionCursos::getDatosEnObjetos("idcursos = $idCursos", null);
$listado = '';
for ($i = 0; $i < count($inscritosCursos); $i++) {
    $objeto = $inscritosCursos[$i];
    $listado .= '<tr>';
    $listado .= "<td>{$objeto->getTrabajadorEnObjeto()->getIdentificacion()}</td><td>{$objeto->getTrabajadorEnObjeto()->getNombres()}</td>"
    . "<td>{$objeto->getTrabajadorEnObjeto()->getEdad()}</td><td>{$objeto->getTrabajadorEnObjeto()->getCelular()}</td><td>{$objeto->getTrabajadorEnObjeto()->getDireccion()}</td>";
    $listado .= '</tr>';
}
?>
<section >

    
    <article class="container-fluid">
        <div class="panel panel-default table-responsive">
           <div class="panel-heading">
               <h3>Inscritos</h3>
           </div>
            <table class="table">

                <tr>
                    <th>Identificación</th><th>Trabajado</th><th>Edad</th><th>Celular</th><th>Direccion</th>
                </tr>

                <?= $listado ?>

            </table>    
        </div>
        

    </article>

</section>
