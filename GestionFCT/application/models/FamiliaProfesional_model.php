<?php

class FamiliaProfesional_model extends CI_Model
{

    public function getFamiliasProfesionales(){
        return R::findAll('familiaprofesional');
    }
    
    function c($nombre){       
        $ca = R::findOne('familiaprofesional','nombre=?',[$nombre]);
        $ok = ($ca==null && $nombre!=null);
        if ($ok) {
            $bean = R::dispense('familiaprofesional');
            $bean->nombre = $nombre;
            R::store($bean);
        }
        else {
            $e = ($nombre==null?new Exception("nulo"):new Exception("Familia profesional duplicada"));
            throw $e;
        }
    }
}

?>
