<?php

function autoload_controllers($classname){
    include 'controllers/' . $classname . '.php';
}

spl_autoload_register('autoload_controllers');