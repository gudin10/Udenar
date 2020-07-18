<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__) . '/../../clasesGenericas/ConectorBD.php';

foreach ($_POST as $variable => $valores) {
    ${$variable} = $valores;
}

//$cadenaSQL = "Select $consulta from $tabla where $campo = '$valor'";
$respuesta = ConectorBD::ejecutarQuery($cadenaSQL, null);

if(is_array($respuesta)){
    echo TRUE;
}else{
    echo FALSE;
}


