<?php

use database\Connection;

require_once 'models/Municipio.php';


class MunicipioController{

    public function __construct(){
    }

    public function find(){
        error_log(print_r($_POST, true));

        if(isset($_POST['id_estado'])){
            $findMunicipio = (new Municipio())->findMunicipiosByIdEstado($_POST['id_estado']);
            error_log(print_r($findMunicipio, true));
            echo json_encode($findMunicipio);
        }

    }

}
