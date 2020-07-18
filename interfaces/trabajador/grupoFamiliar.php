<?php
    
   include_once dirname(__FILE__) . '/../../clasesGenericas/ConectorBD.php';
    include_once dirname(__FILE__) . '/../../clases/Pais.php';
    include_once dirname(__FILE__) . '/../../clases/Departamento.php';
    include_once dirname(__FILE__) . '/../../clases/Ciudad.php';
    include_once dirname(__FILE__) .'/../../clases/Trabajador.php';
    include_once dirname(__FILE__) .'/../../clases/GrupoFamiliar.php';

   foreach ($_POST as $Variable => $Valor)${$Variable}=$Valor;
    foreach ($_GET as $Variable => $Valor)${$Variable}=$Valor;

$mensaje='';
if(isset($_GET['mensaje'])) $mensaje=$_GET['mensaje'];

$datos= GrupoFamiliar::getListaEnObjetos(null, 'nombres');

$trabajador=new Trabajador('identificacion', $idTrabajador);


$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    if ($objeto->getIdTrabajador()==$idTrabajador) {
        $lista.='<tr>';
        $lista.="<td>{$objeto->getNombres()}</td><td>{$objeto->getApellidos()}</td><td>{$objeto->getEdad()}</td><td>{$objeto->getNombreSexo()}</td><td>{$objeto->getCelular()}</td>"
         . "<td>{$objeto->getOcupacion()}</td><td>{$objeto->getParentesco()}</td>";
         $lista.='<td>';
         $lista.="<a href='principal.php?CONTENIDO=interfaces/trabajador/grupoFamiliarFormulario.php&accion=Modificar&id={$objeto->getId()}&idTrabajador={$objeto->getIdTrabajador()}'>"
         . "<img src='presentacion/iconos/modificar_1.png' title='Modificar'></a>";
         $lista.="<img src='presentacion/iconos/eliminar_1.png' title='Eliminar' onClick='eliminar({$objeto->getId()},{$objeto->getIdTrabajador()});'/>";
         $lista.='</td>';
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
    <tr><th>NOMBRES</th><th>APELLIDOS</th><th>EDAD</th><th>GENERO</th><th>CELULAR</th><th>OCUPACION</th><th>PARENTESCO</th>
        <th><a href="principal.php?CONTENIDO=interfaces/trabajador/grupoFamiliarFormulario.php&accion=Adicionar&idTrabajador=<?=$trabajador->getidentificacion()?>">
            <img src="presentacion/iconos/adicionar.png" title="Adicionar" /></a></th>
    </tr>
    <?=$lista?>
</table>
</div>
<script type="text/javascript">
    function eliminar(id, idTrabajador){
        if(confirm('Realmente desea eliminar este registro?'))
            location='principal.php?CONTENIDO=interfaces/trabajador/grupoFamiliarActualizar.php&accion=Eliminar&id='+id+'&idTrabajador='+idTrabajador;
    }
</script>
