<?php

namespace util\config;

class Config {

    private static $instance;

    private $config;

    private function setConfig( $file ) {
        if ( isset($_SERVER['DOCUMENT_ROOT']) && !empty($_SERVER['DOCUMENT_ROOT']) ) {
            $config_file = $_SERVER['DOCUMENT_ROOT'] . '/config/' . $file . '.php';
        } else {
            $config_file = __DIR__ . '/../../config/' . $file . '.php';
        }

        if ( !file_exists($config_file) ) {
            echo "Configuracion inválida";
        }

        include $config_file;

        $this->config = $config_values;
    }

    public static function get( $key, $file = "sys_config" ) {
        if ( !isset(self::$instance) ) {
            self::$instance = new Config();
        }

        self::$instance->setConfig($file);

        if ( !isset(self::$instance->config[$key]) ) {
            echo sprintf('El valor del archivo de configuracion de sistema: [%s] no existe', $key);

        }

        return self::$instance->config[$key];
    }
}