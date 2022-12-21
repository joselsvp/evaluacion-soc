<?php
require_once 'models/Solicitud.php';

class UsuarioController{

    public function __construct(){
    }


    public function show(){
        $getRegisteredApplicants = (new Solicitud())->getRegisteredApplicants();
        require_once 'views/UsuariosTabla.php';
    }

}
