<?php
require_once 'autoload.php';
require_once 'util/config/Config.php';
require_once 'config/parameters.php';
require_once 'database/Connection.php';
require_once 'util/logger/Log.php';


$nombreControlador = '';

if(!isset($_GET['controller']) || !isset($_GET['action'])){
    $nombreControlador = controller_default;
    $action = action_default;
    (new $nombreControlador())->$action();
}else{
    if(isset($_GET['controller'])){
        $nombreControlador = $_GET['controller'] . 'Controller';
    }else{
        echo "La pagina que buscas no existe";
        exit();
    }

    if(class_exists($nombreControlador)){
        $controlador = new $nombreControlador();

        if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
            $action = $_GET['action'];
            $controlador->$action();
        }else{
            echo "La página que buscas no existe";
        }
    }else{
        echo "La página que buscas no existe";
    }

}

