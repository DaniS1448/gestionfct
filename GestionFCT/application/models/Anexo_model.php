<?php

class Anexo_model extends CI_Model
{
    function getAnexos(){
        return R::findAll('anexo');
    }
    
    function getAnexosCursoActual(){
        return R::findAll('anexo','cursoacademico_id=?',[getCursoActual()->id]);
    }
    
    function getAnexosByUsuarioId($idUsuario){
        //$administra = R::findAll('administra','usuario_id=?',[$idUsuario]);
        //return $administra->aggr ( 'ownAnexoList', 'anexo' );
        
        $usuario = R::load('usuario', $idUsuario);
        return $usuario->aggr ( 'ownAdministraList', 'anexo' );
    }
}
?>
