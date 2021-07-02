<?php
namespace AGENCE_VOYAGE\MODELS ;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;
use AGENCE_VOYAGE\LIBS\CLASSES\ImageUploader;

class ServiceModel extends ImageUploader{
    private $titre;
    private $prix;
    private $type_voyage;
    private $description;
    private $place_max;

    public function __construct($titre = null, $image = null, $prix = null, $type_voyage = null, $description = null, $place_max = null){
        parent::__construct($image);
        $this->titre = $titre;
        $this->prix = $prix;
        $this->type_voyage = $type_voyage;
        $this->description = $description;
        $this->place_max = $place_max;
        

    }

    public function Insert(){
        $db = Database::init();
        if ($this->place_max !== null)
            $sql = "INSERT INTO SERVICE(TYPE_V,TARIF,DESCRIPTION,IMG_S,NBR_M,TITRE) VALUES(:type,:tarif,:desc,:image,:nbr_max,:titre)";
        else
        $sql = "INSERT INTO SERVICE(TYPE_V,TARIF,DESCRIPTION,IMG_S,TITRE) VALUES(:type,:tarif,:desc,:image,:titre)";
        $fullpath = substr($this->getDesPath().$this->getName().'.'.$this->getExt(),13);
        $qry = $db->prepare($sql);
        $qry->bindParam(":type",$this->type_voyage,\PDO::PARAM_STR);
        $qry->bindParam(":tarif",$this->prix,\PDO::PARAM_STR);
        $qry->bindParam(":desc",$this->description,\PDO::PARAM_STR);
        $qry->bindParam(":image",$fullpath,\PDO::PARAM_STR);
        if ($this->place_max !== null)
            $qry->bindParam(":nbr_max",$this->place_max,\PDO::PARAM_INT);
        $qry->bindParam(":titre",$this->titre,\PDO::PARAM_STR);
        $qry->execute();
    }


    public function getItem($titre){
        $db = Database::init();
        $sql = "SELECT * FROM SERVICE WHERE TITRE = :titre";
        $qry = $db->prepare($sql);
        $qry->bindParam(':titre',$titre,\PDO::PARAM_STR);
        $qry->execute();

        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0){
            return $row;
        }
    }

    public static function getAllServices(){
        $db = Database::init();
        $sql = "SELECT * FROM SERVICE";
        $qry = $db->prepare($sql);
        $qry->execute();

        $row = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0){
            return $row;
        }
    }

    public static function getServicesById($id_service){
        $db = Database::init();
        $sql = "SELECT * FROM SERVICE WHERE ID_SERVICE = :id_service";
        $qry = $db->prepare($sql);
        $qry->bindParam(":id_service",$id_service,\PDO::PARAM_INT);
        $qry->execute();

        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0){
            return $row;
        }
    }

    public static function DeleteItemService($id){
        $db = Database::init();
        $sql = "DELETE FROM SERVICE WHERE ID_SERVICE = :id";
        $qry = $db->prepare($sql);
        $qry->bindParam(':id',$id,\PDO::PARAM_INT);
        $qry->execute();
    }
}

?>