<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . "/../../clasesGenericas/ConectorBD.php";
require_once dirname(__FILE__) . "/../../clases/ConectorBD.php";

foreach ($_POST as $variable => $valor) {
    ${$variable} = $valor;
}

$datos = Egresado::getDatosEnObjetos("identificacion = '$identificacion'", null);


for ($i = 0; $i < count($datos); $i++) {
    
    $egresado = new $datos[$i];
    
    
    
}
