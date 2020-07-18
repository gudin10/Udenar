<?php
    
   include_once dirname(__FILE__) . '/../../clasesGenericas/ConectorBD.php';
    include_once dirname(__FILE__) . '/../../clases/Pais.php';
    include_once dirname(__FILE__) . '/../../clases/Departamento.php';
    include_once dirname(__FILE__) . '/../../clases/Ciudad.php';
    include_once dirname(__FILE__) .'/../../clases/Trabajador.php';
    include_once dirname(__FILE__) .'/../../clases/Cursos.php';
    include_once dirname(__FILE__) .'/../../clases/InscripcionCursos.php';


   foreach ($_POST as $Variable => $Valor)${$Variable}=$Valor;
    foreach ($_GET as $Variable => $Valor)${$Variable}=$Valor;

$mensaje='';
if(isset($_GET['mensaje'])) $mensaje=$_GET['mensaje'];

if(isset($_POST['ins']))
{
    
}
$datos= Cursos::getListaEnObjetos(null, 'nombre');

$trabajador = new Trabajador('usuario', "'{$_SESSION['usuario']}'");
#$trabajador=new Trabajador('identificacion', $idTrabajador);

$lista='';
$valor2='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
        $inscritosCursos = InscripcionCursos::getDatosEnObjetos("idCursos={$objeto->getId()} and idTrabajador='{$trabajador->getIdentificacion()}'", null);

        if (count($inscritosCursos) > 0) {

            $objetoInscritoCursos = $inscritosCursos[0];
            $estado = 'Cancelar inscripción';
            $estadobtn = 'warning';
            //$estadotr = "success";
            $estadoimg = "glyphicon glyphicon-ok";
            $inscripcion = 'checked';
            $cadenaSQL2="select sum(valor) as Total from cursos, inscripcioncursos "
                    . "where cursos.id={$objeto->getId()} and inscripcioncursos.idcursos={$objetoInscritoCursos->getIdCursos()}";
            $datoss= ConectorBD::ejecutarQuery($cadenaSQL2, null);
            $valor2 = "{$datoss[0][0]}";
           
        } else {

            $objetoInscritoCursos = new InscripcionCursos(null, null);
            $estado = 'Inscribirse';
            $estadobtn = 'success';
            $estadoimg = "";
            //$estadotr = "";
            $inscripcion = '';
        }
        $lista.="<tr>";
        $lista.="<td>{$objeto->getNombre()}</td>"
        . "<td>{$objeto->getDescripcion()}</td>"
        . "<td>{$objeto->getFecha()}</td>"
        . "<td>{$objeto->getCreditos()}</td>"
                . "<td>{$objeto->getValor()}</td>";
       $lista .= "<td><form name='formulario' action='' method='post'>
    <input type='hidden' name='input' value=''>
    <input id='sel$i' type='checkbox' $inscripcion value='{$objeto->getId()}' name='valor' id='inscripcion' onclick=" . '"' . "if(this.checked == true){marcar(this.value, "
                        . "$i)} else{desmarcar(this.value, $i)}" . '"' . " style='display: none;'>
</form>"
                . "<span id='estadoSpan_$i' class='$estadoimg' aria-hidden='true' style='display:none;'></span>"
                . "<label id='estadoLabel_$i' for='sel$i' class='btn btn-$estadobtn tamanio'>"
                . "$estado"
                . "</label>"
                
                . "</td>";
         
         $lista.='</tr>';
    }
    
    
         

    
?>
<script src="presentacion/js/actualizacionDatos.js" type="text/javascript"></script>
<form name="formulario" action="" method="post">
    <input type="hidden" name="input" value="">
</form>
<div class="btn-group " role="group" aria-label="Basic example" style="margin-bottom: 30px;">
<button type="button" class="btn btn-secondary"><a href="interfaces/trabajador/reporte.php?export=pdf&idTrabajador=<?=$trabajador->getIdentificacion()?>" target="_blank" style="color: white">Exportar a Pdf</a></button>
<button type="button" class="btn btn-secondary"><a href="interfaces/trabajador/reporte.php?export=excel&idTrabajador=<?=$trabajador->getIdentificacion()?>" target="_blank" style="color: white">Exportar a excel</a></button>
</div>
<div class="page-header container-fluid">
    <h2 class="col-lg-8">CURSOS</h2>
    
</div>
<section class="container-fluid">
    <a href="inscripcionCursosActualizar.php"></a>
    <article class="table-responsive ">
        <table class="table table-hover">
            <tr class="info">
                <th>NOMBRE</th><th>DESCRIPCION</th><th>FECHA</th><th>HORAS</th><th>VALOR</th><th>Opciones</th>
            </tr>
            <?= $lista ?>
        </table>
    </article>
</section>
<!--<h2>VALOR TOTAL</h2><?=$valor2?>-->
<script type="text/javascript">

    function marcar(idCursos, posicion) {

        var datos = [{"servidor": "interfaces/trabajador/inscripcionCursosActualizar.php", "datos": "idCursos=" + idCursos + "&idTrabajador=<?= $trabajador->getIdentificacion() ?>&accion=inscrito"}]
        actualizarRegistro(datos)

        document.getElementById('estadoSpan_' + posicion).className = 'glyphicon glyphicon-ok'
        document.getElementById('estadoLabel_' + posicion).className = 'btn btn-warning tamanio'
        document.getElementById('estadoLabel_' + posicion).innerHTML = 'Cancelar inscripción'

    }

    function desmarcar(idCursos, posicion) {

        var datos = [{"servidor": "interfaces/trabajador/inscripcionCursosActualizar.php", "datos": "idCursos=" + idCursos + "&idTrabajador=<?= $trabajador->getIdentificacion() ?>&accion=noInscrito"}]
        actualizarRegistro(datos)

        document.getElementById('estadoSpan_' + posicion).className = ''
        document.getElementById('estadoLabel_' + posicion).className = 'btn btn-success tamanio'
        document.getElementById('estadoLabel_' + posicion).innerHTML = 'Inscribirse'

    }

    function actualizarEventos() {

        document.ordenEventos.submit()

    }

</script>
