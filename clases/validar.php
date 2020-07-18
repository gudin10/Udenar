<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) .'/../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) .'/Usuario.php';

$usuario=$_POST['usuario'];
$clave=$_POST['clave'];

if(Usuario::validar($usuario, $clave)){
    session_start();
    $_SESSION['usuario']=$usuario;
    header('Location: ../principal.php?CONTENIDO=interfaces/trabajador/inicio.php');
}else{
    $mensaje='usuario y/o contraseña no valida';
    header("Location: ../index.php?mensaje=$mensaje");
}
