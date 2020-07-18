<?php
    include_once dirname(__FILE__) . '/../../clasesGenericas/ConectorBD.php';    
    include_once dirname(__FILE__) . '/../../clases/Pais.php';
    include_once dirname(__FILE__) . '/../../clases/Departamento.php';
    include_once dirname(__FILE__) . '/../../clases/Ciudad.php';
    include_once dirname(__FILE__) . '/../../clases/Usuario.php';
    include_once dirname(__FILE__) . '/../../clases/Trabajador.php';

    
    foreach($_POST as $variable => $valor){
        ${$variable} = $valor;
    }
    foreach($_GET as $variable => $valor){
        ${$variable} = $valor;
    }
    switch ($accion){
    case 'Adicionar':
            date_default_timezone_set("America/Bogota");

    $origen = $_FILES['files']['tmp_name'];

    list($archivo, $extension) = explode('.', $_FILES['files']['name']);

    $destino = 'C:/xampp/htdocs/Udenar/presentacion/imagenes/' . $archivo . date('YmdHis') . '.' . $extension;

    if (move_uploaded_file($origen, $destino)) {
        
        $usuario = new Usuario(null, null);
        
        $usuario->setUsuario($identificacion);
        $usuario->setClave($clave);
        $usuario->setTipo('T');
        
        $usuario->grabar();

        
        $trabajador = new Trabajador(null, null);

        $trabajador->setIdentificacion($identificacion);
        $trabajador->setNombres($nombres);
        $trabajador->setApellidos($apellidos);
        $trabajador->setEdad($edad);
        $trabajador->setSexo($sexo);
        $trabajador->setCelular($celular);
        $trabajador->setDireccion($direccion);
        $trabajador->setFoto($archivo . date('YmdHis') . '.' . $extension);
        $trabajador->setCodCiudad($codCiudad);
        $trabajador->setUsuario($identificacion);
        
        $trabajador->grabar();
        
    } break;
    
    case 'Modificar':
    date_default_timezone_set("America/Bogota");

    $origen = $_FILES['files']['tmp_name'];

    list($archivo, $extension) = explode('.', $_FILES['files']['name']);

    $destino = 'C:/xampp/htdocs/Udenar/presentacion/imagenes/' . $archivo . date('YmdHis') . '.' . $extension;

    if (move_uploaded_file($origen, $destino)) {
        
        $usuario = new Usuario(null, null);
        
        $usuario->setUsuario($identificacion);
        $usuario->setClave($clave);
        $usuario->setTipo('T');
        
        $usuario->modificar($usuarioAnterior);

        
        $trabajador = new Trabajador(null, null);

        $trabajador->setIdentificacion($identificacion);
        $trabajador->setNombres($nombres);
        $trabajador->setApellidos($apellidos);
        $trabajador->setEdad($edad);
        $trabajador->setSexo($sexo);
        $trabajador->setCelular($celular);
        $trabajador->setDireccion($direccion);
        $trabajador->setFoto($archivo . date('YmdHis') . '.' . $extension);
        $trabajador->setCodCiudad($codCiudad);
        $trabajador->setUsuario($identificacion);
        
        $trabajador->modificar($identificacionAnterior);
        
    } 
    break;
    case 'Eliminar':
       
         $cadenaSQL2="delete from trabajador where identificacion='$identificacion'";
        ConectorBD::ejecutarQuery($cadenaSQL2, null);
        
        $cadenaSQL="delete from usuario where usuario='$identificacion'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
       
    }
    

  header('Location:principal.php?CONTENIDO=interfaces/administrador/trabajador.php');
?>
