<?php

class Provincia_model extends CI_Model
{

    public function getProvincias(){
        return R::findAll('provincia');
    }
    
    function c($nombre,$idCCAA){       
        $ca = R::findOne('provincia','nombre=?',[$nombre]);
        $ok = ($ca==null && $nombre!=null);
        if ($ok) {
            $ccaa = R::load('comunidadautonoma', $idCCAA);
            $bean = R::dispense('provincia');
            $bean->nombre = $nombre;
            $bean->comunidadautonoma = $ccaa;
            R::store($bean);
        }
        else {
            $e = ($nombre==null?new Exception("nulo"):new Exception("Provincia duplicada"));
            throw $e;
        }
    }
}

?>
