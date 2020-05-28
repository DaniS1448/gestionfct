<?php
function frame($controller,$view,$data=[]) {
    
    //Si recibe un título aparece ese en head -> <title>
    $data['titulo'] = isset($data['titulo']) ? $data['titulo'] . ' - ' : '';
    
    //Si no recibe modals, ce crea array vacío
    $data['modals'] = isset($data['modals']) ? $data['modals'] : [];
    
    //Aquí van los modals necesarios en todas las vistas
    $data['modals'][]='modalMsg';
    
    
    $controller->load->view('_templates/01-head',$data);
    $controller->load->view('_templates/02-nav',$data);
    $controller->load->view('_templates/03-header',$data);
    $controller->load->view($view,$data);
    $controller->load->view('_templates/04-modal',$data);
    $controller->load->view('_templates/05-footer',$data);
    $controller->load->view('_templates/06-end');
}
?>