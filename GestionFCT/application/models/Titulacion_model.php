<?php

class Titulacion_model extends CI_Model
{

    public function getTitulaciones(){
        return R::findAll('titulacion');
    }
    
    public function getTitulacionesByFamiliaProfesional($idFamiliaProfesional){
        return R::find('titulacion','familiaprofesional_id = ?', [$idFamiliaProfesional]);
    }
    
    function c($nombre,$idNivel,$idFamiliaProfesional){       
        $ca = R::findOne('titulacion','nombre=?',[$nombre]);
        $ok = ($ca==null && $nombre!=null);
        if ($ok) {
            $nivel = R::load('nivel', $idNivel);
            $fam = R::load('familiaprofesional', $idFamiliaProfesional);
            $titulacion = R::dispense('titulacion');
            $titulacion->nombre = $nombre;
            $titulacion->nivel = $nivel;
            $titulacion->familiaprofesional = $fam;
            R::store($titulacion);
        }
        else {
            $e = ($nombre==null?new Exception("nulo"):new Exception("Titulación duplicada"));
            throw $e;
        }
    }
}

?>
