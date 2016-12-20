<?php
include_once 'DBHelper.php';

/**
 * Created by PhpStorm.
 * User: edbertvoo
 * Date: 2016-11-01
 * Time: 10:28 AM
 */
class BusinessHelper
{
    private static $pdo = null;
    private static $objList;

    /**
     * Create a pdo for use will create a new one if one does not exist
     * @return PDO created
     */
    public static function getConnection()
    {

        if (self::$pdo == null) {

            define("USER", "edbertv");
            define("PASS", "");
            define("CONNSTRING", "mysql:host=".getenv('IP').":3306;dbname=art");

            self::$pdo = DBHelper::createConnection(CONNSTRING, USER, PASS);


        }

        return self::$pdo;
    }


    /**
     * Close the pdo for this static object only
     */
    public static function closeConnection()
    {
        self::$pdo = null;
    }

    /**
     * Keep track of the objects created for easy pdo management
     * @param $object that was created
     * @return $object that was passed in
     */
    public static function createObject($object = null)
    {
        self::$objList[] = $object;
        return $object;
    }


    /**
     * Close the pdo for all of the classes
     */
    public static function closeAllConnection()
    {
        foreach (self::$objList as $obj) {
            if ($obj != null) {
                $obj->closeConnection();
            }
        }
        self::$pdo = null;
        self::$objList=null;
    }

}