<?php

class CursoAcademico_model extends CI_Model
{
    function ini(){
        $ca = R::dispense("cursoacademico");
        $ca->anyoini = "2019";
        R::store($ca);
    }
    
    public function getCursosAcademicos(){
        return R::findAll('cursoacademico');
    }
    
    function c($anyoini){       
        $ca = R::findOne('cursoacademico','anyoini=?',[$anyoini]);
        $ok = ($ca==null && $anyoini!=null);
        if ($ok) {
            $ca = R::dispense('cursoacademico');
            $ca->anyoini = $anyoini;
            R::store($ca);
        }
        else {
            $e = ($anyoini==null?new Exception("nulo"):new Exception("Curso académico duplicado"));
            throw $e;
        }
    }
    
    function cAnterior($anyoini,$idCursoAnterior){
        $ca = R::findOne('cursoacademico','anyoini=?',[$anyoini]);
        $ok = ($ca==null && $anyoini!=null);
        if ($ok) {
            $cant = R::load('cursoacademico',$idCursoAnterior);
            if($cant!=null){
                $ca = R::dispense('cursoacademico');
                $ca->anyoini = $anyoini;
                R::store($ca);
                
                $grupos = R::find('grupo','cursoacademico_id=?',[$cant->id]);
                foreach ($grupos as $cadaGrupo){
                    $grupo = R::dispense('grupo');
                    $grupo->nombre = $cadaGrupo->nombre;
                    $grupo->titulacion = $cadaGrupo->titulacion;
                    $grupo->cursoacademico = $ca;
                    $grupo->instituto = $cadaGrupo->instituto;
                    R::store($grupo);
                    
                    $impartes = R::find('imparte','grupo_id=?',[$cadaGrupo->id]);
                    foreach ($impartes as $cadaImparte){
                        $imparte = R::dispense('imparte');
                        $imparte->usuario = $cadaImparte->usuario;
                        $imparte->grupo = $grupo;
                        R::store($imparte);
                    }

                }
                
                
            } else {
                throw new Exception("Curso anterior no existe");
            }
        }
        else {
            $e = ($anyoini==null?new Exception("nulo"):new Exception("Curso académico duplicado"));
            throw $e;
        }
    }
}

?>
