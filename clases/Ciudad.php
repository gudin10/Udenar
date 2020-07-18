<?php



class Ciudad {

    private $codigo;
    private $nombre;
    private $codDepartamento;

    function __construct($campo, $valor) {

        if ($campo != null) {
            if (is_array($campo))
                $this->cargarObjetoDeVector($campo);
            else {
                $cadenaSQL = "select codigo, nombre, codDepartamento from ciudad where $campo='$valor'";
                $resultado = ConectorBD::ejecutarQuery($cadenaSQL, null);
                if (count($resultado) > 0)
                    $this->cargarObjetoDeVector($resultado[0]);
            }
        }
    }

    private function cargarObjetoDeVector($vector) {
        $this->codigo = $vector['codigo'];
        $this->nombre = $vector['nombre'];
        $this->codDepartamento = $vector['codDepartamento'];
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCodDepartamento() {
        return $this->codDepartamento;
    }

    public function getDepartamento() {
        return new Departamento("codigo", $this->codDepartamento);
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCodDepartamento($codDepartamento) {
        $this->codDepartamento = $codDepartamento;
    }

    public function __toString() {
        
        if ($this->nombre == null) {
            return "Desconocido";
        } else {
            return $this->nombre;
        }
    }

    function grabar() {
        $cadenaSQL = "insert into ciudad(codigo, nombre, codDepartamento) values"
                . "('{$this->codigo}', '{$this->nombre}', '{$this->codDepartamento}' )";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    function modificar($codAnterior) {
        $cadenaSQL = "update ciudad set codigo='{$this->codigo}', nombre='{$this->nombre}', codDepartamento='{$this->codDepartamento}' where codigo='$codAnterior';";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    function eliminar() {
        $cadenaSQL = "delete from ciudad where codigo='{$this->codigo}'";
        $resultado = ConectorBD::ejecutarQuery($cadenaSQL, null);
        if (is_array($resultado)) {
            return true;
        } else {
            return false;
        }
    }

    public static function getDatos($filtro, $orden) {
        $cadenaSQL = "select codigo, nombre, codDepartamento from Ciudad";
        if ($filtro != NULL)
            $cadenaSQL .= " where $filtro";
        if ($orden != NULL)
            $cadenaSQL .= " order by $orden";
        return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getListaCiudades($orden) {
        $cadenaSQL = "select ciudad.nombre, departamento.nombre, Pais.nombre from ciudad, departamento, pais where codDepartamento=departamento.codigo and codPais=pais.codigo";
    }

    public static function getDatosEnObjetos($filtro, $orden) {
        $datos = Ciudad::getDatos($filtro, $orden);
        $listasP = array();
        for ($i = 0; $i < count($datos); $i++) {
            $ciudad = new Ciudad($datos[$i], NULL);
            $listasP[$i] = $ciudad;
        }
        return $listasP;
    }

    public static function getDatosEnObjetosTablasCombinadas($tablas, $relaciones) {

        $cadenaSQL = "select ciudad.codigo, ciudad.nombre, ciudad.coddepartamento from Ciudad $tablas";

        if ($relaciones != null) {
            $cadenaSQL .= " where $relaciones";
        }

        $datos = ConectorBD::ejecutarQuery($cadenaSQL, null);
        $listasP = array();

        for ($i = 0; $i < count($datos); $i++) {
            $ciudad = new Ciudad($datos[$i], NULL);
            $listasP[$i] = $ciudad;
        }
        return $listasP;
    }

    public static function getListaEnOptions($predeterminado) {
        $ciudades = Ciudad::getDatosEnObjetos(null, 'nombre');
        $lista = '<option value="">Seleccione una ciudad..</option>';
        for ($i = 0; $i < count($ciudades); $i++) {
            $ciudad = $ciudades[$i];
            if ($predeterminado == $ciudad->getCodigo())
                $auxiliar = 'selected';
            else
                $auxiliar = '';
            $lista .= "<option value='{$ciudad->getCodigo()}' $auxiliar>{$ciudad->getNombre()}</option>";
        }
        return $lista;
    }

    public static function getDatosEnArreglosJS() {
        $datos = "var ciudades=new Array();\n";
        $ciudades = Ciudad::getDatosEnObjetos(null, "nombre");
        for ($i = 0; $i < count($ciudades); $i++) {
            $ciudad = $ciudades[$i];
            $datos .= "ciudades[$i]=new Array();\n";
            $datos .= "\tciudades[$i][0]='{$ciudad->getCodigo()}'\n";
            $datos .= "\tciudades[$i][1]='{$ciudad->getNombre()}'\n";
            $datos .= "\tciudades[$i][2]='{$ciudad->getcodDepartamento()}'\n";
        }
        return $datos;
    }

}
