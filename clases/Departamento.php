<?php

/*

 */

/**
 * Description of Departamento
 *
 * @author efagu
 */
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../clases/Pais.php';

class Departamento {
    private $codigo;
    private $nombre;
    private $codPais;

     function __construct($campo, $valor) {
        if($campo!=NULL){
            if(is_array($campo))$this->cargarObjetoDeVector($campo);
            else{
                $cadenaSQL="select codigo, nombre, codPais from departamento where $campo='$valor'";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if(count($resultado)>0) $this->cargarObjetoDeVector($resultado[0]);
            }
        }

    }
    private function cargarObjetoDeVector($vector){
        $this->codigo=$vector['codigo'];
        $this->nombre=$vector['nombre'];
        $this->codPais=$vector['codPais'];

    }
    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }


    function getCodPais() {
        return $this->codPais;
    }
    public function getPais(){
        return new Pais("codigo", $this->codPais);
     }
    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCodPais($codPais) {
        $this->codPais = $codPais;
    }
    public function __toString() {
        
        if($this->nombre == null){
            return "Desconocido";
        }else{
            return $this->nombre;
        }
        
    }

function  grabar(){
        $cadenaSQL="insert into departamento(codigo, nombre, codPais) values"
                ."('{$this->codigo}', '{$this->nombre}', '{$this->codPais}' )";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
function modificar($codAnterior){
        $cadenaSQL="update departamento set codigo='{$this->codigo}', nombre='{$this->nombre}', codPais='{$this->codPais}' where codigo='$codAnterior';";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
function eliminar(){
        $cadenaSQL="delete from departamento where codigo='{$this->codigo}'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
 public function getCiudades(){
     return Ciudad::getDatosEnObjetos("codDepartamento='{$this->codigo}'", 'nombre');
 }

 public static function getDatos($filtro, $orden){
        $cadenaSQL="select codigo, nombre, codPais from Departamento";
        if($filtro!=null) $cadenaSQL.=" where $filtro";
        if($orden!=null) $cadenaSQL.=" order by $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatosEnObjetos($filtro, $orden){
        $datos= Departamento::getDatos($filtro, $orden);
        $listasP= array();
        for ($i = 0; $i < count($datos); $i++) {
            $departamento=new Departamento($datos[$i], NULL);
            $listasP[$i]=$departamento;
        }
        return $listasP;
    }

    public static function getListaEnOptions($predeterminado){
        $departamentos= Departamento::getDatosEnObjetos(null, 'nombre');
        $lista='<option>Seleccione Departamento..</option>';
        for ($i = 0; $i < count($departamentos); $i++) {
            $departamento=$departamentos[$i];
            if($predeterminado==$departamento->getCodigo()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$departamento->getCodigo()}' $auxiliar>{$departamento->getNombre()}</option>";
        }
        return $lista;
    }
    public  static function getDatosEnArreglosJS(){
        $datos="var departamentos=new Array();\n";
        $departamentos= Departamento::getDatosEnObjetos(null, "nombre");
        for ($i = 0; $i < count($departamentos); $i++) {
            $departamento=$departamentos[$i];
            $datos.="departamentos[$i]=new Array();\n";
            $datos.="\tdepartamentos[$i][0]='{$departamento->getCodigo()}'\n";
            $datos.="\tdepartamentos[$i][1]='{$departamento->getNombre()}'\n";
            $datos.="\tdepartamentos[$i][2]='{$departamento->getcodPais()}'\n";

        }
        return $datos;
    }
}
