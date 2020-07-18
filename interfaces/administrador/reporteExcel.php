<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

  include_once dirname(__FILE__) . '/../../clasesGenericas/ConectorBD.php';
    include_once dirname(__FILE__) . '/../../clases/Pais.php';
    include_once dirname(__FILE__) . '/../../clases/Departamento.php';
    include_once dirname(__FILE__) . '/../../clases/Ciudad.php';
    include_once dirname(__FILE__) .'/../../clases/Trabajador.php';

    $datos= Trabajador::getListaEnObjetos(null, null);
    $lista='';
    $mensaje='';
    
    for ($i = 0; $i < count($datos); $i++) {
        
         $objeto=$datos[$i];
         $lista.='<tr>';
         $lista .= "<td>{$objeto->getidentificacion()}</td><td>{$objeto->getNombres()}</td>"
         . "<td>{$objeto->getApellidos()}</td><td>{$objeto->getEdad()}</td>"
            . "<td>{$objeto->getNombreSexo()}</td><td>{$objeto->getCelular()}</td><td>{$objeto->getCiudad()}</td>"
            . "<td>{$objeto->getDireccion()}</td>";
   $lista.='<td>';
         $lista.='</td>';
         $lista.='</tr>';
         
}
if(isset($_GET['export'])) {
	if($_GET['export']=='excel'){
		$filename = "reporte.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=".$filename);
	} else {
		require_once dirname(__FILE__) . '../../../lib/mpdf/mpdf.php';
		$html = '<center><h3>Reporte Trabajadores</h3></center>
                        <table class="table table-sm" >
    <tr><th>IDENTIFICACION/ID</th><th>NOMBRES/NAME</th><th>APELLIDOS</th><th>EDAD</th><th>GENERO</th><th>CELULAR</th>
    <th>CIUDAD DE RESIDENCIA</th><th>DIRECCION</th>
       </tr>';
		$html.=$lista;
		$html.='</table>';
		$mpdf=new mPDF('c');
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit();
	}
}
    ?>
  <meta charset="UTF-8">
<h3 class="text-center">REPORTE DE TRABAJADORES</h3>
<div class="container">
<table class="table table-sm">
    <tr><th>IDENTIFICACION</th><th>NOMBRES</th><th>APELLIDOS</th><th>EDAD</th><th>GENERO</th><th>CELULAR</th>
        <th>CIUDAD DE RESIDENCIA</th><th>DIRECCION</th>
       </tr>
    <?=$lista?>
</table>
    </div>

