<?php
/**
 * Created by PhpStorm.
 * User: f
 * Date: 2018-06-12
 * Time: 5:33 AM
 */

namespace BerkaPhp\Database;

class DB {

    private static $driver;
    private static $dbInstance;
    private static $instance = null;
    private static $drivers = ['mysqli','pdo'];

    private function __construct() {

    }

    public static  function Driver($driver = null){

        $driver = strtolower($driver);

        if($driver != null && in_array($driver, self::$drivers)){
            $key = array_search($driver, self::$drivers);
            self::$driver = self::$drivers[$key];
        }
        else
            return null;

        if(self::$instance == null)
            self::$instance = new DB();

        return  self::$instance;

    }

    public function Setup($server, $databaseName, $userName, $password)
    {
        if(self::$dbInstance == null) {
            try {
                switch (self::$driver) {
                    case 'mysqli':
                        self::$dbInstance = new MySqliDatabase($server, $userName, $password, $databaseName);
                        break;
                    case 'pdo':
                        self::$dbInstance = new PdoDatabase($server, $userName, $password, $databaseName);
                        break;
                }
            } catch (\Exception $e) {

            }

        }

    }

    public static function GetDbInstance(){
        if(self::$dbInstance != null)
            return self::$dbInstance;
        else
            return null;
    }

    public static function IsConnected(){
        return self::$dbInstance != null ? true : false;
    }




}
?>