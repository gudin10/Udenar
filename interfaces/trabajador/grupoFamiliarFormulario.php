<?php
    include_once dirname(__FILE__) . '/../../clasesGenericas/ConectorBD.php';    
    include_once dirname(__FILE__) . '/../../clases/Pais.php';
    include_once dirname(__FILE__) . '/../../clases/Departamento.php';
    include_once dirname(__FILE__) . '/../../clases/Ciudad.php';
    include_once dirname(__FILE__) . '/../../clases/Usuario.php';
    include_once dirname(__FILE__) . '/../../clases/Trabajador.php';
   include_once dirname(__FILE__) .'/../../clases/GrupoFamiliar.php';
    
   foreach ($_GET as $Variable=> $Valor) ${$Variable}=$Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable}=$Valor;

$mensaje = "";
if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
}

$trabajador=new Trabajador('identificacion', $idTrabajador);
if ($accion == 'Modificar') {

    $grupoFamiliar = new GrupoFamiliar('id', "'$id'");
} else
    $grupoFamiliar = new GrupoFamiliar(null, null);
    
?>

<style>
    
    .thumb {
        display: block;
        border-style: ridge;
        width: 150px;
        height: 180px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 10px;
        margin-top: 10px;
      }

    .contenidoFormulario{
        border-style: ridge;
        padding: 20px;
        overflow: auto;
    }.contenidoFormulario h2{
        text-align: center;
    }
    
    .inputFlotante{
        
        float: left;
        padding: 5px;
        margin: 5px;
        width: 400px;
        
    }.inputFlotante>label{
        
        display: inline-block;
        width: 100px;
        
    }.inputFlotante > input[type='number'], input[type='text'], input[type='password'], select{
        
        display: inline-block;
        width: 250px;
    }
    .inputFlotanteEnvio{
        
        float: left;
        width: 100%;
        text-align: center;
    }
    
    .fotoPerfil{
        display: block;
        width: 100%;
        overflow: auto;
    }.fotoPerfil img{
        display: block;
        border-style: ridge;
        width: 150px;
        height: 180px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 10px;
        margin-top: 10px;
    }.fotoPerfil label{
        
        display: block;
        margin: auto;
        text-align: center;
        margin-bottom: 20px;
    }
    
</style>

<div class="contenidoFormulario" style="background: white; margin-top: 10px; border-radius: 10px;">
<div class="contenidoFormulario">
    <center><h3 class="text-center"><?= $accion ?> Grupo Familiar</h3></center>
    <form method="post" action="principal.php?CONTENIDO=interfaces/trabajador/grupoFamiliarActualizar.php&idTrabajador=<?=$trabajador->getidentificacion()?>" enctype="multipart/form-data" name="formulario">

        <div class="inputFlotante">
            <label>Nombres </label>
            <input type="text" name="nombres" placeholder="Nombres" value="<?=$grupoFamiliar->getNombres()?>">
        </div>

        <div class="inputFlotante">
            <label>Apellidos </label>
            <input type="text" name="apellidos" placeholder="Apellidos" value="<?=$grupoFamiliar->getApellidos()?>">
        </div>

        <div class="inputFlotante">
            <label>Edad </label>
            <input type="number" name="edad" placeholder="Edad" value="<?=$grupoFamiliar->getEdad()?>">
        </div>
        
        <div class="inputFlotante">
            <div class="radio">
                        <label  for="sexo">Sexo</label>
                    </div>
                    <?= GrupoFamiliar::getListaEnOptionsSexo($grupoFamiliar->getSexo()) ?>
                </div>
        
        <div class="inputFlotante">
            <label>Celular </label>    
            <input type="number" name="celular" placeholder="Celular"value="<?=$grupoFamiliar->getCelular()?>">
        </div>
         
       <div class="inputFlotante">
            <label>Ocupacion </label>    
            <input type="text" name="ocupacion" placeholder="Ocupacion" value="<?=$grupoFamiliar->getOcupacion()?>">
        </div>
                  
       <div class="inputFlotante">
            <label>Parentesco </label>    
            <input type="text" name="parentesco" placeholder="parentesco" value="<?=$grupoFamiliar->getParentesco()?>">
        </div>
        
        <input type="hidden" name="id" value="<?= $grupoFamiliar->getId() ?>">
        <input type="hidden" name="idCaficultor" value="<?= $trabajador->getidentificacion() ?>">
                        <center> <input type="submit"  class="btn btn-primary form-control" name="accion" value="<?= $_GET['accion'] ?>" ></center>
    </form>

</div>
</div>

 
    