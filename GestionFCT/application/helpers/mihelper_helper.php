<?php

function session_start_seguro() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

function verificarLogin(){
    session_start_seguro();
    if(!isset($_SESSION['user'])){
        redirect(base_url());
        //redirect(base_url().'home/index');
        //header('Location: '.base_url().'home/login');
    }
}

function verificarRol($rol="auth"){
    session_start_seguro();
    $resultado = true;
    
    if(!isset($_SESSION['user'])){
        redirect(base_url());
        $resultado = false;
    } else {
        if($rol == "admin" && !($_SESSION['user']->esAdmin)){
            redirect(base_url());
            $resultado = false;
        }
    }
    
    return $resultado;
}

function devolverRol(){
    session_start_seguro();
    $rol = "anon";
    
    if(isset($_SESSION['user'])){
        $rol = "auth";
        if($_SESSION['user']->esAdmin){
            $rol = "admin";
        }
    }
    
    return $rol;
}

/**
 * Calcula el año inicial del curso actual
 * @return number|string el año inicial del curos actual
 */
function getAnyoIni()
{
    return date('m') < 7 ? date('Y') - 1 : date('Y');
}

function crearModalAviso($tipo="warning", $mensaje="No hay mensajes", $volver=""){
    echo "<script src=\"".base_url()."assets/js/principal.js\"></script>\n";
    $titulo = "";
    $modals=['modalErrores'];
    $scripts=['principal'];
    require_once APPPATH.'views\_templates\01-head.php';
    require_once APPPATH.'views\_templates\04-modal.php';
    require_once APPPATH.'views\_templates\06-end.php';
    echo "<script>mostrarModalError('$tipo','$mensaje','$volver')</script>";
}

?>