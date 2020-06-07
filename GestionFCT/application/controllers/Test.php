<?php
class Test extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        verificarLogin();
    }
    
    public function index() {
        echo "ok";
    }
    
    public function testRol(){
        verificarRol();
        echo "ok";
    }
    
    public function devolverRol(){
        echo devolverRol();
    }
}
?>