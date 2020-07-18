<?php


require_once 'Trabajador.php';

class InscripcionCursos {
    private $id;
    private $fecha;
    private $idCursos;
    private $idTrabajador;

    function getId() {
        return $this->id;
    }

    function getFecha() {
        return $this->fecha;
    }

    

    function setId($id) {
        $this->id = $id;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function getIdCursos() {
        return $this->idCursos;
    }

    function getIdTrabajador() {
        return $this->idTrabajador;
    }
    function getTrabajadorEnObjeto() {
        return new Trabajador('identificacion', "'$this->idTrabajador'");
    }

    function setIdCursos($idCursos) {
        $this->idCursos = $idCursos;
    }

    function setIdTrabajador($idTrabajador) {
        $this->idTrabajador = $idTrabajador;
    }

    
    function __construct($campo, $valor) {
        if($campo!=NULL){
            if(is_array($campo))$this->cargarObjetoDeVector($campo);
            else{
                $cadenaSQL="select id, fecha, idCursos, idTrabajador from inscripcioncursos where $campo='$valor'";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if(count($resultado)>0) $this->cargarObjetoDeVector($resultado[0]);
                
            }
        }

    }
    private function cargarObjetoDeVector($vector){
        $this->id=$vector['id'];
        $this->fecha=$vector['fecha'];
        $this->idCursos=$vector['idCursos'];
        $this->idTrabajador=$vector['idTrabajador'];

    }
    function  grabar(){
        $cadenaSQL="insert into inscripcioncursos(fecha, idCursos, idTrabajador) values"
            ."('{$this->fecha}',{$this->idCursos},'{$this->idTrabajador}')";
        $resutado = ConectorBD::ejecutarQuery($cadenaSQL, null);
        if(is_array($resutado)){
            return true;
        }else{
            return false;
        }
    }
    function modificar(){
        $cadenaSQL="update inscripcioncursos set fecha='{$this->fecha}', idCursos={$this->idCursos}, idTrabajador={$this->idTrabajador} where id={$this->id};";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function eliminar(){
        $cadenaSQL="delete from inscripcioncursos where id={$this->id}";
        $resutado = ConectorBD::ejecutarQuery($cadenaSQL, null);
        if(is_array($resutado)){
            return true;
        }else{
            return false;
        }
    }
    function eliminarCombinado(){
        $cadenaSQL="delete from inscripcioncursos where idTrabajador='$this->idTrabajador' and idCursos=$this->idCursos";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getDatos($filtro, $orden){
        $cadenaSQL="select id,fecha, idCursos, idTrabajador from inscripcioncursos";
        if($filtro!=NULL) $cadenaSQL.=" where $filtro";
        if($orden!=NULL) $cadenaSQL.=" order by $orden";
       
        return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatosEnObjetos($filtro, $orden){
        $datos= InscripcionCursos::getDatos($filtro, $orden);
        $listasI= array();
        for ($i = 0; $i < count($datos); $i++) {
            $inscripcioncursoss=new InscripcionCursos($datos[$i], NULL);
            $listasI[$i]=$inscripcioncursoss;   
        }
        return $listasI;
    }





}
