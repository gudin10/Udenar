<?php
$cadena = str_replace('>>', '&', $_GET['valores']);
$cadena = str_replace('-', '=', $cadena);
?>

<html>
    <head>

        <link rel="stylesheet" href="../../presentacion/css/bootstrap.min.css">
        <link href="../../presentacion/css/estilos.css" rel="stylesheet" type="text/css"/>

        <script src="../../presentacion/js/jquery-3.3.1.min.js"></script>
        
        <title>ConexionSena</title>

    </head>

    <div id='carga' class="loader"></div>

    <div id="alerta" class="alert alert-info" role="info"><p class="text-center">  <strong>Notificando</strong> a los egresdos, porfavor mantega esta 
        pestaña abierta el sistema la cerrara cuando termine de notificar.</p></div>

</html>



<script>

    var val = '<?= $cadena ?>'

    var xmlhttp;
    //verificamos la version del navegador para asignar una conexión
    if (window.XMLHttpRequest) { //en caso de que sean navegadores modernos
        xmlhttp = new XMLHttpRequest();
    } else { //en caso de que se un navegador no moderno
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {

        //carga.className = "loader"
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) { //verificamos que todo se correcto
            //var mensaje = xmlhttp.responseText;
            //alert(mensaje)
            window.close();
        }

    }
    xmlhttp.open("POST", "notificacion.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(val);
    //alert(val)

</script>