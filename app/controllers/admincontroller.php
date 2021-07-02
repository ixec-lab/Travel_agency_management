<?php
namespace AGENCE_VOYAGE\CONTROLLERS;

use AGENCE_VOYAGE\MODELS\AdminModel;
use AGENCE_VOYAGE\MODELS\ServiceModel;
use AGENCE_VOYAGE\MODELS\HotelModel;
use AGENCE_VOYAGE\MODELS\TransportModel;
use AGENCE_VOYAGE\MODELS\ProposerModel;
use AGENCE_VOYAGE\MODELS\AvoirModel;
use AGENCE_VOYAGE\MODELS\GallerieModel;
use AGENCE_VOYAGE\MODELS\ActualiteModel;
use AGENCE_VOYAGE\MODELS\VolModel;
use AGENCE_VOYAGE\MODELS\BusModel;
use AGENCE_VOYAGE\MODELS\ChambreModel;
use AGENCE_VOYAGE\MODELS\ChauffeurModel;
use AGENCE_VOYAGE\MODELS\ConduireModel;

class AdminController extends AbstractController{

    public function defaultAction(){
        if (!empty($_SESSION['admin_id'])){ // admin connected
            // send service informations
            if (!empty($_POST['submit'])){
                extract($_POST);
                //extract($_FILES);

                if(!empty($type) && !empty($_FILES) &&  !empty($titre) && !empty($prix) && !empty($desc)){
                    
                    // for xss protection
                    $type = htmlentities($type);
                    $titre = htmlentities($titre);
                    $prix = htmlentities($prix);
                    $desc = htmlentities($desc);
                    $image = IMAGES_PATH . "at.png"; // default image in case insert fails

                    if ($type !== "personnalise"){
                        if (!empty($plmax) && !empty($hotel) && !empty($type_trans)){
                            $service = new ServiceModel($titre,$_FILES['image'],$prix,$type,$desc,$plmax);
                            $service->setDestPath();
                            $errors = $service->secureImage();

                            if (count($errors) === 0){
                                $service->insert();
                                $linkHotel = new ProposerModel($hotel,$service->getItem($titre)->ID_SERVICE);
                                $linkTrans = new AvoirModel($type_trans,$service->getItem($titre)->ID_SERVICE);
                                $linkHotel->addLink();
                                $linkTrans->addLink();
                            }else{
                                $this->_error['image_errors'] = $errors; 
                            }
                                
                        }
                    }else{
                        $service = new ServiceModel($titre,$_FILES['image'],$prix,$type,$desc);
                        $service->setDestPath();
                        $errors = $service->secureImage();
                        if (count($errors) === 0){
                            $service->insert();
                        }else{
                            $this->_error['image_errors'] = $errors;
                        }
                    }
                }
            }

            // ajouter un hôtel 

            if (!empty($_POST['submit_hotel'])){
                extract($_POST);
                if (!empty($h_nom) && !empty($h_ville) && !empty($h_nbr_chambre)){

                    $h_nom = ucfirst(htmlentities($h_nom));
                    $h_ville = ucfirst(htmlentities($h_ville));
                    $h_nbr_chambre = htmlentities($h_nbr_chambre);
                    $h_etoile = htmlentities($h_etoile);

                    $hotel = new HotelModel($h_nom,$h_ville,$h_nbr_chambre,$h_etoile);
                    $hotel->insert();
                }
            }

            // Upload image and save path to db (Gallerie)

            if (!empty($_POST['submit_gallerie'])){
                $gallerie = new GallerieModel($_FILES['gallerie-image']);
                $gallerie->setDestPath();
                $errors = $gallerie->secureImage();

                if (count($errors) === 0){
                    $gallerie->savePathName();
                }
            }

            // ajoute actualité 

            if (!empty($_POST['submit_promo'])){
                extract($_POST);
                if (!empty($actbar)){

                    $actbar = ucfirst(htmlentities($actbar));
                    $newsbar = new ActualiteModel($actbar);
                    $newsbar->insert();
                }
            }

            // Supprimer des offers selon l'ID du service

                if (!empty($_POST['del_service_submit'])){
                        extract($_POST);
                        //var_dump($_POST);

                        // adding token and cheking if send full_submit on submit
                        if ($del_service_submit === "submit"){
                            if (!empty($id_service)){
                                ServiceModel::DeleteItemService($id_service);

                                echo "Offre a été supprimé avec succès";
                            }
                        }else if ($del_service_submit === "full_submit"){
                            if (!empty($id_service)){
                                AvoirModel::delLink($id_service);
                                ProposerModel::delLink($id_service);
                                ServiceModel::DeleteItemService($id_service);

                                echo "Offre a été supprimé avec succès";
                            }
                        }
                    exit(0);
                }

                // adding transport 

                if (!empty($_POST['trans_submit'])){
                    extract($_POST);
                    if (!empty($trans_type)){
                        $trans_type = htmlentities($trans_type);
                        if ($trans_type === "bus"){
                            // adding bus transport
                            if (!empty($trans_nom_compagnie) && !empty($trans_nbr_place) && !empty($trans_tarif) && !empty($trans_matricule) && !empty($trans_chauffeur)){
                                $trans_nom_compagnie = htmlentities($trans_nom_compagnie);
                                $trans_nbr_place = htmlentities($trans_nbr_place);
                                $trans_tarif = htmlentities($trans_tarif);
                                $trans_matricule = htmlentities($trans_matricule);
                                $trans_chauffeur = htmlentities($trans_chauffeur);

                                if ($trans_chauffeur == ChauffeurModel::getLastChauffeur()){
                                    $trans_chauffeur = ChauffeurModel::getLastChauffeur();
                                    var_dump($trans_chauffeur);
                                }

                                // transport
                                $transport = new TransportModel($trans_nom_compagnie,$trans_type);
                                $transport->insert();
                                $id_transport = $transport->getLastIdTransport();

                                // bus
                                $bus = new BusModel($trans_matricule,$trans_nbr_place,$trans_tarif);
                                $bus->insert($id_transport);
                                $id_bus = $bus->getLastBus();

                                // link chauffeur with bus
                                $conduire = new ConduireModel($id_bus,$trans_chauffeur);
                                $conduire->addLink();

                                // change status of dispo in chauffeur in case of reservation
                                //ChauffeurModel::changeDisponibility($trans_chauffeur);
                                
                            }
                        }else{
                            echo "ok";
                            if (!empty($trans_nom_compagnie) && !empty($trans_nbr_place) && !empty($trans_tarif) && !empty($trans_num_vol) && !empty($trans_date_dept) && !empty($trans_date_rtr)){
                                $trans_nom_compagnie = htmlentities($trans_nom_compagnie);
                                $trans_nbr_place = htmlentities($trans_nbr_place);
                                $trans_tarif = htmlentities($trans_tarif);
                                $trans_num_vol = htmlentities($trans_num_vol);
                                $trans_date_dept = htmlentities($trans_date_dept);
                                $trans_date_rtr = htmlentities($trans_date_rtr);
    
                                    // transport
                                    $transport = new TransportModel($trans_nom_compagnie,$trans_type);
                                    $transport->insert();
                                    $id_transport = $transport->getLastIdTransport();
    
                                    var_dump($transport);
    
                                    // avion
                                    $vol = new VolModel($trans_num_vol,$trans_nbr_place,$trans_tarif,$trans_date_dept,$trans_date_rtr);
                                    var_dump($vol);
                                    $vol->insert($id_transport);
                            }
                        }
                }
            }

            // add chauffeur
            if (!empty($_POST['submit_chauf'])){
                extract($_POST);
                //var_dump($_POST);

                if (!empty($chauf_nom) && !empty($chauf_prenom) && !empty($chauf_Num)){
                    $chauf_nom = ucfirst(htmlentities($chauf_nom));
                    $chauf_prenom = ucfirst(htmlentities($chauf_prenom));
                    $chauf_Num = htmlentities($chauf_Num);

                    $chauffeur = new ChauffeurModel($chauf_Num,$chauf_nom,$chauf_prenom);
                    $chauffeur->insert();
                }

            }

            // get max rooms & occuped chambres in hotel spec by ID

            if(!empty($_POST['request_number_max_hotel'])){
                extract($_POST);

                $this->_data['max_rooms'] = HotelModel::getNbrChambreInHotel($id_hotel);
                $this->_data['occuped_rooms'] = ChambreModel::getNbrChambreOccupe($id_hotel);
                //var_dump($this->_data);
                echo json_encode($this->_data);
                exit(0);
            }

            // add a room with spec hotel

            if (!empty($_POST['submit_chambre'])){
                extract($_POST);
                //var_dump($_POST);

                if (!empty($chambre_hotel) && !empty($chambre_prix) && !empty($chambre_type)){
                    $occupedRooms = ChambreModel::getNbrChambreOccupe($chambre_hotel);
                    $roomMax = HotelModel::getNbrChambreInHotel($chambre_hotel);
                    
                    if ($occupedRooms < $roomMax){
                        $chambre = new ChambreModel($chambre_type,$chambre_prix);
                        $chambre->insert($chambre_hotel);
                    }else{
                        $this->_error['msg_error'] = "vous pouvez ajouter des chambres a un nombre limité";
                        $this->_error['error'] = true;
                        
                    }

                    if(count($this->_error) === 0){
                        $occupedRooms = ChambreModel::getNbrChambreOccupe($chambre_hotel);
                        $roomMax = HotelModel::getNbrChambreInHotel($chambre_hotel);

                        $this->_data['max_rooms'] = $roomMax;
                        $this->_data['occuped_rooms'] = $occupedRooms;
                        $this->_data['msg'] = "Chambre ajoutée avec succès";
                        $this->_data['error'] = false;

                        echo json_encode($this->_data);
                        exit(0);
                    }else{
                        echo json_encode($this->_error);
                        exit(0);
                    }
                    
                }else{
                    $this->_error['msg_error'] = "Veuillez remplire tous les champes";
                    $this->_error['error'] = true;
                    echo json_encode($this->_error);
                    exit(0);
                }


            }

            $this->_view();
        }else{
            header('Location: /admin/login');
            exit(0);
        }
       

    }


    public function loginAction(){
        if (!empty($_SESSION)){ // if connected as admin
            header('Location: /admin/default');
            exit(0);
        }else{
            if (!empty($_POST)){
                extract($_POST);
                $ip = $_SERVER['REMOTE_ADDR'];
                //echo $ip;
                $admin = new AdminModel($email,$password,$ip);
                // log all test login
                $admin->logWrongInformation();

                //check login
                $id = $admin->check();

                if($id > 0){
                    $_SESSION['admin_username'] = AdminModel::getAllFromUser($id)->USER_ADMIN;
                    $_SESSION['admin_email'] = AdminModel::getAllFromUser($id)->EMAIL_ADMIN;
                    $_SESSION['admin_id'] = $id;
                    $_SESSION['is_admin'] = true;
                    header('Location: /admin/default');
                    exit(0);
                }else{
                    $this->_error['bad_login'] = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                    <strong>Oops !</strong> Email / mot de passe incorrect
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                    </div>";
                }
            }
            $this->_view();
        }


        
    }

    public function logoutAction(){

        if(!empty($_SESSION['admin_id'])){
            session_destroy();
            session_unset();
            header('Location: /index');
            exit(0);
        }
        $this->_view();
    }
}
?>