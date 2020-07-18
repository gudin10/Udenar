<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once dirname(__FILE__) . '/../../clasesGenericas/ConectorBD.php';
include_once dirname(__FILE__) . '/../../clases/Cursos.php';



foreach ($_GET as $Variable => $Valor)
    ${$Variable} = $Valor;

$mensaje = '';
if (isset($_GET['mensaje']))
    $mensaje = $_GET['mensaje'];

if ($accion == 'Modificar')
    $cursos = new Cursos('id', $id);
else
    $cursos = new Cursos(null, null);
?>
<section style="background: white; margin-top: 10px; border-radius: 10px; padding: 50px;">
    <div class="container-fluid page-header margin-top">
        <h2><?= $accion ?>  Cursos </h2>
    </div>

    <article class="container thumbnail">
        <span class="alerta" id="mensaje"><?= $mensaje ?></span>
        <form class="formulario text-center" name="formulario" method="post" action="principal.php?CONTENIDO=interfaces/administrador/cursosActualizar.php">


            <div class="form-group">
                <label>Nombre</label>
                <input class="form-control" type="text" name="nombre" value="<?= $cursos->getNombre() ?>" required>
            </div>

            <div class="form-group">

                <label>Descripcion</label>
                <input class="form-control" type="text" name="descripcion" value="<?= $cursos->getDescripcion() ?>" size="20" maxlength="50" required>

            </div>
            <div class="inputFlotante">
                <label>fecha </label>
                <input class="form-control" type="date" name="fecha" placeholder="Fecha" value="<?= $cursos->getFecha() ?>">
            </div>
            <div class="form-group">

                <label>Creditos</label>
                <input class="form-control" type="number" name="creditos" value="<?= $cursos->getCreditos() ?>">

            </div>
            <div class="form-group">

                <label>Valor</label>
                <input class="form-control" type="number" name="valor" value="<?= $cursos->getValor() ?>">

            </div>

            <input type="hidden" name="id" value="<?= $cursos->getId()?>">
           <center> <input type="submit"  class="btn btn-primary form-control" name="accion" value="<?= $_GET['accion'] ?>" ></center>
        </form>
    </article>
</section>

