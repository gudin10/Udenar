<?php

require_once 'Trabajador.php';

class Usuario {

    private $usuario;
    private $clave;
    private $tipo;

    public function __construct($campo, $valor) {
        if ($campo != null) {
            if (is_array($campo)) {
                foreach ($campo as $Variable => $Valor)
                    $this->$Variable = $Valor;
            } else {
                $cadenaSQL = "select usuario, clave, tipo from usuario where $campo = $valor;";
                $resultado = ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
                if (count($resultado) > 0) {
                    foreach ($resultado[0] as $Variable => $Valor)
                        $this->$Variable = $Valor;
                }
            }
        }
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getClave() {
        return $this->clave;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getTrabajador() {
        return new Trabajador('identificacion', "'$this->usuario'");
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function grabar() {

        $cadenaSQL = "insert into Usuario (usuario, clave, tipo) values ('$this->usuario', md5('$this->clave'), '$this->tipo')";
		
        ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
    }

    public function modificar($usuarioAnterior) {
        //parent::modificar();
        //$this->idcaficultor = parent::getId();
		if($this->clave == ""){
			$cadenaSQL = "update usuario set usuario='$this->usuario', where usuario = '$usuarioAnterior'";
		}else{
			$cadenaSQL = "update usuario set usuario='$this->usuario', clave =md5('$this->clave'), tipo = '$this->tipo' where usuario = '$usuarioAnterior';";
		}
        
        ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
    }

    private static function getLista($filtro) {
        if ($filtro != null)
            $filtro = " where $filtro";
        $cadenaSQL = "select usuario, clave, tipo from Usuario$filtro;";
        return ConectorBD::ejecutarQuery($cadenaSQL, 'udenar');
    }

    public static function getListaEnObjetos($filtro) {

        $datos = Usuario::getLista($filtro);
        $usuarios = array();
        for ($i = 0; $i < count($datos); $i++) {
            $usuarios[$i] = new Usuario($datos[$i], null);
        } return $usuarios;
    }

    public static function validar($usuario, $clave) {

        $filtro = "usuario = '$usuario' and clave = md5('$clave') ";

        $datos = Usuario::getLista($filtro);

        if (count($datos) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function getMenu($tipo) {
        $menu = "";
        switch ($tipo) {
            case 'A':
                $menu = "
                   
            
            <li class='nav-item'>
            <b><a class='nav-link' href='principal.php?CONTENIDO=interfaces/administrador/trabajador.php'>TRABAJADORES</a></b>
            </li>
            
            <li class='nav-item'>
            <b><a class='nav-link' href='principal.php?CONTENIDO=interfaces/administrador/cursos.php'>CURSOS</a></b>
            </li>
            
            <li class='nav-item'>
            <b><a class='nav-link' href='index.php'>SALIR</a></b>
            </li>";
                break;
            case 'T':
                $menu = "
                    
    <li class='nav-item active'>
        <a class='nav-link' href='principal.php?CONTENIDO=interfaces/trabajador/misdatos.php'>MIS DATOS</a>
      </li>
    <li class='nav-item active'>
        <a class='nav-link' href='principal.php?CONTENIDO=interfaces/trabajador/cursosLista.php'>CURSOS</a>
      </li>
     
        <li class='nav-item active'>
           <a class='nav-link' href='index.php'>SALIR</a>
        </li>";
                break;
        }
        return $menu;
    }

}
