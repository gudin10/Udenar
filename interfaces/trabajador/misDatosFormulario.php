<?php
    include_once dirname(__FILE__) . '/../../clasesGenericas/ConectorBD.php';    
    include_once dirname(__FILE__) . '/../../clases/Pais.php';
    include_once dirname(__FILE__) . '/../../clases/Departamento.php';
    include_once dirname(__FILE__) . '/../../clases/Ciudad.php';
    include_once dirname(__FILE__) . '/../../clases/Usuario.php';
   include_once dirname(__FILE__) . '/../../clases/Trabajador.php';
    
    foreach ($_GET as $Variable => $Valor)
    ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor)
    ${$Variable} = $Valor;

    
$trabajador = new Trabajador('usuario', "'{$_SESSION['usuario']}'");

$ciudad = $trabajador->getCiudad();

$pais = $ciudad->getDepartamento()->getCodPais();
$foto = "presentacion/imagenes/" . $trabajador->getFoto() . "";
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

<section class="">
    <div class="contenidoFormulario" style="background: white; margin-top: 10px; border-radius: 10px;">
    <div class="container-fluid page-header margin-top">
        <center><h2>Modificar Mis Datos</h2> </center>  
    </div>
         <form method="post" action="principal.php?CONTENIDO=interfaces/trabajador/misDatosActualizar.php" enctype="multipart/form-data" name="formulario">

        <div class="inputFlotante">
                <label>Identificación </label>
                <input class="form-control" type="number" name="identificacion" placeholder="Identificacion" value="<?= $trabajador->getidentificacion() ?>">
            </div>

            <div class="inputFlotante">
                <label>Nombres </label>
                <input class="form-control" type="text" name="nombres" placeholder="Nombres" value="<?= $trabajador->getNombres() ?>">
            </div>

            <div class="inputFlotante">
                <label>Apellidos </label>
                <input class="form-control" type="text" name="apellidos" placeholder="Apellidos" value="<?= $trabajador->getApellidos() ?>">
            </div>

            <div class="inputFlotante">
                <label>Edad </label>
                <input class="form-control" type="number" name="edad" placeholder="Edad" value="<?= $trabajador->getEdad() ?>">
            </div>

            <div class="inputFlotante">
                <div class="radio">
                    <label  for="sexo">Sexo</label>
                </div>
                <?= Trabajador::getListaEnOptionsSexo($trabajador->getSexo()) ?>
            </div>

            <div class="inputFlotante">
                <label>Celular </label>    
                <input class="form-control" type="number" name="celular" placeholder="Celular"value="<?= $trabajador->getCelular() ?>">
            </div>
           
            
            <div class="inputFlotante">
                <label class="">País</label>
                <select class="form-control" name="pais" onchange="cargarDepartamentos(this.value)" required>
                    <?= Pais::getListaEnOptions("$codPais") ?>
                </select>
            </div>

            <div class="inputFlotante">
                <label class="">Departamento</label>
                <select class="form-control" name="codDepartamento" onchange="cargarCiudades(this.value)" required>
                    <option value="">Seleccione un País</option>
                </select>
            </div>

            <div class="inputFlotante">
                <label class="">Ciudad</label>
                <select class="form-control" name="codCiudad" required>
                    <option value="" style="color: red">Seleccione un departamento</option>
                </select>
            </div>

            <div class="inputFlotante">
                <label>Dirección </label>    
                <input class="form-control" type="text" name="direccion" placeholder="Dirección" value="<?= $trabajador->getDireccion() ?>">
            </div>

            <div class="inputFlotante" id="clave">
                <label>Clave</label>
                <input type="password" class="form-control" name="clave" placeholder="Contraseña" value="" required>
               
            </div>

            <div class="inputFlotante" id="confirmarClave">
                <label class="">Confirmar clave</label>

                
                    <input type="password" class="form-control" name="confirmarClave" placeholder="Confirmar contraseña" onkeyup="validarContrasenia()" required>
               
          
            </div>
            <div class="inputFlotante">
            <div id="confirmacion" class="form-group col-md-4"></div>



            <div class="form-group col-md-12 text-center">
                <hr/>
            </div>
            </div>
            <center><div class="fotoPerfil">


                <output id="list">

                    <img id="foto" src="<?= $foto ?>">    
                </output>

                    <label>Foto de perfil <center><input type="file" id="files" name="files" onchange="carcargarImagen(this.value)"></center></label>
                </div></center> 
                        <input type="hidden" name="identificacionAnterior" value="<?= $trabajador->getIdentificacion() ?>">
                        <input type="hidden" name="usuarioAnterior" value="<?= $trabajador->getUsuario() ?>">
                        
                        <center> <input type="submit"  class="btn btn-primary form-control" name="accion" value="Modificar" ></center>
    </form>

    </div>
 
<script>
    
    <?= Departamento::getDatosEnArreglosJS() ?>
    <?= Ciudad::getDatosEnArreglosJS() ?>
    cargarDepartamentos(document.formulario.pais.value)

    function cargarDepartamentos(codPais) {

        document.formulario.codDepartamento.length = 0;
        document.formulario.codDepartamento.length++;

        if (document.formulario.pais.selectedIndex === 0) {
            document.formulario.codDepartamento.options[document.formulario.codDepartamento.length - 1].value = '';
            document.formulario.codDepartamento.options[document.formulario.codDepartamento.length - 1].text = 'Seleccione una País';
        } else {
            document.formulario.codDepartamento.options[document.formulario.codDepartamento.length - 1].value = '';
            document.formulario.codDepartamento.options[document.formulario.codDepartamento.length - 1].text = 'Seleccione un Departamento';
        }

        for (var i = 0; i < departamentos.length; i++) {
            if (codPais === departamentos[i][2]) {

                document.formulario.codDepartamento.length++;
                document.formulario.codDepartamento.options[document.formulario.codDepartamento.length - 1].value = departamentos[i][0];
                document.formulario.codDepartamento.options[document.formulario.codDepartamento.length - 1].text = departamentos[i][1];
            }
        }
        cargarCiudades(document.formulario.codDepartamento.value);
    }

    function cargarCiudades(codDepartamento) {
        document.formulario.codCiudad.length = 0;
        document.formulario.codCiudad.length++; //aumentas mos una fila para adicionar una registro

        if (document.formulario.codDepartamento.selectedIndex === 0) {
            document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].value = '';
            document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].text = 'Selecione un Departamento';
        } else {
            document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].value = '';
            document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].text = 'Selecione una Ciudad';
        }

        for (var i = 0; i < ciudades.length; i++) {
            if (codDepartamento === ciudades[i][2]) {
                document.formulario.codCiudad.length++; //aumentas mos una fila para adicionar una registro
                document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].value = ciudades[i][0];
                document.formulario.codCiudad.options[document.formulario.codCiudad.length - 1].text = ciudades[i][1];
            }
        }
    }
    
    function archivo(evt) {
        
        var files = evt.target.files; // FileList object

        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            reader.onload = (function(theFile) {
                return function(e) {
                  // Insertamos la imagen
                 document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);

            reader.readAsDataURL(f);
        }
    }
             
    document.getElementById('files').addEventListener('change', archivo, false);

</script>
