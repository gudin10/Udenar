<?php
    
   include_once dirname(__FILE__) . '/../../clasesGenericas/ConectorBD.php';
    include_once dirname(__FILE__) . '/../../clases/Pais.php';
    include_once dirname(__FILE__) . '/../../clases/Departamento.php';
    include_once dirname(__FILE__) . '/../../clases/Ciudad.php';
    include_once dirname(__FILE__) .'/../../clases/Trabajador.php';
    include_once dirname(__FILE__) .'/../../clases/Cursos.php';

   foreach ($_POST as $Variable => $Valor)${$Variable}=$Valor;
    foreach ($_GET as $Variable => $Valor)${$Variable}=$Valor;

$mensaje='';
if(isset($_GET['mensaje'])) $mensaje=$_GET['mensaje'];

$datos= Cursos::getListaEnObjetos(null, 'nombre');

$trabajador=new Trabajador('identificacion', $idTrabajador);


$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    if ($objeto->getIdTrabajador()==$idTrabajador) {
        $lista.='<tr>';
        $lista.="<td>{$objeto->getNombre()}</td><td>{$objeto->getDescripcion()}</td><td>{$objeto->getFecha()}"
         . "<td>{$objeto->getOcupacion()}</td><td>{$objeto->getParentesco()}</td>";
         
         $lista.='</tr>';
    }
         
         
}
    
?>

<div class="container-fluid" style="background: rgba(255, 255, 255, 1); border-radius: 10px; padding-top: 20px;">
    <div class="dl-horizontal">
    <div class="container">
        <center><dt>Trabajador</dt><dd><?=$trabajador->getNombres()?></dd></center>
        </dl>

<div class="container">
    <center>
<h3 class="text-center" style="margin-top: 30px;">LISTA DE GRUPO FAMILIAR</h3>
<table class="table table-sm">
    <tr><th>NOMBRE</th><th>DESCRIPCION</th><th>FECHA</th><th>TRABAJADOR</th>
         </tr>
    <?=$lista?>
</table>
</div>

