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

//$trabajador = new Trabajador('usuario', "'{$_SESSION['usuario']}'");
$trabajador=new Trabajador('identificacion', $idTrabajador);

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
             $lista.="<tr>";
        $lista.="<td>{$objeto->getNombre()}</td>"
        . "<td>{$objeto->getDescripcion()}</td>"
        . "<td>{$objeto->getFecha()}</td>"
        . "<td>{$objeto->getCreditos()}</td>"
                . "<td>{$objeto->getValor()}</td>";
            $cadenaSQL2="select sum(valor) as Total from cursos, inscripcioncursos "
                    . "where cursos.id={$objeto->getId()} and inscripcioncursos.idcursos={$objetoInscritoCursos->getIdCursos()}";
            $datoss= ConectorBD::ejecutarQuery($cadenaSQL2, null);
            $valor2 += "{$datoss[0][0]}";
            
           
        } else {

            $objetoInscritoCursos = new InscripcionCursos(null, null);
            $estado = 'Inscribirse';
            $estadobtn = 'success';
            $estadoimg = "";
            //$estadotr = "";
            $inscripcion = '';
        }
       
       
         
         $lista.='</tr>';
    }
    if(isset($_GET['export'])) {
	if($_GET['export']=='excel'){
		$filename = "reporte.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=".$filename);
	} else {
		require_once dirname(__FILE__) . '../../../lib/mpdf/mpdf.php';
		$html = '<center><h3>Reporte Cursos</h3></center>
                        <table class="table table-sm" border="1" >
    <tr><th>NOMBRE</th><th>DESCRIPCION</th><th>FECHA</th><th>HORAS</th><th>VALOR</th>
       </tr>';
                        
		$html.=$lista;
		$html.='</table>';
                $html.='<h2>VALOR TOTAL='.$valor2;
		$mpdf=new mPDF('c');
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit();
	}
}
    
         

    
?>
<script src="presentacion/js/actualizacionDatos.js" type="text/javascript"></script>
<form name="formulario" action="" method="post">
    <input type="hidden" name="input" value="">
</form>
<div class="btn-group " role="group" aria-label="Basic example" style="margin-bottom: 30px;">
<button type="button" class="btn btn-secondary"><a href="interfaces/trabajador/reporteExcel.php?export=pdf" target="_blank" style="color: white">Exportar a Pdf</a></button>
<button type="button" class="btn btn-secondary"><a href="interfaces/trabajador/reporteExcel.php?export=excel" target="_blank" style="color: white">Exportar a excel</a></button>
</div>
<div class="page-header container-fluid">
    <h2 class="col-lg-8">CURSOS</h2>
    
</div>
<section class="container-fluid">
    <a href="inscripcionCursosActualizar.php"></a>
    <article class="table-responsive ">
        <table class="table table-hover">
            <tr class="info">
                <th>NOMBRE</th><th>DESCRIPCION</th><th>FECHA</th><th>CREDITOS</th><th>VALOR</th>
            </tr>
            <?= $lista ?>
        </table>
    </article>
</section>
<h2>VALOR TOTAL</h2><?=$valor2?>
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
