<?php
namespace AGENCE_VOYAGE\MODELS ;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;

class AdminModel{
    private $email;
    private $password;
    private $ip;

    /* Constructeur admin */

    function __construct($email = null , $password = null, $ip = null){
        $this->email = $email;
        $this->password = $password;
        $this->ip = $ip;
    }

    public function check(){
        $db = Database::init();
        $sql = "SELECT ID_ADMIN FROM ADMIN WHERE (EMAIL_ADMIN = :email OR USER_ADMIN = :email) AND PASSWORD_ADMIN = :password";
        $qry = $db->prepare($sql);
        $qry->bindParam(":email",$this->email,\PDO::PARAM_STR); // send email or username selon le context
        $qry->bindParam(":password",$this->password,\PDO::PARAM_STR);
        $qry->execute();
        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if($qry->rowCount($row) > 0){
            return $row->ID_ADMIN;
        }else{
            return 0;
        }

    }

    public static function getAllFromUser($id){
        $db = Database::init();
        $sql = "SELECT * from ADMIN WHERE ID_ADMIN = :id";
        $qry = $db->prepare($sql);
        $qry->bindParam(":id",$id,\PDO::PARAM_INT);
        $qry->execute();

        $rows = $qry->fetch(\PDO::FETCH_OBJ);

        if($qry->rowCount($rows) > 0){
            return $rows;
        }else{
            return 0;
        }

    }

    public function logWrongInformation(){
        $db = Database::init();
        $sql = "INSERT INTO Hist_Bad_Login(IP,EMAIL,PASSWORD,DATE_LOGIN) VALUES (:ip,:email,:password,:date)";
        $qry = $db->prepare($sql);
        $date = date("Y-m-d:h:m:s");
        $qry->bindParam(":ip",$this->ip,\PDO::PARAM_STR);
        $qry->bindParam(":email",$this->email,\PDO::PARAM_STR);
        $qry->bindParam(":password",$this->password,\PDO::PARAM_STR);
        $qry->bindParam(":date",$date,\PDO::PARAM_STR);
        $qry->execute();
    }

    public static function countFrom($param,$table){
        $db = Database::init();
        $sql = "SELECT COUNT($param) as Nb FROM $table";
        $qry = $db->prepare($sql);
        $qry->execute();

        $rows = $qry->fetch(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows->Nb;
        }
    }

    public static function getUsersList(){
        $db = Database::init();
        $sql = "SELECT * FROM CLIENT";
        $qry = $db->prepare($sql);
        $qry->execute();

        $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows;
        }
    }

    public static function getServiceReserved(){
        $db = Database::init();
        $sql = "select * from RESERVER r , CLIENT c , SERVICE s WHERE r.ID_SERVICE = s.ID_SERVICE AND c.ID_C = r.ID_C AND r.ID_SERVICE = s.ID_SERVICE";
        $qry = $db->prepare($sql);
        $qry->execute();
        $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows;
        }
    }


}

?>