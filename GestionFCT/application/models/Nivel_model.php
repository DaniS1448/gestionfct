<?php

class Nivel_model extends CI_Model
{

    public function getInstitutos(){
        return R::findAll('nivel');
    }
    
    function c($nombre){       
        $ca = R::findOne('nivel','nombre=?',[$nombre]);
        $ok = ($ca==null && $nombre!=null);
        if ($ok) {
            $bean = R::dispense('nivel');
            $bean->nombre = $nombre;
            R::store($bean);
        }
        else {
            $e = ($nombre==null?new Exception("nulo"):new Exception("Nivel duplicado"));
            throw $e;
        }
    }
}

?>
