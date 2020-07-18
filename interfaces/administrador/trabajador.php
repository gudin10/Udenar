<?php
include_once dirname(__FILE__) . '/../../clasesGenericas/ConectorBD.php';
include_once dirname(__FILE__) . '/../../clases/Pais.php';
include_once dirname(__FILE__) . '/../../clases/Departamento.php';
include_once dirname(__FILE__) . '/../../clases/Ciudad.php';
include_once dirname(__FILE__) . '/../../clases/Trabajador.php';

$datos = Trabajador::getListaEnObjetos(null, null);
$lista = '';
$mensaje = '';

for ($i = 0; $i < count($datos); $i++) {
    $objeto = $datos[$i];
    if (trim($objeto->getFoto()) != null)
        $foto = $objeto->getFoto();
    $lista .= '<tr>';
    $lista .= "<td><img src='presentacion/imagenes/{$foto}' style='height:100%; max-height:80px;'/></td><td>{$objeto->getidentificacion()}</td><td>{$objeto->getNombres()}</td><td>{$objeto->getApellidos()}</td><td>{$objeto->getEdad()}</td>"
            . "<td>{$objeto->getNombreSexo()}</td><td>{$objeto->getCelular()}</td><td>{$objeto->getCiudad()}</td><td>{$objeto->getDireccion()}</td>";
    $lista .= '<td>';
    $lista .= "<a href='principal.php?CONTENIDO=interfaces/administrador/trabajadorFormulario.php&accion=Modificar&identificacion={$objeto->getidentificacion()}'>"
            . "<img src='presentacion/iconos/modificar_1.png' title='Modificar'></a>";
    $lista .= "<img src='presentacion/iconos/eliminar_1.png' title='Eliminar' onClick='eliminar({$objeto->getidentificacion()});'/>";
    $lista .= "<a href='principal.php?CONTENIDO=interfaces/administrador/grupoFamiliar.php&idTrabajador={$objeto->getidentificacion()}'>"
            . "<img src='presentacion/iconos/grupo2.png' style='width:40px' title='GrupoFamiliar'></a>";

    $lista .= '</td>';
    $lista .= '</tr>';
}
?>


<div class="container-fluid" style="background: rgba(255, 255, 255, 1); border-radius: 10px; padding-top: 20px;">
    <h3 class="text-center" style="margin-top: 30px;">LISTA DE TRABAJADORES</h3>
    <div class="row justify-content-md-center">

        <div class="btn-group " role="group" aria-label="Basic example" style="margin-bottom: 30px;">
            <button type="button" class="btn btn-secondary"><a href="interfaces/administrador/reporteExcel.php?export=excel" target="_blank" style="color: white">Exportar a Excel</a></button>
            <button type="button" class="btn btn-secondary"><a href="interfaces/administrador/reporteExcel.php?export=pdf" target="_blank" style="color: white">Exportar a Pdf</a></button>
            <button type="button" class="btn btn-secondary"><a href="interfaces/administrador/reporteWord.php?export=word" target="_blank" style="color: white">Exportar a Word</a></button>
        </div>

    </div>

    <table class="table table-sm">
        
        <tr><th>FOTO</th><th>IDENTIFICACION</th><th>NOMBRES</th><th>APELLIDOS</th><th>EDAD</th><th>GENERO</th><th>CELULAR</th><th>CIUDAD DE RESIDENCIA</th><th>DIRECCION</th>
            <th><a href="principal.php?CONTENIDO=interfaces/administrador/trabajadorFormulario.php&accion=Adicionar">
                    <img src="presentacion/iconos/adicionar.png" title="Adicionar" /></a></th>
        </tr>
        <?= $lista ?>
    </table>
</div>




<script type="text/javascript">
    function eliminar(identificacion) {
        if (confirm('Realmente desea eliminar este registro?'))
            location = 'principal.php?CONTENIDO=interfaces/administrador/trabajadorActualizar.php&accion=Eliminar&identificacion=' + identificacion;
    }
</script>
