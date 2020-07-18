<?php

require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';

class Trabajador {
    private $identificacion;
    private $nombres;
    private $apellidos;
    private $edad;
    private $sexo;
    private $celular;
    private $direccion;
    private $foto;
    private $codCiudad;
    private $usuario;
    
    public function __construct($campo, $valor) {
		if($campo!=null) {
			if(is_array($campo)) {
				foreach($campo as $Variable => $Valor) $this->$Variable = $Valor;
			} else {
				$cadenaSQL = "select identificacion, nombres, apellidos, edad, sexo, celular, foto, direccion, codCiudad, usuario  from trabajador where $campo = $valor";
				$resultado = ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
				if(count($resultado)>0) {
					foreach($resultado[0] as $Variable => $Valor) $this->$Variable = $Valor;
				}
			}
		}
	}
        
        function getIdentificacion() {
            return $this->identificacion;
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

        function getSexo() {
            return $this->sexo;
        }
        public function getNombreSexo() {
		switch($this->sexo) {
			case 'M': return 'Masculino';
			case 'F': return 'Femenino';
		}
	}

        function getCelular() {
            return $this->celular;
        }

        function getDireccion() {
            return $this->direccion;
        }

        function getFoto() {
            return $this->foto;
        }

        function getCodCiudad() {
            return $this->codCiudad;
        }
         public function getCiudad(){
        return new Ciudad("codigo", $this->codCiudad);
    }

        function getUsuario() {
            return $this->usuario;
        }

        function setIdentificacion($identificacion) {
            $this->identificacion = $identificacion;
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

        function setSexo($sexo) {
            $this->sexo = $sexo;
        }

        function setCelular($celular) {
            $this->celular = $celular;
        }

        function setDireccion($direccion) {
            $this->direccion = $direccion;
        }

        function setFoto($foto) {
            $this->foto = $foto;
        }

        function setCodCiudad($codCiudad) {
            $this->codCiudad = $codCiudad;
        }

        function setUsuario($usuario) {
            $this->usuario = $usuario;
        }
        
        public function grabar() {
		$cadenaSQL = "insert into trabajador (identificacion, nombres, apellidos, edad, sexo, celular, foto, direccion, codCiudad, usuario) values ('$this->identificacion', '$this->nombres', '$this->apellidos', '$this->edad', '$this->sexo','$this->celular', '$this->foto', '$this->direccion', '$this->codCiudad', '$this->identificacion')";
		
			ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
	}
	
	public function modificar($identificacionAnterior) {
		$cadenaSQL = "update trabajador set identificacion='$this->identificacion', nombres = '$this->nombres', apellidos = '$this->apellidos', edad = '$this->edad', sexo='$this->sexo', celular = '$this->celular', foto='$this->foto',  direccion = '$this->direccion', codCiudad='$this->codCiudad' where identificacion = '$identificacionAnterior';";
                ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
	}
         function eliminar() {
        $cadenaSQL = "delete from trabajador where identificacion='{$this->identificacion}'";
        ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
    }
	
	private static function getLista($filtro, $orden) {
		$cadenaSQL = "select identificacion, nombres, apellidos, edad, sexo, celular, foto, direccion, codCiudad, usuario  from trabajador";
		if($filtro!=null) $cadenaSQL.=" where $filtro";
                if($orden!=null) $cadenaSQL.=" order by $orden";
                return ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
	}
	
	public static function getListaEnObjetos($filtro, $orden) {
		$datos = Trabajador::getLista($filtro, $orden);
		$trabajadores = array();
		for ($i = 0; $i < count($datos); $i++) {
			$trabajador= new Trabajador($datos[$i], null);
                        $trabajadores[$i]=$trabajador;
                        } return $trabajadores;
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
