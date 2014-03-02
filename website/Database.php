<?php
class Database{
    private static $user = "matrimony";
    private static $pass = "zenith@humber";
    private static $dsn = "mysql:host=my02.winhost.com;dbname=mysql_65818_matrimony";
    private static $db;
    public static function getDB(){
        if(!isset(self::$db)){
            try{    
            self::$db = new PDO(self::$dsn,self::$user,self::$pass);
            }
            catch(PDOException $e){
                echo "Error occured: " . $e->getMessage();
            }
        }
        return self::$db;
    }

}

?>
