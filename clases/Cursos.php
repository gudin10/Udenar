<?php

require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/Trabajador.php';

class Cursos {
    private $id;
    private $nombre;
    private $descripcion;
    private $fecha;
    private $creditos;
    private $valor;
    private $foto;
   
    
    public function __construct($campo, $valor) {
		if($campo!=null) {
			if(is_array($campo)) {
				foreach($campo as $Variable => $Valor) $this->$Variable = $Valor;
			} else {
				$cadenaSQL = "select id, nombre, descripcion, fecha,creditos, valor, foto  from cursos where $campo = $valor;";
				$resultado = ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
				if(count($resultado)>0) {
					foreach($resultado[0] as $Variable => $Valor) $this->$Variable = $Valor;
				}
			}
		}
	}
        function getCreditos() {
            return $this->creditos;
        }

        function getValor() {
            return $this->valor;
        }

        function setCreditos($creditos) {
            $this->creditos = $creditos;
        }

        function setValor($valor) {
            $this->valor = $valor;
        }

                function getId() {
            return $this->id;
        }

        function getNombre() {
            return $this->nombre;
        }

        function getDescripcion() {
            return $this->descripcion;
        }

        function getFecha() {
            return $this->fecha;
        }

        function getFoto() {
            return $this->foto;
        }
       

        

        function setId($id) {
            $this->id = $id;
        }

        function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }

        function setFecha($fecha) {
            $this->fecha = $fecha;
        }

        function setFoto($foto) {
            $this->foto = $foto;
        }

        

     public function grabar() {
		$cadenaSQL = "insert into cursos (nombre, descripcion, fecha, creditos, valor, foto) values ('$this->nombre','$this->descripcion', '$this->fecha',$this->creditos, $this->valor, '$this->foto')";
		ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
	}
	
	public function modificar() {
		$cadenaSQL = "update cursos set nombre='$this->nombre', descripcion = '$this->descripcion', fecha = '$this->fecha', creditos=$this->creditos, valor=$this->valor, foto= '$this->foto' where id= {$this->id};";
		ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
	}
         function eliminar() {
        $cadenaSQL = "delete from cursos where id={$this->id}";
        ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
    }
	
    private static function getLista($filtro, $orden) {
		$cadenaSQL = "select id, nombre, descripcion, fecha, creditos, valor, foto from cursos";
		if($filtro!=null) $cadenaSQL.=" where $filtro";
                if($orden!=null) $cadenaSQL.=" order by $orden";
                return ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
	}
	
	public static function getListaEnObjetos($filtro, $orden) {
		$datos = Cursos::getLista($filtro, $orden);
		$listas = array();
		for ($i = 0; $i < count($datos); $i++) {
			$cursos= new Cursos($datos[$i], null);
                        $listas[$i]=$cursos;
                        } return $listas;
	}
        
        public function getNumerosInscritos() {

        $cadena = "select * from inscripcionCursos where idCursos=$this->id";
        return count(ConectorBD::ejecutarQuery($cadena, null));
    } 
    
    
}
