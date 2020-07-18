<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../clases/Cursos.php';
require_once dirname(__FILE__) . '/../../clasesGenericas/ConectorBD.php';


foreach ($_POST as $Variable => $Valor)${$Variable}=$Valor;
foreach ($_GET as $Variable => $Valor)${$Variable}=$Valor;



switch ($accion) {
    case 'Adicionar':

    	$cursos = new Cursos(null, null);
        $cursos->setNombre($nombre);
        $cursos->setDescripcion($descripcion);
        $cursos->setFecha($fecha);
        $cursos->setCreditos($creditos);
        $cursos->setValor($valor);
        $cursos->grabar();
     break;
    
    case 'Modificar':
        
        $cursos = new Cursos(null, null);
        $cursos->setId($id);
        $cursos->setNombre($nombre);
        $cursos->setDescripcion($descripcion);
        $cursos->setFecha($fecha);
        $cursos->setCreditos($creditos);
        $cursos->setValor($valor);
        $cursos->modificar();
        break;
    case 'Eliminar':
       
         $cadenaSQL2="delete from cursos where id=$id";
        ConectorBD::ejecutarQuery($cadenaSQL2, null);
    }
  header('Location:principal.php?CONTENIDO=interfaces/administrador/cursos.php');
?>

