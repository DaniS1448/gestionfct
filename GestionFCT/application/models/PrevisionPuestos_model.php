<?php

class PrevisionPuestos_model extends CI_Model
{

    public function getPrevisionPuestos(){
        return R::findAll('previsionpuestos');
    }
    
    function c($numero,$idSede,$anyoini){
        $curso = R::findOne('cursoacademico','anyoini=?',[$anyoini]);
        $ok = ($numero!=null && $idSede!=null && $curso!=null);
        if ($ok) {
            $sede = R::load('sede', $idSede);
            if($sede!=null){
                $prevision = R::dispense('previsionpuestos');
                $prevision->numero = $numero;
                $prevision->sede = $sede;
                $prevision->cursoacademico = $curso;
                R::store($prevision);
            }
            
        }
        else {
            $e = ($numero==null?new Exception("nulo"):new Exception("ERROR"));
            throw $e;
        }
    }
}

?>
