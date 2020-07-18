<?php
include_once dirname(__FILE__) . '/../../clases/Pais.php';
include_once dirname(__FILE__) . '/../../clases/Departamento.php';
include_once dirname(__FILE__) . '/../../clases/Ciudad.php';
?>

<head>
    <link rel="stylesheet" href="presentacion/css/estilos.css">
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="lib/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <link href="lib/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
     <link rel="stylesheet" href="presentacion/css/bootstrap.min.css">
        <link href="presentacion/css/estilos.css" rel="stylesheet" type="text/css"/>
    <meta charset="UTF-8">
    <title>UDENAR</title>

</head>
<body>

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

    <div class="container-fluid "style="background: url('presentacion/imagenes/u4nopaco.png'); background-repeat: no-repeat; background-position: center center;  ">
        <h2 style="text-align: center; color: #0056b3">REGISTRO TRABAJADOR</h2>
        <form method="post" action="interfaces/trabajador/registroGuardar.php" enctype="multipart/form-data" name="formulario">
            <center>
                <br><br>
   <div class="form-group col-md-4">
       <div class="">
                <label>Identificación </label>
                <input class="form-control" type="number" name="identificacion" placeholder="identificación">
       </div>    
       </div>
        <div class="form-group col-md-4">
       <div class="">
           <label>Nombres </label>
                <input class="form-control" type="text" name="nombres" placeholder="nombres">
            </div>
            </div>
         <div class="form-group col-md-4">
       <div class="">
            <label>Apellidos </label>
                <input class="form-control" type="text" name="apellidos" placeholder="apellidos">
            </div>
         </div>
            <div class="col-md-12">
                <hr/>
            </div>
             <div class="form-group col-md-4">
       <div class="">
                <label>Edad </label>
                <input class="form-control" type="number" name="edad" placeholder="edad">
            </div>
             </div>

             <div class="form-group col-md-4">
       <div class="">
                <label for="">Sexo </label>
                <label>M <input type="radio" name="sexo" value="M"></label>
                <label>F <input type="radio" name="sexo" value="F"></label>
            </div>
             </div>

                <div class="form-group col-md-4">
       <div class="">

                <label>Celular </label>    
                <input class="form-control" type="number" name="celular" placeholder="Celular">
            </div>
                </div>
<div class="col-md-12">
                <hr/>
            </div>

                  <div class="form-group col-md-4">
       <div class="">
                <label class="">País</label>
                <select class="form-control" name="pais" onchange="cargarDepartamentos(this.value)" required>
                    <?= Pais::getListaEnOptions(null) ?>
                </select>
            </div>
                  </div>

                  <div class="form-group col-md-4">
       <div class="">
                <label class="">Departamento</label>
                <select class="form-control" name="codDepartamento" onchange="cargarCiudades(this.value)" required>
                    <option value="">Seleccione un País</option>
                </select>
            </div>
                  </div>

                  <div class="form-group col-md-4">
       <div class="">
                <label class="">Ciudad</label>
                <select class="form-control" name="codCiudad" required>
                    <option value="" style="color: red">Seleccione un departamento</option>
                </select>
            </div>
                  </div>
          
              <div class="col-md-12">
                <hr/>
            </div>
                
           <div class="form-group col-md-4">
       <div class="">
                <label>Dirección </label>    
                <input type="text" class="form-control" name="direccion" placeholder="Dirección">
            </div> 
               </div>
                <div class="form-group col-md-4" >
                      <div class="" id="clave">
                 <label>Clave</label>
                <input type="password" class="form-control" name="clave" placeholder="Contraseña" value="" required>
               
            </div>
                  </div>
             <div class="form-group col-md-4" >
                      <div class="" id="confirmarclave">
                           <label class="">Confirmar clave</label>              
                    <input type="password" class="form-control" name="confirmarClave" placeholder="Confirmar contraseña" onkeyup="validarContrasenia()" required>         
            
            <div id="confirmacion" class="form-group col-md-12"></div>
                     
             </div>
             </div>
           
            <div class="form-group col-md-12 text-center">
                <hr/>
            </div>
            </div>
            <center> <div class="fotoPerfil">

                   
                <output id="list">
                    <img id="foto" src="presentacion/imagenes/perfil.png">    
                </output>

                    <label>Foto de perfil <center><input type="file" id="files" name="files" onchange="carcargarImagen(this.value)"></center></label>
                </div></center>
                </div>       
            <div class="form-group">
                <center> <input class="btn btn-primary" type="submit" name="registrar" value="Registro" style="margin-bottom: 50px; background: lightseagreen; width: 160px;">  </center> 
            </div>
</center>

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

                reader.onload = (function (theFile) {
                    return function (e) {
                        // Insertamos la imagen
                        document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result, '" title="', escape(theFile.name), '"/>'].join('');
                    };
                })(f);

                reader.readAsDataURL(f);
            }
        }

        document.getElementById('files').addEventListener('change', archivo, false);

function validarContrasenia() {

    var contrasenia = document.formulario.clave.value;
    var confirmacionClave = document.formulario.confirmarClave.value;
    if (contrasenia == confirmacionClave) {
        document.getElementById('confirmacion').innerHTML = "";
    } else
        document.getElementById('confirmacion').innerHTML = "<div id='confirmacion' class='alert alert-warning form-group col-md-6 col-md-offset-3 text-center' role='alert'>Las cotraseñas no coninciden</div>";

}

    </script>
</body>