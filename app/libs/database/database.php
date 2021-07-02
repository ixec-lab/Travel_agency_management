<?php
namespace AGENCE_VOYAGE\LIBS\DATABASE;

class Database{
    const USERNAME = "ixec";
    const PASSWORD = "islem123";
    const HOST = "127.0.0.1";
    const DRIVER = "mysql";
    const DBNAME = "agence_voyage";
    
    public static function init(){
        try{
             $db = new \PDO(self::DRIVER.":host=".self::HOST.";dbname=".self::DBNAME,self::USERNAME,self::PASSWORD);
            /* ONLY on DEV mod*/
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $db;
        }catch(\PDOException $e){
            $e->getMessage();
        }
    }
}
?>