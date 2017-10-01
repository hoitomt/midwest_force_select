<?php

class Database {
  private static $dbName = 'hoitomts_midwest_force_select' ;
  private static $dbHost = 'localhost' ;
  private static $dbUsername = 'hoitomts_mfs';
  private static $dbUserPassword = 'hbtD3QN7gUBffBmx';

  private static $cont  = null;

  public function __construct() {
    die('Init function is not allowed');
  }

  public static function connect() {
    // One connection through whole application
    if ( null == self::$cont ){
      try {
        self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
      } catch(PDOException $e) {
        die($e->getMessage());
      }
    }
    return self::$cont;
  }

  public static function disconnect() {
    self::$cont = null;
  }
}

?>
