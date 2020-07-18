<!DOCTYPE html>

<?php
session_start(); //crea o mantiene la sesion, asi se tiene acceso a las variables de sesion creadas
if (!isset($_SESSION['usuario'])) {
    $mensaje = "sesion no valida";
    header("Location: index.php?mensaje=$mensaje");
}

include_once dirname(__FILE__) . '/clasesGenericas/ConectorBD.php';
include_once dirname(__FILE__) . '/clases/Usuario.php';
include_once dirname(__FILE__) . '/clases/Departamento.php';
include_once dirname(__FILE__) . '/clases/Ciudad.php';
include_once dirname(__FILE__) . '/clases/Pais.php';
include_once dirname(__FILE__) . '/clases/Trabajador.php';
include_once dirname(__FILE__) . '/clases/Cursos.php';

$USUARIO = new Usuario('usuario', $_SESSION['usuario']);
?>
<html>
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="presentacion/iconos/uuu.png">
        <link rel="stylesheet" href="presentacion/css/estilos.css">
        <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="lib/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="lib/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="presentacion/css/bootstrap.min.css">
        <link href="presentacion/css/estilos.css" rel="stylesheet" type="text/css"/>
        
        <meta charset="UTF-8">
        <title>UDENAR</title>

    </head>
    <body <!--style="background: url('presentacion/imagenes/u4.jpg'); "-->>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
                <a class="navbar-brand" href="#">
                    <img src="presentacion/iconos/uu2.png" width="60" height="80" alt="">
                </a>
                <!--<a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>-->

                <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample10">
          <ul class="navbar-nav">
                        <?= Usuario::getMenu($USUARIO->getTipo()) ?> 

                    </ul>
                    <!--<form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>-->
                </div>
            </nav>
        </div>

        <div class="container-fluid">
            <div id="contenido" style="margin-top: 50px;">
                <?php include $_GET['CONTENIDO'] ?>
            </div>

        </div>
        <div>
            
        </div>
        



    </body>
</html>
