<?php
namespace AGENCE_VOYAGE\MODELS ;

use AGENCE_VOYAGE\MODELS\ServiceModel;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;
use AGENCE_VOYAGE\MODELS\HotelModel;

class OffreModel extends ServiceModel{


    public static function CountAllOffers(){
        $db = DataBase::init();
        $sql = "SELECT COUNT(ID_SERVICE) as NBR FROM SERVICE";
        $qry = $db->prepare($sql);
        $qry->execute();

        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0){
            return $row->NBR;
        }
    }
    // for filtring
    public static function getAllOffersByType($type){
        $db = DataBase::init();
        $sql = "SELECT * FROM SERVICE WHERE TYPE_V = :type";
        $qry = $db->prepare($sql);
        $qry->bindParam(':type',$type,\PDO::PARAM_STR);
        $qry->execute();

        $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

        if($qry->rowCount($rows) > 0){
            return $rows;
        }else{
            return [];
        }
    }
    // sorting data  by filter
    public static function getAllOffersSorted($type,$budget,$dispo){
        $db = Database::init();
        if (!empty($type)){
            $sql = "SELECT * FROM SERVICE WHERE TYPE_V = :type";
            $qry = $db->prepare($sql);
            $qry->bindParam(':type',$type,\PDO::PARAM_STR);
            $qry->execute();

             $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

            if(!empty($dispo)){
              $sql = "SELECT * FROM SERVICE WHERE (disponibilite = :dispo AND TYPE_V = :type)";
              $qry = $db->prepare($sql);
              $qry->bindParam(':type',$type,\PDO::PARAM_STR);
              $qry->bindParam(':dispo',$dispo,\PDO::PARAM_STR);
              $qry->execute();
    
              $rows = $qry->fetchAll(\PDO::FETCH_OBJ);
                if(!empty($budget)){
                    $sql = "SELECT * FROM SERVICE WHERE (disponibilite = :dispo AND TYPE_V = :type AND TARIF <= :budg)";
                    $qry = $db->prepare($sql);
                    $qry->bindParam(':type',$type,\PDO::PARAM_STR);
                    $qry->bindParam(':dispo',$dispo,\PDO::PARAM_STR);
                    $qry->bindParam(':budg',$budget,\PDO::PARAM_STR);
                    $qry->execute();
    
                    $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

                 }

            } elseif(!empty($budget)){
                    $sql = "SELECT * FROM SERVICE WHERE (TYPE_V = :type AND TARIF <= :budg)";
                    $qry = $db->prepare($sql);
                    $qry->bindParam(':type',$type,\PDO::PARAM_STR);
                    $qry->bindParam(':budg',$budget,\PDO::PARAM_STR);
                    $qry->execute();
    
                    $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

              }
        } elseif(!empty($dispo)){
            $sql = "SELECT * FROM SERVICE WHERE disponibilite = :dispo";
            $qry = $db->prepare($sql);
            $qry->bindParam(':dispo',$dispo,\PDO::PARAM_STR);
            $qry->execute();
    
            $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

            if(!empty($budget)){
                $sql = "SELECT * FROM SERVICE WHERE (disponibilite = :dispo AND TARIF <= :budg)";
                $qry = $db->prepare($sql);
                
                $qry->bindParam(':dispo',$dispo,\PDO::PARAM_STR);
                $qry->bindParam(':budg',$budget,\PDO::PARAM_STR);
                $qry->execute();

                $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

             }
            
        }else { 
            $sql = "SELECT * FROM SERVICE WHERE TARIF <= :budg";
            $qry = $db->prepare($sql);
            $qry->bindParam(':budg',$budget,\PDO::PARAM_STR);
            $qry->execute();

            $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

        }
        if($qry->rowCount($rows) > 0){
            return $rows;
        }else{
            return [];
        }

    }

    public static function getAllOffersByDispo($dispo){
        $db = DataBase::init();
        $sql = "SELECT * FROM SERVICE WHERE disponibilite = :dispo";
        $qry = $db->prepare($sql);
        $qry->bindParam(':dispo',$dispo,\PDO::PARAM_STR);
        $qry->execute();

        $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

        if($qry->rowCount($rows) > 0){
            return $rows;
        }else{
            return [];
        }
    }

    public static function getAllOffersByBudget($budg){
        $db = DataBase::init();
        $sql = "SELECT * FROM SERVICE WHERE TARIF <= :budg";
        $qry = $db->prepare($sql);
        $qry->bindParam(':budg',$budg,\PDO::PARAM_STR);
        $qry->execute();

        $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

        if($qry->rowCount($rows) > 0){
            return $rows;
        }else{
            return [];
        }
    }
    // all full price in cas hotel or trans moy + offer base price selected
    public static function getServicePrice($id_service){
        $db = DataBase::init();
        $sql = "select TARIF as traif from SERVICE s , AVOIR a where s.ID_SERVICE = a.ID_SERVICE AND s.ID_SERVICE = :id_service";
        $qry = $db->prepare($sql);
        $qry->bindParam(':id_service',$id_service,\PDO::PARAM_INT);
        $qry->execute();

        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0){
            return $row->tarif;
        }else{
            return 0;
        }
    }

    public static function getVolPrice($id_service){
        $db = DataBase::init();
        $sql = "select v.TARIF_V as tarif from VOL v , SERVICE s ,AVOIR a where s.ID_SERVICE = a.ID_SERVICE AND a.ID_TRANSPORT = v.ID_TRANSPORT AND s.ID_SERVICE = :id_service";
        $qry = $db->prepare($sql);
        $qry->bindParam(':id_service',$id_service,\PDO::PARAM_INT);
        $qry->execute();

        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0){
            return $row->tarif;
        }else{
            return 0;
        }
    }
    //  to change
    public static function getHotelPrice($id_service){
        $db = DataBase::init();
        $sql = "select ch.TARIF_CHBR as tarif from HOTEL h , SERVICE s ,PROPOSER p, CHAMBRE ch where s.ID_SERVICE = p.ID_SERVICE AND p.ID_H = h.ID_H AND h.ID_H = ch.ID_H AND s.ID_SERVICE = :id_service";
        $qry = $db->prepare($sql);
        $qry->bindParam(':id_service',$id_service,\PDO::PARAM_INT);
        $qry->execute();

        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0){
            return $row->tarif;
        }else{
            return 0;
        }
    }

    public static function getBusPrice($id_service){
        $db = DataBase::init();
        $sql = "select b.TARIF_b as tarif from BUS b , SERVICE s ,AVOIR a where s.ID_SERVICE = a.ID_SERVICE AND a.ID_TRANSPORT = b.ID_TRANSPORT AND s.ID_SERVICE = :id_service";
        $qry = $db->prepare($sql);
        $qry->bindParam(':id_service',$id_service,\PDO::PARAM_INT);
        $qry->execute();

        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($row) > 0){
            return $row->tarif;
        }else{
            return 0;
        }
    }

    public static function redef_array_unique($array, $keep_key_assoc = false){
        $duplicate_keys = array();
        $tmp = array();       
    
        foreach ($array as $key => $val){
            // convert objects to arrays, in_array() does not support objects
            if (is_object($val))
                $val = (array)$val;
    
            if (!in_array($val, $tmp))
                $tmp[] = $val;
            else
                $duplicate_keys[] = $key;
        }
    
        foreach ($duplicate_keys as $key)
            unset($array[$key]);
    
        return $keep_key_assoc ? $array : array_values($array);
    }
}