<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
//destruccion de la sesion
session_start();
session_unset();
session_destroy();
//fin destruccion de la sesion
if(isset($_GET['mensaje'])) $mensaje=$_GET['mensaje'];//isset solo funciona si recibe variable
else $mensaje='';//Debe tener null si no retorna error

$CONTENIDO = 'inicio.php';
if(isset($_GET['CONTENIDO'])){
    $CONTENIDO = $_GET['CONTENIDO'];
}

?>
<link rel="shortcut icon" type="image/x-icon" href="presentacion/iconos/uuu.ico">
<html>

<head>
    <meta charset="UTF-8">

    <title>UDENAR</title>
</head>

<body>
    
    <div id="general">
      
       <?php include $CONTENIDO ?>
        
    </div>
    
    
</body>

</html>
