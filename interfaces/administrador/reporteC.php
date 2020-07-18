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
    $lista .= '<tr>';
    $lista .= "<td>{$objeto->getNombre()}</td>"
    . "<td>{$objeto->getDescripcion()}</td>"
    . "<td>{$objeto->getFecha()}</td>"
    . "<td>{$objeto->getCreditos()}</td>"
    . "<td>{$objeto->getValor()}</td>";
    
    $lista .= '</tr>';
}
$cadenaSQL2="select sum(valor) as Total from cursos "
                    ;
            $datoss= ConectorBD::ejecutarQuery($cadenaSQL2, null);
$lista.="<h2>Valor Total Cursos:  {$datoss[0][0]}</h2>";

if(isset($_GET['export'])) {
	if($_GET['export']=='excel'){
		$filename = "reporte.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=".$filename);
	} else {
		require_once dirname(__FILE__) . '../../../lib/mpdf/mpdf.php';
		$html = '<center><h3>Reporte Cursos</h3></center>
                        <table border="1">
                        
    <tr><th>NOMBRE</th><th>DESCRIPCION</th><th>FECHA</th><th>CREDITOS</th><th>VALOR</th>
       </tr>';
              $cadenaSQL2="select sum(valor) as Total from cursos "
                    ;
            $datoss= ConectorBD::ejecutarQuery($cadenaSQL2, null);
                      
		$html.=$lista;
		$html.='</table>';
                $html.="<h2>Valor Total Cursos:".$datoss[0][0];
                $mpdf=new mPDF('c');
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit();
	}
}
?>


<div class="" style="background: rgba(255, 255, 255, 1); border-radius: 10px; padding-top: 20px;">
    <div class="container-fluid page-header margin-top">
        <center><h2>Lista de Cursos</h2></center>
        <span class="alerta" ><?= $mensaje ?></span>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">

            <table class="table table-sm"><!--table-condensed-->
                <thead class="">
                    <tr class="info">
                        <th>NOMBRE</th><th>DESCRIPCION</th><th>FECHA</th><th>CREDITOS</th><th>VALOR</th>
                        
                    </tr>
                </thead>
                <?= $lista ?>
            </table>
        </div>
    </div>
</div>



