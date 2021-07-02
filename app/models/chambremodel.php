<?php
namespace AGENCE_VOYAGE\MODELS ;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;

class ChambreModel{

    private $type_c;
    private $tarif_ch;

    function __construct($type_c,$tarif_ch){
        $this->type_c = $type_c;
        $this->tarif_ch = $tarif_ch;

    }

    public function insert($id_hotel){
        $db = Database::init();
        $sql = "INSERT INTO CHAMBRE(ID_H,TYPE_C,TARIF_CHBR) VALUES (:id_h,:type_c,:tarif_ch)";
        $qry = $db->prepare($sql);
        $qry->bindParam(":id_h",$id_hotel,\PDO::PARAM_INT);
        $qry->bindParam(":type_c",$this->type_c,\PDO::PARAM_STR);
        $qry->bindParam(":tarif_ch",$this->tarif_ch,\PDO::PARAM_STR);

        $qry->execute();
    }

    // get all chambre

    public static function getAllChambre(){
        $db = Database::init();
        $sql = "SELECT * FROM CHAMBRE";
        $qry = $db->prepare($sql);
        $qry->execute();

        $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows;
        }
    }

    public static function getNbrChambreOccupe($id_hotel){
        $db = Database::init();
        $sql = "SELECT COUNT(NUM_CHBR) as total FROM CHAMBRE WHERE ID_H = :id_hotel" ;
        $qry = $db->prepare($sql);
        $qry->bindParam(":id_hotel",$id_hotel,\PDO::PARAM_INT);
        $qry->execute();

        $rows = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows->total;
        }else 
            return 0;
    }

    public static function getTypeChambreInHotel($id_hotel){
        $db = Database::init();
        $sql = "SELECT TYPE_C FROM CHAMBRE WHERE ID_H = :id_hotel" ;
        $qry = $db->prepare($sql);
        $qry->bindParam(":id_hotel",$id_hotel,\PDO::PARAM_INT);
        $qry->execute();

        $rows = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows->TYPE_C;
        }
    }

}
?>