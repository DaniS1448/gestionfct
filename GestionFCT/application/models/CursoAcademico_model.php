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
        $ca = R::dispense("cursoacademico");
        $ca->anyoini = $anyoini;
        R::store($ca);
    }
}

?>
