<?php

class Instituto_model extends CI_Model
{

    public function getInstitutos(){
        return R::findAll('instituto');
    }
    
    function c($nombre){       
        $ca = R::findOne('instituto','nombre=?',[$nombre]);
        $ok = ($ca==null && $nombre!=null);
        if ($ok) {
            $instituto = R::dispense('instituto');
            $instituto->nombre = $nombre;
            R::store($instituto);
        }
        else {
            $e = ($nombre==null?new Exception("nulo"):new Exception("Instituto duplicado"));
            throw $e;
        }
    }
}

?>
