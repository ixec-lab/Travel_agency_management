<?php
namespace AGENCE_VOYAGE\MODELS ;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;

class AvoirModel{
    private $id_transport;
    private $id_service;

    function __construct($id_transport,$id_service){
        $this->id_transport = $id_transport;
        $this->id_service = $id_service;
    }

    public function addLink(){
        $db = Database::init();
        $sql = "INSERT INTO AVOIR(ID_SERVICE,ID_TRANSPORT) VALUES (:id_service,:id_transport)";
        $qry = $db->prepare($sql);
        $qry->bindParam(':id_service',$this->id_service,\PDO::PARAM_INT);
        $qry->bindParam(':id_transport',$this->id_transport,\PDO::PARAM_INT);
        $qry->execute();
    }

    public static function getTransportInService($id_service){
        $db = DataBase::init();
        $sql = "select NOM_COMPAGNIE from AVOIR a, TRANSPORT t where a.ID_SERVICE=:id_service AND a.ID_TRANSPORT = t.ID_TRANSPORT";
        $qry = $db->prepare($sql);
        $qry->bindParam(':id_service',$id_service,\PDO::PARAM_INT);
        $qry->execute();

        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0){
            return $row->NOM_COMPAGNIE;
        }
    }

    public static function getTypeTransportInService($id_service){
        $db = DataBase::init();
        $sql = "select TYPE_T from AVOIR a, TRANSPORT t where a.ID_SERVICE=:id_service AND a.ID_TRANSPORT = t.ID_TRANSPORT";
        $qry = $db->prepare($sql);
        $qry->bindParam(':id_service',$id_service,\PDO::PARAM_INT);
        $qry->execute();

        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0){
            return $row->TYPE_T;
        }
    }

    public static function delLink($id_service){
        $db = DataBase::init();
        $sql = "DELETE FROM AVOIR WHERE ID_SERVICE = :id";
        $qry = $db->prepare($sql);
        $qry->bindParam(':id',$id_service,\PDO::PARAM_INT);    
        $qry->execute();   
    }
}
?>