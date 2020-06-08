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
            $ca = R::dispense('pais');
            $ca->anyoini = $anyoini;
            R::store($ca);
        }
        else {
            $e = ($anyoini==null?new Exception("nulo"):new Exception("Curso académico duplicado"));
            throw $e;
        }
    }
}

?>
