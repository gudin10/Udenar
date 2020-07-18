<?php

class GrupoFamiliar{
	private $id;
	private $nombres;
	private $apellidos;
	private $edad;
        private $sexo;
	private $celular;
	private $ocupacion;
	private $parentesco;
	private $idTrabajador;
	
	public function __construct($campo, $valor) {
		if($campo!=null) {
			if(is_array($campo)) {
				foreach($campo as $Variable => $Valor) $this->$Variable = $Valor;
			} else {
				$cadenaSQL = "select id, nombres, apellidos, edad, sexo, celular, ocupacion, parentesco, idTrabajador from grupofamiliar where $campo = $valor;";
				
				$resultado = ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
				if(count($resultado)>0) {
					foreach($resultado[0] as $Variable => $Valor) $this->$Variable = $Valor;
				}
			}
		}
	}
        function getSexo() {
            return $this->sexo;
        }

        function setSexo($sexo) {
            $this->sexo = $sexo;
        }

        public function getNombreSexo() {
	 switch($this->sexo) {
		case 'F': return 'Femenino';
		case 'M': return 'Masculino';
		}
	}
        function getId() {
            return $this->id;
        }

        function getNombres() {
            return $this->nombres;
        }

        function getApellidos() {
            return $this->apellidos;
        }

        function getEdad() {
            return $this->edad;
        }

        function getCelular() {
            return $this->celular;
        }

        function getOcupacion() {
            return $this->ocupacion;
        }

        function getParentesco() {
            return $this->parentesco;
        }

        function getIdTrabajador() {
            return $this->idTrabajador;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setNombres($nombres) {
            $this->nombres = $nombres;
        }

        function setApellidos($apellidos) {
            $this->apellidos = $apellidos;
        }

        function setEdad($edad) {
            $this->edad = $edad;
        }

        function setCelular($celular) {
            $this->celular = $celular;
        }

        function setOcupacion($ocupacion) {
            $this->ocupacion = $ocupacion;
        }

        function setParentesco($parentesco) {
            $this->parentesco = $parentesco;
        }

        function setIdTrabajador($idTrabajador) {
            $this->idTrabajador = $idTrabajador;
        }

        	
	public function grabar() {
		$cadenaSQL = "insert into grupofamiliar (nombres, apellidos, edad, sexo, celular, ocupacion, parentesco, idTrabajador) values ('$this->nombres', '$this->apellidos', '$this->edad', '$this->sexo', '$this->celular', '$this->ocupacion', '$this->parentesco', '$this->idTrabajador');";
		ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
		//$cadenaSQL = "select max(id) as id from caficultor;";
		//$this->id = ConectorBD::ejecutarQuery($cadenaSQL, 'cafe')[0]['id'];
	}
	
	public function modificar() {
                $cadenaSQL = "update grupofamiliar set nombres='$this->nombres', apellidos = '$this->apellidos', edad = '$this->edad', sexo = '$this->sexo', celular = '$this->celular', ocupacion='$this->ocupacion',  parentesco = '$this->parentesco', idTrabajador = '$this->idTrabajador' where id ={$this->id};";
                print_r($cadenaSQL);
                ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
	}
         function eliminar() {
        $cadenaSQL = "delete from grupofamiliar where id= {$this->id} ";
        ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
    }
	
	private static function getLista($filtro, $orden) {
		$cadenaSQL = "select id, nombres, apellidos, edad, sexo, celular, ocupacion, parentesco, idTrabajador from grupofamiliar";
		if($filtro!=null) $cadenaSQL.=" where $filtro";
                if($orden!=null) $cadenaSQL.=" order by $orden";
                return ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
	}
	
	public static function getListaEnObjetos($filtro, $orden) {
		$datos = GrupoFamiliar::getLista($filtro, $orden);
		$grupo = array();
		for ($i = 0; $i < count($datos); $i++) {
			$grupoFlia= new GrupoFamiliar($datos[$i], null);
                        $grupo[$i]=$grupoFlia;
                        } return $grupo;
	}
        public static function getListaEnOptionsSexo($predeterminado) {
        switch ($predeterminado) {
            case 'M': return ''
                        . '<label class="radio-inline"><input type="radio" class="" name="sexo" value="F">Femenino</label>'
                        . '<label class="radio-inline"><input type="radio" class="" name="sexo" value="M" checked="">Masculino</label>';
                break;
            case 'F': return ''
                        . '<label class="radio-inline"><input type="radio" class="" name="sexo" value="F"  checked="">Femenino</label>'
                        . '<label class="radio-inline"><input type="radio" class="" name="sexo" value="M">Masculino</label>';
                break;
            default: return ''
                        . '<label class="radio-inline"><input type="radio" class="" name="sexo" value="F">Femenino</label>'
                        . '<label class="radio-inline"><input type="radio" class="" name="sexo" value="M">Masculino</label>';
                break;
        }
}
}