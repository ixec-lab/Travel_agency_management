<?php
// test class
    namespace AGENCE_VOYAGE\CONTROLLERS;
    use AGENCE_VOYAGE\MODELS\UserModel;
    use AGENCE_VOYAGE\MODELS\ContactModel;
    
class IndexController extends AbstractController{
    
    public function defaultAction(){
        if (!empty($_POST['contact_submit'])){
            extract($_POST);
            //var_dump($_POST);
            if (!empty($email) && !empty($sujet) && !empty($msg)){
                $email = htmlentities($email);
                $sujet = htmlentities($sujet);
                $msg   = htmlentities($msg);
                $contact= new ContactModel($email,$sujet,$msg);
                $contact->insert();

                $this->_data['msg_success'];
            } else {
                 $this->_error['Erreur Contact'] ="Veillez remplir toutes les cases" ;
            }
        }

        $this->_view();
    }
    
    public function loginAction(){

        if (empty($_SESSION['id'])){
            if (!empty($_POST['login'])){
                extract($_POST);
                if (!empty($email) && !empty($password)){
                    $password = md5($password);
                    $connexion = new userModel($email,$password);
                    $id = $connexion->check();

                    if ($id > 0){ // valide connection
                        $_SESSION['email'] = UserModel::getAllFromUser($id)->EMAILC;
                        $_SESSION['nom'] = UserModel::getAllFromUser($id)->NOMC;
                        $_SESSION['prenom'] = UserModel::getAllFromUser($id)->PRENOMC;
                        $_SESSION['id'] = $id;
                        $_SESSION['is_admin'] = false;
                        header('Location: /index/default'); // user redict
                        exit(0); // for security reasons
                    }else{
                        $this->_error['bad_login'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                        <strong>Oops !</strong> Email / mot de passe incorrect
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                      </div>";
                    }
                }
            }

            $this->_view();
        }else{
            header('Location: /profile');
            exit(0);
        }
    }
    // logout function
    public function logoutAction(){
        if (!empty($_SESSION['id'])){ // if connected
            session_unset();
            session_destroy();
            header('Location: /index/default');
            exit(0);
        }else{
            header('Location: /index/login');
            exit(0);
        }
    }

    public function registerAction(){

        if (!empty($_SESSION['id'])){ // if connected
            //add popup msg whene already connected and redirect to /index/default
            header('Location: /index/default');
            exit(0);
        }else{
            if (!empty($_POST['register'])){
                extract($_POST);
                if (!empty($nom) && !empty($prenom) && !empty($sexe) && !empty($date) && !empty($adresse) && !empty($tel) && !empty($username) && !empty($email) && !empty($password) && !empty($confirmp) && !empty($idPassport)){
                    // inputs filtring for security reasons (XSS)
                    $nom = htmlentities($nom);
                    $nom = ucfirst($nom);

                    $prenom = htmlentities($prenom);
                    $prenom = ucfirst($prenom);

                    $sexe = htmlentities($sexe);
                    $sexe = ucfirst($sexe);

                    $date = htmlentities($date);
                    $adresse = htmlentities($adresse);
                    $email = htmlentities($email);
                    $tel = htmlentities($tel);
                    $username = htmlentities($username);

                    $password = htmlentities($password);
                    $password = md5($password);

                    $confirmp = htmlentities($confirmp);
                    $confirmp = md5($confirmp);
                    
                    $idPassport = htmlentities($idPassport);

                    if ($password !== $confirmp){
                        $this->_error['bad_validation_password'] = "Mot de passe n'est pas indentique";
                        }
                        
                        if ($sexe !==  "F" && $sexe !== "H"){
                        $this->_error['bad_gender'] = "F ou M doit être selectionnée";
                        }
                                                
                        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)){
                        $this->_error['bad_date_format'] = "Date format invalide (ex : 2000-12-31)";
                        }
                        
                        if (!preg_match("/^[A-Z][-a-zA-Z]+$/im", $nom) && preg_match("/^[A-Z][-a-zA-Z]+$/im", $prenom)){
                        $this->_error['bad_name_format'] = "Nom ou Prénom invalide";
                        }
                                                
                        if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                        $this->_error['bad_email_format'] = "Email invalide";
                        }
                                                
                        if (!preg_match("/^[0-9]{9}$/im",$idPassport)){
                        $this->_error['bad_passeport_format'] = "Numéro de passeport invalide";
                        }
                        
                        if (!preg_match("/^(\+)?[0-9]{3}[1-9][0-9]{8}$/im",$tel)){
                        $this->_error['bad_phone_format'] = "Numéro de téléphone invalide";
                        }

                        if (count($this->_error) === 0){
                            $connexion = new UserModel($email,$password,$username,$nom,$prenom,$tel,$adresse,$sexe,$idPassport,$date);
                            //var_dump($connexion);
                            $connexion->register();
                            header('Location: /index/login');
                            exit(0);
                        }
                }
            }
            $this->_view();
        }

        
    }
}
?> 