<?php

class Grupo_model extends CI_Model
{

    public function getGrupos(){
        return R::findAll('grupo');
    }
    
    function c($nombre,$idTitulacion,$idInstituto,$anyoini){    
        $curso = R::findOne('cursoacademico','anyoini=?',[$anyoini]);
//         if($curso == null){
//             $curso = R::dispense("cursoacademico");
//             $curso->id= "0";
//         }
        $ca = R::findOne('grupo','nombre=? AND cursoacademico_id=? AND instituto_id=?',[$nombre,$curso->id,$idInstituto]);
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
    
    function getGruposByInstitutoId($idInstituto,$anyoini){
        //return R::find('grupo',' instituto_id LIKE :instituto_id ',[':instituto_id' => '%' . $idInstituto . '%']);
        //return R::find('grupo',' instituto_id=:instituto_id ',[':instituto_id'=>$idInstituto]);
        $cursoActual = R::findOne('cursoacademico','anyoini=?',[$anyoini]);
        return R::find('grupo',' instituto_id=? AND cursoacademico_id=?',[$idInstituto,$cursoActual->id]);
    }
}

?>
