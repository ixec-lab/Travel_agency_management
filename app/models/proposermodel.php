<?php
namespace AGENCE_VOYAGE\MODELS ;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;

class ProposerModel{
    private $id_hotel;
    private $id_service;

    function __construct($id_hotel,$id_service){
        $this->id_hotel = $id_hotel;
        $this->id_service = $id_service;
    }

    public function addLink(){
        $db = Database::init();
        $sql = "INSERT INTO PROPOSER(ID_SERVICE,ID_H) VALUES (:id_service,:id_hotel)";
        $qry = $db->prepare($sql);
        $qry->bindParam(':id_service',$this->id_service,\PDO::PARAM_INT);
        $qry->bindParam(':id_hotel',$this->id_hotel,\PDO::PARAM_INT);
        $qry->execute();
    }

    public static function getHotelInService($id_service){
        $db = DataBase::init();
        $sql = "select NOMH from PROPOSER p, HOTEL h where p.ID_SERVICE=:id_service AND h.ID_H = p.ID_H";
        $qry = $db->prepare($sql);
        $qry->bindParam(':id_service',$id_service,\PDO::PARAM_INT);
        $qry->execute();

        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0){
            return $row->NOMH;
        }
    }

    public static function getIdHotelInService($id_service){
        $db = DataBase::init();
        $sql = "select ID_H from PROPOSER where ID_SERVICE=:id_service";
        $qry = $db->prepare($sql);
        $qry->bindParam(':id_service',$id_service,\PDO::PARAM_INT);
        $qry->execute();

        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0){
            return $row->ID_H;
        }else{
            return 0;
        }
    }

    public static function delLink($id_service){
        $db = DataBase::init();
        $sql = "DELETE FROM PROPOSER WHERE ID_SERVICE = :id";
        $qry = $db->prepare($sql);
        $qry->bindParam(':id',$id_service,\PDO::PARAM_INT);    
        $qry->execute();   
    }
}
?>