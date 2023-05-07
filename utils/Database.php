<?php
namespace app\utils;
use mysqli;

abstract class Database {
    private static $host;
    private static $user;
    private static $pass;
    private static $db;
    private static $mysqli;

    // Adatbázis kapcsolat létrehozása
    private static function db_connect() {
        self::$host = 'localhost';
        self::$user = 'root';
        self::$pass = '';
        self::$db = 'project';
        self::$mysqli = new mysqli(self::$host, self::$user, self::$pass, self::$db);
      }
    // Adatbázisból való lekérdezés függvénye
      public static function query($sql) {
            self::db_connect();
            $result = self::$mysqli->query($sql);
            $responseData = array();
            while ($row = $result->fetch_assoc())
            {
                $responseData[] = $row;
            }
            return $responseData;
      }


}
?>