<?php
namespace AGENCE_VOYAGE\MODELS ;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;

class ChauffeurModel{

    private $nom;
    private $prenom;
    private $tel_ch;
    private $status_ch;

    function __construct($tel_ch,$nom,$prenom){
        $this->tel_ch = $tel_ch;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }


    public function insert(){
        $db = Database::init();
        $sql = "INSERT INTO CHAUFFEUR (TEL_CH,NOM,PRENOM) VALUES (:tel_ch,:nom,:prenom)";
        $qry = $db->prepare($sql);
        $qry->bindParam(":tel_ch",$this->tel_ch,\PDO::PARAM_STR);
        $qry->bindParam(":nom",$this->nom,\PDO::PARAM_STR);
        $qry->bindParam(":prenom",$this->prenom,\PDO::PARAM_STR);
        $qry->execute();
    }

    // get all chauffeur

    public static function getAllChauffeur(){
        $db = Database::init();
        $sql = "SELECT * FROM CHAUFFEUR ORDER BY NOM ASC";
        $qry = $db->prepare($sql);
        $qry->execute();

        $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows;
        }
    }
    // get last chauffeur
    public static function getLastChauffeur(){
        $db = Database::init();
        $sql = "SELECT ID_CHAUF FROM CHAUFFEUR ORDER BY ID_CHAUF DESC LIMIT 1";
        $qry = $db->prepare($sql);
        $qry->execute();

        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0){
            return $row->ID_CHAUF;
        }
    }

    private static function getStatusChauffeur($id_chauf){
        $db = Database::init();
        $sql = "SELECT STATUS_CH FROM CHAUFFEUR WHERE ID_CHAUF = :id_chauf" ;
        $qry = $db->prepare($sql);
        $qry->bindParam(":id_chauf",$id_chauf,\PDO::PARAM_INT);
        $qry->execute();

        $rows = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows->STATUS_CH;
        }
    }



    public static function changeDisponibility($id_chauf){
        $db = Database::init();
        $sql = "";
        if(self::getStatusChauffeur($id_chauf) === "disponible"){
            $sql = "UPDATE CHAUFFEUR SET STATUS_CH ='indisponible' WHERE ID_CHAUF = :id_chauf";
        }else{
            $sql = "UPDATE CHAUFFEUR SET STATUS_CH ='disponible' WHERE ID_CHAUF = :id_chauf";
        }
        $qry = $db->prepare($sql);
        $qry->bindParam(":id_chauf",$id_chauf,\PDO::PARAM_INT);
        $qry->execute();
    }

}
?>