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

function getCursoActual()
{
    return R::findOne('cursoacademico','anyoini=?',[getAnyoIni()]);
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

function esAjax(){
    $esAjax = isset(
        $_SERVER['HTTP_X_REQUESTED_WITH'])?
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' :
        false;
        if (!$esAjax) {
            echo "SOLO EJECUCIONES AJAX";
        }
    return $esAjax;
}

function getApiMaps(){
    $cuenta = R::findOne('dato','identificador=?',["apimaps"]);
    return $cuenta->campo1;
}

function devolverSedeMasCercana($controlador,$origen,$mode){
    //EMPRESAS
    $controlador->load->model('empresa_model');
    $empresas = $controlador->empresa_model->getEmpresasDesbloqueadas();
    $destinos="";
    $idsSedesOrden=[];
    foreach ($empresas as $empresa){
        foreach ($empresa->ownSedeList as $sede){
            foreach ($sede->ownProvisionpuestosList as $pp){
                if($pp->cursoacademico->anyoini == getAnyoIni() && (int)$pp->numero > 0 ){
                    $destinos.=$sede->latitud.",".$sede->longitud."|";
                    $idsSedesOrden[]=$sede->id;
                }
            }
        }
        
    }
    $destinos = rtrim($destinos, '|');
    
    $key = getApiMaps();
    $url="https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=$origen&destinations=$destinos&avoid=tolls&language=es-ES&mode=$mode&key=$key";
    $ch = curl_init(); curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); curl_setopt($ch, CURLOPT_URL,$url); $result=curl_exec($ch); curl_close($ch);
    $resultado = json_decode($result, true);
    
    if(isset($resultado['status']) && $resultado['status'] == 'OK'){
        $clave=""; $distanceValue=0; $distancia="";$duracion="";
        
        foreach ($resultado['rows'][0]['elements'] as $k=>$v){
            $distanceValueSede = $v['distance']['value'];
            /*
            if($mode=="driving"){$distanceValueSede = $v['distance']['value'];}
            else{$distanceValueSede = $v['duration']['value'];}
            */
            
            if($distanceValue==0){
                $clave=$k;
                $distanceValue=$distanceValueSede;
                $distancia=$v['distance']['text'];
                $duracion = $v['duration']['text'];
            } else {
                if($v['distance']['value'] < $distanceValue){
                    $clave=$k;
                    $distanceValue=$distanceValueSede;
                    $distancia=$v['distance']['text'];
                    $duracion = $v['duration']['text'];
                }
            }
        }
        $resultadoReturn = ['idSede' => $idsSedesOrden[$clave], 'distancia'=>$distancia, 'duracion'=>$duracion];
    } else {
        $resultadoReturn = ['idSede' => null];
    }
    return $resultadoReturn;
}

?>