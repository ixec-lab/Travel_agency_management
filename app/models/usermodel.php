<?php
namespace AGENCE_VOYAGE\MODELS ;
use AGENCE_VOYAGE\LIBS\DATABASE\DataBase;

class UserModel{
    private $username;
    private $email;
    private $password;
    private $nom;
    private $prenom;
    private $tel;
    private $adresse;
    private $sexe;
    private $passeport;
    private $daten;

    function __construct($email = null,$password = null,$username = null,$nom = null,$prenom = null,$tel = null,$adresse = null,$sexe = null,$passeport = null,$daten = null, $bio = null){
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->tel = $tel;
        $this->adresse = $adresse;
        $this->sexe = $sexe;
        $this->passeport = $passeport;
        $this->daten = $daten;
        $this->bio = $bio;
    }

    public function check(){
        $db = Database::init();
        $sql = "SELECT ID_C FROM CLIENT WHERE (EMAILC = :email OR USERC = :email) AND PASSWORDC = :password";
        $qry = $db->prepare($sql);
        $qry->bindParam(":email",$this->email,\PDO::PARAM_STR); // send email or username selon le context
        $qry->bindParam(":password",$this->password,\PDO::PARAM_STR);
        $qry->execute();
        $row = $qry->fetch(\PDO::FETCH_OBJ);

        if($qry->rowCount($row) > 0){
            return $row->ID_C;
        }else{
            return 0;
        }

    }

    public function register(){
        // handle requests with jquery to best error display
        $db = Database::init();
        $sql = "INSERT INTO CLIENT(NOMC,PRENOMC,SEXE,DATE_DE_NAISSANCE,ADRESSEC,TELEPHONEC,EMAILC,USERC,PASSWORDC,NUM_PASSEPORT) VALUES (:nom,:prenom,:sexe,:daten,:adresse,:tel,:email,:username,:password,:passeport)";
        $qry = $db->prepare($sql);
        //htmlentities
        $daten = date("Y-m-d", strtotime($this->daten));
        $qry->bindParam(":nom",$this->nom,\PDO::PARAM_STR);
        $qry->bindParam(":prenom",$this->prenom,\PDO::PARAM_STR);
        $qry->bindParam(":sexe",$this->sexe,\PDO::PARAM_STR);
        $qry->bindParam(":daten",$daten,\PDO::PARAM_STR);
        $qry->bindParam(":adresse",$this->adresse,\PDO::PARAM_STR);
        $qry->bindParam(":tel",$this->tel,\PDO::PARAM_STR);
        $qry->bindParam(":email",$this->email,\PDO::PARAM_STR);
        $qry->bindParam(":username",$this->username,\PDO::PARAM_STR);
        $qry->bindParam(":password",$this->password,\PDO::PARAM_STR);
        $qry->bindParam(":passeport",$this->passeport,\PDO::PARAM_INT);
        $qry->execute();
    }

    public static function getAllFromUser($id){
        $db = Database::init();
        $sql = "SELECT * from CLIENT WHERE ID_C = :id";
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

    public static function updateUserBasicInfo($currentId,$nom,$prenom,$bio,$tel){
        $db = Database::init();
        $sql = "UPDATE CLIENT SET NOMC = :nom, PRENOMC = :prenom, BIOC = :bio, TELEPHONEC = :tel WHERE ID_C = :id";
        $qry = $db->prepare($sql);
        $qry->bindParam(":id",$currentId,\PDO::PARAM_INT);
        $qry->bindParam(":nom",$nom,\PDO::PARAM_STR);
        $qry->bindParam(":prenom",$prenom,\PDO::PARAM_STR);
        $qry->bindParam(":bio",$bio,\PDO::PARAM_STR);
        $qry->bindParam(":tel",$tel,\PDO::PARAM_STR);
        $qry->execute();
    }

    public static function updateUserEmail($currentId,$email){
        $db = Database::init(); // PDO
        $sql = "UPDATE CLIENT SET EMAILC = :email WHERE ID_C = :id";
        $qry = $db->prepare($sql);
        $qry->bindParam(":id",$currentId,\PDO::PARAM_INT);
        $qry->bindParam(":email",$email,\PDO::PARAM_STR);
        $qry->execute();
    }

    public static function updateUserPassword($currentId,$password){
        $db = Database::init();
        $sql = "UPDATE CLIENT SET PASSWORDC = :password WHERE ID_C = :id";
        $qry = $db->prepare($sql);
        $qry->bindParam(":id",$currentId,\PDO::PARAM_INT);
        $qry->bindParam(":password",$password,\PDO::PARAM_STR);
        $qry->execute();
    }
}

?>