<?php
    include_once dirname(__FILE__) . '/../../clasesGenericas/ConectorBD.php';    
    include_once dirname(__FILE__) . '/../../clases/Pais.php';
    include_once dirname(__FILE__) . '/../../clases/Departamento.php';
    include_once dirname(__FILE__) . '/../../clases/Ciudad.php';
    include_once dirname(__FILE__) . '/../../clases/Usuario.php';
    include_once dirname(__FILE__) . '/../../clases/Trabajador.php';
       include_once dirname(__FILE__) .'/../../clases/GrupoFamiliar.php';

    
    foreach($_POST as $variable => $valor){
        ${$variable} = $valor;
    }
    foreach($_GET as $variable => $valor){
        ${$variable} = $valor;
    }
    switch ($accion){
    case 'Adicionar':
            
              
        $grupoFamiliar = new GrupoFamiliar(null, null);
        $grupoFamiliar->setNombres($nombres);
        $grupoFamiliar->setApellidos($apellidos);
        $grupoFamiliar->setEdad($edad);
        $grupoFamiliar->setSexo($sexo);
        $grupoFamiliar->setCelular($celular);
        $grupoFamiliar->setOcupacion($ocupacion);
        $grupoFamiliar->setParentesco($parentesco);
        $grupoFamiliar->setIdTrabajador($idTrabajador);
        $grupoFamiliar->grabar();
        
        
        
     break;
    
    case 'Modificar':
        $grupoFamiliar = new GrupoFamiliar(null, null);

        $grupoFamiliar->setId($id);
        $grupoFamiliar->setNombres($nombres);
        $grupoFamiliar->setApellidos($apellidos);
        $grupoFamiliar->setEdad($edad);
        $grupoFamiliar->setSexo($sexo);
        $grupoFamiliar->setCelular($celular);
        $grupoFamiliar->setNivelEducativo($nivelEducativo);
        $grupoFamiliar->setOcupacion($ocupacion);
        $grupoFamiliar->setRolGrupo($rolGrupo);
        $grupoFamiliar->setRetoSueños($retoSueños);
        $grupoFamiliar->setParentesco($parentesco);
        $grupoFamiliar->setIdTrabajador($idTrabajador);
        $grupoFamiliar->modificar();
        
    break;
    case 'Eliminar':
       
        $cadenaSQL2="delete from grupofamiliar where id=$id";
        ConectorBD::ejecutarQuery($cadenaSQL2, null);
        
    
        break;
    }  
    
    

//header('Location:principal.php?CONTENIDO=interfaces/administrador/grupofamiliar.php&idTrabajador='.$idTrabajador);
?>
