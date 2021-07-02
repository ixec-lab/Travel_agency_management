<?php
namespace AGENCE_VOYAGE\MODELS ;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;

class HotelModel{
    private $nom;
    private $ville;
    private $nbr_chambre;
    private $etoile;

    function __construct($nom = null , $ville = null , $nbr_chambre = null,$etoile = null){
        $this->nom = $nom;
        $this->ville = $ville;
        $this->nbr_chambre = $nbr_chambre;
        $this->etoile = $etoile;
    }

    public function insert(){
        $db = Database::init();
        $sql = "INSERT INTO HOTEL(NOMH,VILLEH,NBR_CHAMBRE,ETOILE) VALUES (:nom,:ville,:nbr_chr,:etoile)";
        $qry = $db->prepare($sql);
        $qry->bindParam(":nom",$this->nom,\PDO::PARAM_STR);
        $qry->bindParam(":ville",$this->ville,\PDO::PARAM_STR);
        $qry->bindParam(":nbr_chr",$this->nbr_chambre,\PDO::PARAM_INT);
        $qry->bindParam(":etoile",$this->etoile,\PDO::PARAM_INT);
        $qry->execute();
    }

    // get all hotls

    public static function getAllHotels(){
        $db = Database::init();
        $sql = "SELECT * FROM HOTEL";
        $qry = $db->prepare($sql);
        $qry->execute();

        $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows;
        }
    }

    public static function getNbrChambreInHotel($id_hotel){
        $db = Database::init();
        $sql = "SELECT NBR_CHAMBRE FROM HOTEL WHERE ID_H = :id_hotel";
        $qry = $db->prepare($sql);
        $qry->bindParam(":id_hotel",$id_hotel,\PDO::PARAM_INT);
        $qry->execute();

        $rows = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows->NBR_CHAMBRE;
        }else 
            return 0;

    }
}



?>