<?php

class Asignar_model extends CI_Model
{
    function crearPractica($idAlumno,$idSede,$distancia,$duracion,$idUsuario,$idGrupo){
        $alumno = R::load('alumno', $idAlumno);
        $usuario = R::load('usuario', $idUsuario);
        $sede = R::load('sede', $idSede);
        $grupo = R::load('grupo', $idGrupo);
        $cursoAcademico = getCursoActual();
        $idCursoAcademico=$cursoAcademico->id;
        $anexo = R::findOne('anexo','cursoacademico_id=? AND sede_id=?',[$idCursoAcademico,$idSede]);
        
        if($anexo==null){
            $anexo = R::dispense('anexo');
            $anexo->numero = 0;
            $anexo->n_horas = 370;
            $anexo->fecha_comienzo = null;
            $anexo->fecha_fin = null;
            $anexo->horas_dia = 8;
            $anexo->sede = $sede;
            $anexo->cursoacademico = $cursoAcademico;
            R::store($anexo);
        }
        
        $administra = R::dispense('administra');
        $administra->usuario = $usuario;
        $administra->anexo = $anexo;
        R::store($administra);
        
        $practica = R::dispense('practica');
        $practica->contratado = false;
        $practica->distancia_trayecto = $distancia;
        $practica->duracion_trayecto = $duracion;
        $practica->anexo = $anexo;
        $practica->grupo = $grupo;
        $practica->alumno = $alumno;
        R::store($practica);
        
        $previsionPuestos = R::findOne('previsionpuestos','cursoacademico_id=? AND sede_id=?',[$idCursoAcademico,$idSede]);
        $previsionPuestos->numero = (int)$previsionPuestos->numero - 1;
        R::store($previsionPuestos);
    }
}
?>
