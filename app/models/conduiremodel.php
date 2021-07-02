<?php
namespace AGENCE_VOYAGE\MODELS ;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;

class ConduireModel{

    private $id_bus;
    private $id_chauffeur;

    function __construct($id_bus,$id_chauffeur){
        $this->id_bus = $id_bus;
        $this->id_chauffeur = $id_chauffeur;
    }


    public function addLink(){
        $db = Database::init();
        $sql = "INSERT INTO CONDUIRE(ID_BUS,ID_CHAUF) VALUES (:id_bus, :id_chauffeur)";
        $qry = $db->prepare($sql);
        $qry->bindParam(":id_bus",$this->id_bus,\PDO::PARAM_INT);
        $qry->bindParam(":id_chauffeur",$this->id_chauffeur,\PDO::PARAM_INT);
        $qry->execute();
    }
}