<?php

class ProvisionPuestos_model extends CI_Model
{

    public function getPrevisionPuestos(){
        return R::findAll('previsionpuestos');
    }
    
    function c($numero,$idSede,$anyoini){
        $curso = R::findOne('cursoacademico','anyoini=?',[$anyoini]);
        $prevision = R::findOne('provisionpuestos','sede_id=? AND cursoacademico_id=?',[$idSede,$curso->id]);
        $ok = ($prevision==null && $numero!=null && $idSede!=null && $curso!=null);
        if ($ok) {
            $sede = R::load('sede', $idSede);
            if($sede!=null){
                $prevision = R::dispense('provisionpuestos');
                $prevision->numero = $numero;
                $prevision->sede = $sede;
                $prevision->cursoacademico = $curso;
                R::store($prevision);
            }
            
        }
        else {
            $e = ($numero==null?new Exception("nulo"):new Exception("Ya existe una provisión de puestos para esta sede este curso"));
            throw $e;
        }
    }
    
    function u($numero,$idSede,$anyoini){
        $curso = R::findOne('cursoacademico','anyoini=?',[$anyoini]);
        $prevision = R::findOne('provisionpuestos','sede_id=? AND cursoacademico_id=?',[$idSede,$curso->id]);
        $ok = ($prevision!=null && $numero!=null && $idSede!=null && $curso!=null);
        if ($ok) {
            $sede = R::load('sede', $idSede);
            if($sede!=null){
                $prevision->numero = $numero;
                R::store($prevision);
            }
            
        }
        else {
            $e = ($numero==null?new Exception("nulo"):new Exception("No existe una provisión de puestos para esta sede este curso"));
            throw $e;
        }
    }
    
    function getProvisionPuestosBySedeId($idSede){
        return R::findOne('provisionpuestos','sede_id=? AND cursoacademico_id=?',[$idSede,getCursoActual()->id]);
    }
}

?>
