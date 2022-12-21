<?php
namespace database;
use util\config\Config;

class Connection{
    private static $connection = array();

    public static function getConnection( $connectionKey = 'default' ) {
        if ( !self::connectionWasInitialized($connectionKey) ) {
            $configuration = Config::get($connectionKey, 'database_config');

            if ( !empty($configuration) ) {
                $host = $configuration['host'];
                $user = $configuration['user'];
                $password = $configuration['password'];

                $connection = new \PDO($host, $user, $password, array(\PDO::ATTR_PERSISTENT => false));

                $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

                self::$connection[$connectionKey] = $connection;
            }
        }

        return self::$connection[$connectionKey];
    }

    private static function connectionWasInitialized( $connectionKey ) {
        if ( array_key_exists($connectionKey, self::$connection) && isset(self::$connection[$connectionKey]) ) {
            return true;
        }
        return false;
    }
}