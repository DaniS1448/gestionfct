<?php

class Grupo_model extends CI_Model
{

    public function getGrupos(){
        return R::findAll('grupo');
    }
    
    function c($nombre,$idTitulacion,$idInstituto,$anyoini){       
        $ca = R::findOne('grupo','nombre=?',[$nombre]);
        $ok = ($ca==null && $nombre!=null);
        if ($ok) {
            $titulacion = R::load('titulacion', $idTitulacion);
            $curso = R::findOne('cursoacademico','anyoini=?',[$anyoini]);
            $instituto = R::load('instituto', $idInstituto);
            if($titulacion!=null && $curso!=null && $instituto!=null){
                $grupo = R::dispense('grupo');
                $grupo->nombre = $nombre;
                $grupo->titulacion = $titulacion;
                $grupo->cursoacademico = $curso;
                $grupo->instituto = $instituto;
                R::store($grupo);
            }
            
        }
        else {
            $e = ($nombre==null?new Exception("nulo"):new Exception("Grupo duplicado"));
            throw $e;
        }
    }
}

?>
