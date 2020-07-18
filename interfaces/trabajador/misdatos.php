<?php
include_once dirname(__FILE__) . '/../../clasesGenericas/ConectorBD.php';
include_once dirname(__FILE__) . '/../../clases/Pais.php';
include_once dirname(__FILE__) . '/../../clases/Departamento.php';
include_once dirname(__FILE__) . '/../../clases/Ciudad.php';
include_once dirname(__FILE__) . '/../../clases/Trabajador.php';

foreach ($_GET as $Variable => $Valor)
    ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor)
    ${$Variable} = $Valor;

$mensaje = '';
if (isset($_GET['mensaje']))
    $mensaje = $_GET['mensaje'];

$trabajador = new Trabajador('usuario', "'{$_SESSION['usuario']}'");

if (trim($trabajador->getFoto()) != null)
    $foto = $trabajador->getFoto();
?>
<section>

    <div class="container-fluid page-header margin-top">

        <span class="alerta" ><?= $mensaje ?></span>

        <div class="row justify-content-md-center" >
            <article class="listado" style="background: white; margin-top: 10px; display: block;     border-radius: 5px; ">

            </article>
        </div>
    </div>
    <div class="clearfix"></div>

    <article class="container-fluid">
        <div class="row justify-content-md-center">
            <table cellpadding="20" style="background: white; margin-top: 10px; border-radius: 10px; padding: 50px;">
                <thead>
                    <tr><th style="text-align: center" colspan="4"><h2 class="text-center">Mis Datos</h2>   </th></tr>
                </thead>
                <tbody>
                    
                    <tr >
                        <th colspan="4" style="text-align: center" >

                            <a href="principal.php?CONTENIDO=interfaces/trabajador/misDatosFormulario.php&identificacion=<?= $trabajador->getidentificacion() ?>">
                                <img src="presentacion/iconos/modificar_1.png" title="Modificar">
                            </a>
                            <a href="principal.php?CONTENIDO=interfaces/trabajador/grupoFamiliar.php&idTrabajador=<?= $trabajador->getidentificacion() ?>">
                                <img src="presentacion/iconos/grupo2.png" style='width:40px' title="Grupo Familiar">

                            </a>
                    </tr>
                   
                
                    <tr >
                        <th colspan="4" style="text-align: center" >Foto</th>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: center"><img src='presentacion/imagenes/<?= $foto ?>' style='height:100%; max-height:80px;'/></td>
                    </tr>
                
                    <tr>
                        <th>Identificacion: </th><td><?= $trabajador->getidentificacion() ?></td>
                        <th>Nombres: </th><td><?= $trabajador->getNombres() ?></td>
                    </tr>
                    <tr>
                        <th>Apellidos: </th><td><?= $trabajador->getApellidos() ?></td>
                        <th>Edad: </th><td><?= $trabajador->getEdad() ?></td>
                    </tr>
                    <tr>
                        <th>Sexo: </th><td><?= $trabajador->getSexo() ?></td>
                        <th>Celular: </th><td><?= $trabajador->getCelular() ?></td>
                    </tr>
                    <tr>
                        <th>Direccion: </th><td><?= $trabajador->getDireccion() ?></td>
                        <th>Departamento: </th><td><?= $trabajador->getCiudad()->getDepartamento() ?></td>
                    </tr>
                    <tr>
                        <th>Direccion: </th><td><?= $trabajador->getCiudad()->getDepartamento() ?></td>
                        <th>Cuidad Residencia: </th><td><?= $trabajador->getCiudad() ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </article>
</section>

<script type="text/javascript">

    time()

    function time() {
        setTimeout(function () {
            document.getElementById("alerta").style.display = "none";
        }, 5000);
    }

</script>
