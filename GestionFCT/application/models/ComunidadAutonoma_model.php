<?php

class ComunidadAutonoma_model extends CI_Model
{

    public function getComunidadesAutonomas(){
        return R::findAll('comunidadautonoma');
    }
    
    function c($nombre,$idPais){       
        $ca = R::findOne('comunidadautonoma','nombre=?',[$nombre]);
        $ok = ($ca==null && $nombre!=null);
        if ($ok) {
            $pais = R::load('pais', $idPais);
            $bean = R::dispense('comunidadautonoma');
            $bean->nombre = $nombre;
            $bean->pais = $pais;
            R::store($bean);
        }
        else {
            $e = ($nombre==null?new Exception("nulo"):new Exception("Comunidad autónoma duplicada"));
            throw $e;
        }
    }
}

?>
