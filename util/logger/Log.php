<?php
if ( isset($_SERVER['DOCUMENT_ROOT']) && !empty($_SERVER['DOCUMENT_ROOT']) ) {
    define("PATH_LOGS",  $_SERVER['DOCUMENT_ROOT'] . '/util/logger/logs');
} else {
    define("PATH_LOGS", __DIR__ . '\logs');
}
# Crear carpeta si no existe
if (!file_exists(PATH_LOGS)) {
    mkdir(PATH_LOGS);
}

date_default_timezone_set("America/Mexico_City");

ini_set('display_errors', 0);
ini_set("log_errors", 1);
ini_set("error_log", PATH_LOGS . "/" . date("Y-m-d") . ".log");

