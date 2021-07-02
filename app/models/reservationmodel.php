<?php
namespace AGENCE_VOYAGE\MODELS ;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;

class ReservationModel{

    private $id_client;
    private $id_service;
    private $id_facture;
    private $date_res;

    function __construct($id_client,$id_service,$id_facture,$date_res){
        $this->id_client = $id_client;
        $this->id_service = $id_service;
        $this->id_facture = $id_facture;
        $this->date_res = $date_res;
    }

    public function addReservation(){
        $date_res = date("Y-m-d", strtotime($this->date_res));
        $db= DataBase::init();
        $sql= "INSERT INTO RESERVER(ID_C,ID_SERVICE,NUM_FACTURE,DATE_RES) VALUES (:id_c,:id_service,:id_facture,:date_res)";
        $qry = $db->prepare($sql);
        $qry->bindParam(":id_c",$this->id_client,\PDO::PARAM_INT);
        $qry->bindParam(":id_service",$this->id_service,\PDO::PARAM_INT);
        $qry->bindParam(":id_facture",$this->id_facture,\PDO::PARAM_INT);
        $qry->bindParam(":date_res",$date_res,\PDO::PARAM_STR);
        $qry->execute();
    }

    public static function getReservationByClient($id_client){
        $db = DataBase::init();
        $sql = "SELECT * FROM RESERVER WHERE ID_C = :id_client";
        $qry = $db->prepare($sql);
        $qry->bindParam(":id_client",$id_client,\PDO::PARAM_INT);
        $qry->execute();

        $rows = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows;
        }
    }

    public static function getReservedHotelByClient($id_client){
        $db = DataBase::init();
        $sql = "select * from RESERVER r , PROPOSER p , HOTEL h WHERE r.ID_C = :id_client AND r.ID_SERVICE = p.ID_SERVICE AND p.ID_H = h.ID_H;";
        $qry = $db->prepare($sql);
        $qry->bindParam(":id_client",$id_client,\PDO::PARAM_INT);
        $qry->execute();
        $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows;
        }
    }

    public static function getReservedBusByClient($id_client){
        $db = DataBase::init();
        $sql = "select * from RESERVER r, AVOIR a, TRANSPORT t , BUS b, CONDUIRE c , CHAUFFEUR ch where ID_C = :id_client AND r.ID_SERVICE = a.ID_SERVICE AND a.ID_TRANSPORT = t.ID_TRANSPORT AND t.ID_TRANSPORT = b.ID_TRANSPORT AND b.ID_BUS = c.ID_BUS AND c.ID_CHAUF = ch.ID_CHAUF";
        $qry = $db->prepare($sql);
        $qry->bindParam(':id_client',$id_client,\PDO::PARAM_INT);
        $qry->execute();
        $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows;
        }
    }

    public static function getReservedVolByClient($id_client){
        $db = DataBase::init();
        $sql = "select * from RESERVER r, AVOIR a, TRANSPORT t , VOL v where r.ID_C = :id_client AND r.ID_SERVICE = a.ID_SERVICE AND a.ID_TRANSPORT = t.ID_TRANSPORT AND t.ID_TRANSPORT = v.ID_TRANSPORT";
        $qry = $db->prepare($sql);
        $qry->bindParam(':id_client',$id_client,\PDO::PARAM_INT);
        $qry->execute();
        $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows;
        }
    }

    public static function getResevationCount($id_service){
        $db = Database::init();
        $sql = "select COUNT(r.ID_SERVICE) as total from  SERVICE s ,RESERVER r  where s.ID_SERVICE = r.ID_SERVICE AND  r.ID_SERVICE = :id_service";
        $qry = $db->prepare($sql);
        $qry->bindParam(':id_service',$id_service,\PDO::PARAM_INT);
        $qry->execute();

        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0){
            return $row->total;
        }
    }
}