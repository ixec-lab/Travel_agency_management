<?php
namespace AGENCE_VOYAGE\MODELS ;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;

class TransportModel{
    private $nom_cmp;
    private $type;


    function __construct($nom_cmp = null, $type = null){
        $this->nom_cmp = $nom_cmp;
        $this->type = $type;

    }
    

    public function insert(){
        $db = Database::init();
        $sql = "INSERT INTO TRANSPORT(NOM_COMPAGNIE,TYPE_T) VALUES (:nom,:type)";
        $qry = $db->prepare($sql);
        $qry->bindParam(":nom",$this->nom_cmp,\PDO::PARAM_STR);
        $qry->bindParam(":type",$this->type,\PDO::PARAM_STR);
        $qry->execute();
    }

    public function getLastIdTransport(){
        $db = DataBase::init();
        $sql = "SELECT ID_TRANSPORT FROM TRANSPORT ORDER BY ID_TRANSPORT DESC LIMIT 1";
        $qry = $db->prepare($sql);
        $qry->execute();

        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0){
            return $row->ID_TRANSPORT;
        }
    }

    public static function getAllTransports(){
        $db = Database::init();
        $sql = "SELECT * FROM TRANSPORT";
        $qry = $db->prepare($sql);
        $qry->execute();

        $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows;
        }
    }
}
?>