<?php

class Pais_model extends CI_Model
{

    public function getPaises(){
        return R::findAll('pais');
    }
    
    function c($nombre){       
        $ca = R::findOne('pais','nombre=?',[$nombre]);
        $ok = ($ca==null && $nombre!=null);
        if ($ok) {
            $bean = R::dispense('pais');
            $bean->nombre = $nombre;
            R::store($bean);
        }
        else {
            $e = ($nombre==null?new Exception("nulo"):new Exception("País duplicado"));
            throw $e;
        }
    }
}

?>
