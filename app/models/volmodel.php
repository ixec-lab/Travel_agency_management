<?php
namespace AGENCE_VOYAGE\MODELS ;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;

class VolModel{

    private $num_vol;
    private $nbr_place;
    private $date_aller;
    private $tarif;
    private $date_retour;

    function __construct($num_vol,$nbr_place,$tarif,$date_aller,$date_retour){
        $this->num_vol = $num_vol;
        $this->nbr_place = $nbr_place;
        $this->date_aller = $date_aller;
        $this->tarif = $tarif;
        $this->date_retour = $date_retour;
    }


    public function insert($id_transport){
        $db = Database::init();
        $date_re = date("Y-m-d", strtotime($this->date_retour));
        $date_al = date("Y-m-d", strtotime($this->date_aller));
        $sql = "INSERT INTO VOL(NUM_VOL,ID_TRANSPORT,NBR_PLACE,TARIF_V,DATE_ALLER,DATE_RETOUR) VALUES (:num_vol,:id_transport,:nbr_place,:tarif,:date_aller,:date_retour)";
        $qry = $db->prepare($sql);
        $qry->bindParam(":num_vol",$this->num_vol,\PDO::PARAM_STR);
        $qry->bindParam(":id_transport",$id_transport,\PDO::PARAM_INT);
        $qry->bindParam(":nbr_place",$this->nbr_place,\PDO::PARAM_INT);
        $qry->bindParam(":tarif",$this->tarif,\PDO::PARAM_STR); // float value
        $qry->bindParam(":date_aller",$date_al,\PDO::PARAM_STR);
        $qry->bindParam(":date_retour",$date_re,\PDO::PARAM_STR);
        $qry->execute();
    }

    // get all bus

    public static function getAllVol(){
        $db = Database::init();
        $sql = "SELECT * FROM Vol";
        $qry = $db->prepare($sql);
        $qry->execute();

        $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows;
        }
    }

}
?>