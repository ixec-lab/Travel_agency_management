<?php
namespace AGENCE_VOYAGE\MODELS ;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;

class BusModel{


    private $matricule_b;
    private $nbr_place;
    private $status_b;
    private $tarif_b;



    function __construct($matricule_b,$nbr_place,$tarif_b,$status_b = null){
        $this->matricule_b = $matricule_b;
        $this->nbr_place = $nbr_place;
        $this->status_b = $status_b;
        $this->tarif_b = $tarif_b;
    }


    public function insert($id_transport){
        $db = Database::init();
        $sql = "INSERT INTO BUS(MATRICULE_B,ID_TRANSPORT,NBR_PLACE,TARIF_B) VALUES (:matricule_b,:id_transport,:nbr_place,:tarif_b)";
        $qry = $db->prepare($sql);
        $qry->bindParam(":matricule_b",$this->matricule_b,\PDO::PARAM_STR);
        $qry->bindParam(":id_transport",$id_transport,\PDO::PARAM_INT);
        $qry->bindParam(":nbr_place",$this->nbr_place,\PDO::PARAM_INT);
        $qry->bindParam(":tarif_b",$this->tarif_b,\PDO::PARAM_STR); // float value
        $qry->execute();
    }

    // get all bus

    public static function getAllBus(){
        $db = Database::init();
        $sql = "SELECT * FROM BUS";
        $qry = $db->prepare($sql);
        $qry->execute();

        $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows;
        }
    }

    // last matricule by 
    public function getLastBus(){
        $db = Database::init();
        $sql = "SELECT ID_BUS FROM BUS ORDER BY ID_BUS DESC LIMIT 1";
        $qry = $db->prepare($sql);
        $qry->execute();

        $rows = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows->ID_BUS;
        }else{
            return 0;
        }
    }

}
?>