<?php
namespace AGENCE_VOYAGE\MODELS ;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;

class ActualiteModel{
    private $actualite;

    function __construct($act){
        $this->actualite = $act;
    }

    public function insert(){
        $db = Database::init();
        $sql = "INSERT INTO ACTUALITE(TXT) VALUES (:act)";
        $qry = $db->prepare($sql);
        $qry->bindParam(':act',$this->actualite,\PDO::PARAM_STR);
        $qry->execute();
    }

    public static function getActulaite(){
        $db = Database::init();
        $sql = "SELECT * FROM ACTUALITE";
        $qry = $db->prepare($sql);
        $qry->execute();
        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0){
            return $row;
        }
    }
}