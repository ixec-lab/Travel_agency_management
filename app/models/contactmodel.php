<?php
namespace AGENCE_VOYAGE\MODELS ;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;

class ContactModel{

    private $email;
    private $sujet;
    private $msg;

    function __construct($email,$sujet,$msg){
        $this->email = $email;
        $this->sujet = $sujet;
        $this->msg = $msg;

    }


    public function insert(){
        $db = Database::init();
        $sql = "INSERT INTO CONTACT(EMAIL,SUJET,MSG) VALUES (:email,:sujet,:msg)";
        $qry = $db->prepare($sql);
        $qry->bindParam(":email",$this->email,\PDO::PARAM_STR);
        $qry->bindParam(":sujet",$this->sujet,\PDO::PARAM_STR);
        $qry->bindParam(":msg",$this->msg,\PDO::PARAM_STR);

        $qry->execute();
    }

    // get all contact

    public static function getAllContact(){
        $db = Database::init();
        $sql = "SELECT * FROM CONTACT";
        $qry = $db->prepare($sql);
        $qry->execute();

        $rows = $qry->fetchAll(\PDO::FETCH_OBJ);

        if ($qry->rowCount($rows) > 0){
            return $rows;
        }
    }

}
?>