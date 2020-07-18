<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../clases/Cursos.php';



$datos = Cursos::getListaEnObjetos(null, 'nombre');
$lista = '';

$mensaje = '';
if (isset($_GET['mensaje']))
    $mensaje = $_GET['mensaje'];
/* class="active */
for ($i = 0; $i < count($datos); $i++) {

    $objeto = $datos[$i];
    $lista .= '<tr">';
    $lista .= "<td>{$objeto->getNombre()}</td><td>{$objeto->getDescripcion()}</td><td>{$objeto->getFecha()}</td><td>{$objeto->getCreditos()}</td><td>{$objeto->getValor()}</td><td>{$objeto->getNumerosInscritos()}</td>";
    $lista .= '<td class="text-center">';
    $lista .= "<a href='principal.php?CONTENIDO=interfaces/administrador/cursosFormulario.php&accion=Modificar&id={$objeto->getId()}'><img src='presentacion/iconos/modificar_1.png' title='Modificar'></a>";
    $lista .= "<img src='presentacion/iconos/eliminar_1.png' title='Eliminar' onClick='eliminar(" . '"' . "{$objeto->getId()}" . '"' . ");'/>";
    $lista .="<a href='principal.php?CONTENIDO=interfaces/administrador/inscritosCursos.php&id={$objeto->getId()}'><img src='presentacion/iconos/inscritos.png' title='Inscritos'></a>";
    $lista .= '</td>';
    $lista .= '</tr>';
}
$cadenaSQL2="select sum(valor) as Total from cursos "
                    ;
            $datoss= ConectorBD::ejecutarQuery($cadenaSQL2, null);
$lista.="<h2>Valor Total Cursos:  {$datoss[0][0]}</h2>";
?>


<div class="" style="background: rgba(255, 255, 255, 1); border-radius: 10px; padding-top: 20px;">
    <div class="btn-group " role="group" aria-label="Basic example" style="margin-bottom: 30px;">
<button type="button" class="btn btn-secondary"><a href="interfaces/administrador/reporteC.php?export=pdf" target="_blank" style="color: white">Exportar a Pdf</a></button>
<button type="button" class="btn btn-secondary"><a href="interfaces/administrador/reporteC.php?export=excel" target="_blank" style="color: white">Exportar a excel</a></button>
</div>
    <div class="container-fluid page-header margin-top">
        <center><h2>Lista de Cursos</h2></center>
        <span class="alerta" ><?= $mensaje ?></span>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">

            <table class="table table-sm"><!--table-condensed-->
                <thead class="">
                    <tr class="info">
                        <th>NOMBRE</th><th>DESCRIPCION</th><th>FECHA</th><th>HORAS</th><th>VALOR</th><th> #Inscritos</th>
                        <th class="text-center">
                            <a href="principal.php?CONTENIDO=interfaces/administrador/cursosFormulario.php&accion=Adicionar"><img src="presentacion/iconos/adicionar.png" title="Adicionar"/></a>
                        </th>
                    </tr>
                </thead>
                <?= $lista ?>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">

    function eliminar(id) {
        if (confirm('Realmente desea eliminar este registro?'))
            location = 'principal.php?CONTENIDO=interfaces/administrador/cursosActualizar.php&accion=Eliminar&id=' + id;
    }

    time()

    function time() {
        setTimeout(function () {
            document.getElementById("alerta").style.display = "none";
        }, 5000);
    }

</script>
