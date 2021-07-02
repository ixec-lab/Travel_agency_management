<?php
namespace AGENCE_VOYAGE\MODELS ;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;

class FactureModel{

    private $date_f;
    private $montant_total;

    function __construct($date_f,$montant_total){
        $this->date_f = $date_f;
        $this->montant_total = $montant_total;
    }


    public function insert(){
        $db = Database::init();
        $sql = "INSERT INTO FACTURE(DATE_F,MONTANT_TOTAL) VALUES (:date_f,:montant_total)";
        $qry = $db->prepare($sql);
        $qry->bindParam(":date_f",$this->date_f,\PDO::PARAM_STR);
        $qry->bindParam(":montant_total",$this->montant_total,\PDO::PARAM_STR);

        $qry->execute();
    }

    // get all facture

    public static function getAllFacture(){
        $db = Database::init();
        $sql = "SELECT * FROM FACTURE";
        $qry = $db->prepare($sql);
        $qry->execute();

        $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows;
        }
    }

    // get last created facture
    public static function getLastFacture(){
        $db = Database::init();
        $sql = "SELECT NUM_FACTURE FROM FACTURE ORDER BY (NUM_FACTURE) DESC LIMIT 1";
        $qry = $db->prepare($sql);
        $qry->execute();

        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0){
            return $row->NUM_FACTURE;
        }
    }

}
?>