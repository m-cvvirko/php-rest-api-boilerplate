<?php

class ConnectionDB {
   
      public static $instance;

      private const DB_HOST_NAME = 'localhost';
      private const DB_HOST_PORT_NO = ''; //
      private const DB_USER = "rootname"; //
      private const DB_PASS = "password"; //
      private const DB_CHARSET = 'utf8mb4'; //

      public const DB_NAME = 'dbname';

      private function __construct() {
          //
      }

      private static function makeConnectionURI() {
        $URI = "mysql:host=" . self::DB_HOST_NAME . self::DB_HOST_PORT_NO;
        $URI .= ";dbname=" . self::DB_NAME . ';charset=' . self::DB_CHARSET;
        return $URI; 
      }
    
      public static function getInstance() {
          if (!isset(self::$instance)) {
            $host = self::DB_HOST_NAME;
            $db = self::DB_NAME;
            $charset = 'utf8mb4';
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ORACLE_NULLS       => PDO::NULL_EMPTY_STRING,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
              self::$instance = new PDO(self::makeConnectionURI(), self::DB_USER, self::DB_PASS, $options);
            } catch (\PDOException $e) {
              throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
          }
          return self::$instance;
      }
    
  }

?>