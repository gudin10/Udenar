<?php

/*

 */

/**
 * Description of Pais
 *
 * @author efagu
 */
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';

class Pais {
    private $codigo;
    private $nombre;

    function __construct($campo, $valor) {
        if($campo!=NULL){
            if(is_array($campo))$this->cargarObjetoDeVector($campo);
            else{
                $cadenaSQL="select codigo, nombre from Pais where $campo='$valor'";

                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if(count($resultado)>0) $this->cargarObjetoDeVector($resultado[0]);
            }
        }
    }
    private function cargarObjetoDeVector($vector){
        $this->codigo=$vector['codigo'];
        $this->nombre=$vector['nombre'];

    }
    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function __toString() {
        return $this->nombre;
    }

    function  grabar(){
        $cadenaSQL="insert into pais(codigo, nombre) values"
                ."('{$this->codigo}', '{$this->nombre}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificar($codigoAnterior){
        $cadenaSQL="update pais set codigo='{$this->codigo}', nombre='{$this->nombre}' where codigo='$codigoAnterior';";
        $resultado = ConectorBD::ejecutarQuery($cadenaSQL, null);
        if (is_array($resultado)) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function eliminar(){
        $cadenaSQL="delete from pais where codigo='{$this->codigo}'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public function getDepartamentosEnOptions($predeterminado){
        $departamentos= Departamento::getDatosEnObjetos("codPais='{$this->codigo}'", 'nombre');
        $lista='';
        for ($i = 0; $i < count($departamentos); $i++) {
            $departamento=$departamentos[i];
            if($predeterminado==$departamento->getCodigo()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$departamento->getCodigo()}' $auxiliar>{$departamento->getNombre()}</option>";

        }
    }

    public static function getDatos($filtro, $orden){
        $cadenaSQL="select codigo, nombre from Pais";
        if($filtro!=NULL) $cadenaSQL.=" where $filtro";
        if($orden!=NULL) $cadenaSQL.=" order by $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatosEnObjetos($filtro, $orden){
        $datos= Pais::getDatos($filtro, $orden);
        $listasP= array();
        for ($i = 0; $i < count($datos); $i++) {
            $pais=new Pais($datos[$i], NULL);
            $listasP[$i]=$pais;
        }
        return $listasP;
    }
    public static function getListaEnOptions($predeterminado){
        $paises= Pais::getDatosEnObjetos(null, 'nombre');
        $lista='<option value="">Seleccione un país</option>';
        for ($i = 0; $i < count($paises); $i++) {
            $pais=$paises[$i];
            if($predeterminado==$pais->getCodigo()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$pais->getCodigo()}' $auxiliar>{$pais->getNombre()}</option>";
        }
        return $lista;
    }

}
