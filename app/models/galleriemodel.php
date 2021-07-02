<?php
namespace AGENCE_VOYAGE\MODELS ;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;
use AGENCE_VOYAGE\LIBS\CLASSES\ImageUploader;

class GallerieModel extends ImageUploader{
    
 // save full path in db (gallerie)
    public function savePathName(){
        $fullDest = substr($this->getDesPath().$this->getName().'.'.$this->getExt(),13);
        $db = DataBase::init();
        $sql = "INSERT INTO GALERIE(IMAGE) VALUES (:image)";
        $qry = $db->prepare($sql);
        $qry->bindParam(':image',$fullDest,\PDO::PARAM_STR);
        $qry->execute();
    }
        
 // get all path from db (gallerie)
        
    public static function getAllPathesGallerie(){
        $db = DataBase::init();
        $sql = "SELECT * FROM GALERIE";
        $qry = $db->prepare($sql);
        $qry->execute();
        $rows = $qry->fetchAll(\PDO::FETCH_OBJ);
            
        if ($qry->rowCount($rows) > 0){
            return $rows;
        }
    }
}
?>