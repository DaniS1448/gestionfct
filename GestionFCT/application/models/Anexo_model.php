<?php

class Anexo_model extends CI_Model
{
    function getAnexos(){
        return R::findAll('anexo');
    }
    
    function getAnexosCursoActual(){
        return R::findAll('anexo','cursoacademico_id=?',[getCursoActual()->id]);
    }
}
?>
