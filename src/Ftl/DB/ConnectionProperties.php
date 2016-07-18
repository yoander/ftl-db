<?php

namespace Ftl\DB;

/**
 * This class describes the connection properties, is posible to have more than
 * one driver configuration and more than one connection per driver.
 */
class ConnectionProperties
{
    private static function _properties($connections, $connectionName = null)
    {
		if (empty($connectionName)) { // Default connection
			return reset($connections);
		} elseif (array_key_exists($connectionName, $connections)) { // Named connection
			return $connections[$connectionName];
		} else { // Empty properties
			return [];
        }
    }

    /**
     * Returns sqlite connection details. This function must be overwritten by
     * a child class.
     *
     * @return [
     * 		'connection_name' => [
     * 	 		'db_file'        => 'Path to sqlite.db',
     * 	 		'create_dbfile'  => true|false,
     * 	 		'attributes'     => [
     * 	 			DriverOptions::ERRMODE => DriverOptions::ERRMODE_EXCEPTION
     * 	 		]
     *  	],
     *  	'other_connection' => []
     * ]
     */
    public static function sqlite()
    {
        return [];
    }

    /**
     * Returns a mysql connection details. This function must be owerwritten by
     * a child class.
     *
     * @return [
     * 		'connection_name' => [
     * 	 		'host'     => 'localhost',
     * 	 		'port'     => '3306',
     * 	 		'user'     => 'root',
     * 	 		'password' => 'root',
     * 	 		'database' => 'mydb',
     * 	 		'persistence' =>  true|false,
     * 	 		'attributes'     => [
     * 	 			DriverOptions::ERRMODE => DriverOptions::ERRMODE_EXCEPTION
     * 	 		]
     *  	]
     * ]
     */
    public static function mysql()
    {
        return [];
    }

    private static function _sqlite($connectionName = null)
    {
        return self::_property(self::sqlite(), $connectionName);
    }

    private static function _mysql($connectionName = null)
    {
        return self::property(self::mysql(), $connectionName);
    }

    public function get($driver, $connectionName = null)
    {
        switch ($driver) {
            case DriverOptions::MYSQLDRV:
                return self::_mysql($connectionName);
            case DriverOptions::SQLITEDRV;
                return self::_sqlite($connectionName);
            default:
                return [];
        }
    }
}
