<?php
    namespace AGENCE_VOYAGE\CONTROLLERS;

    use AGENCE_VOYAGE\MODELS\OffreModel;
    use AGENCE_VOYAGE\MODELS\ServiceModel;
    use AGENCE_VOYAGE\MODELS\AvoirModel;
    use AGENCE_VOYAGE\MODELS\ChambreModel;
    use AGENCE_VOYAGE\MODELS\FactureModel;
    use AGENCE_VOYAGE\MODELS\ProposerModel;
    use AGENCE_VOYAGE\MODELS\ReservationModel;

    class OffresController extends AbstractController{

        public function defaultAction(){
            $this->_view();
        }


        public function listAction(){

            if (!empty($_POST['filter_submit'])){
                extract($_POST);
                // load content in view without load the page
                $this->_data['filterd_data'] = OffreModel::getAllOffersSorted($offer_type,$offer_budget,$offer_dispo);
            }
            $this->_view();
        }

        public function reserverAction(){

            if(!empty($_SESSION)){ // user connected or admin
                if ($_SESSION['is_admin'] === false){
                    extract($_POST);
                    if (!empty($_POST)){
                        if (!empty($_POST['action']) && $_POST['action'] === "reserver"){
                            $data = [];
                            //$_SESSION['estim_error'] = true;
                            //var_dump($_POST);
                            if ($_POST['offre'] > 0) { // pour affichage de la page

                                if(!empty($_POST['prix_estim_submit'])){
                                    $_SESSION['estim_exists'] = true;
                                    extract($_POST);
                                    // nbr adulte
                                    if ($nbr_adult <= 0 || $nbr_adult >= 6){
                                        $data['error_msg_adulte'] = "Nombre de personne adulte invalide";
                                    }
                                    // nbr enfant
                                    if ($nbr_enfant < 0 || $nbr_enfant >= 15){
                                        $data['error_msg_enfant'] = "Nombre d'enfant invalide";
                                    }
                                    // nbr bb
                                    if ($nbr_bb < 0 || $nbr_bb >= 5){
                                        $data['error_msg_bb'] = "Nombre bébé invalide";
                                    }

                                    //var_dump($data);

                                    if (count($data) > 0){ // erreur
                                        $data['error'] = true;
                                        $_SESSION['estim_error'] = true;
                                        echo json_encode($data);
                                        exit(0);
                                    }else{
                                        $data['prix_adult'] = (float)$nbr_adult * (float)$_SESSION['service_prix_total'];
                                        $data['prix_enfant'] = (float)$nbr_enfant * 0.5 * (float)$_SESSION['service_prix_total'];
                                        $data['prix_bb'] = (float)$nbr_bb * 0.1 * (float)$_SESSION['service_prix_total'];
                                        $data['total'] = $data['prix_adult'] + $data['prix_enfant'] + $data['prix_bb'];
                                        $_SESSION['estim_prix_total'] = $data['total'];
                                        $_SESSION['estim_error'] = false;
                                        $data['error'] = false;
                                        echo json_encode($data);
                                        $this->_data = [];
                                        exit(0);
                                    }

                                }elseif(empty($_POST['reservation_submit'])){
                                    
                                    $_SESSION['estim_exists'] = false;
                                    $this->_data['service'] = ServiceModel::getServicesById($offre);
    
                                    $this->_data['service_prix_total'] = 0;
    
                                    // tarif transport
                                    if (AvoirModel::getTypeTransportInService($this->_data['service']->ID_SERVICE) === "bus"){
                                        $this->_data['tariftrans'] = OffreModel::getBusPrice($this->_data['service']->ID_SERVICE);
                                    }else{
                                        $this->_data['tariftrans'] = OffreModel::getVolPrice($this->_data['service']->ID_SERVICE);
                                    }
    
                                    // id_hotel_en_reservation
                                    $id_hotel_selec = ProposerModel::getIdHotelInService($this->_data['service']->ID_SERVICE);
                                    // tarif hotel
                                    $this->_data['tarif_hotel'] = OffreModel::getHotelPrice($this->_data['service']->ID_SERVICE);
                                    
                                    // type chambre en fonction de l'hotel
                                    $this->_data['type_chambre'] = ChambreModel::getTypeChambreInHotel($id_hotel_selec);
    
                                    // prix total
                                    $this->_data['service_prix_total'] = (int)$this->_data['tariftrans'] + (int) $this->_data['tarif_hotel'] + (int) $this->_data['service']->TARIF;
                                    $_SESSION['service_prix_total'] = $this->_data['service_prix_total'];
                                    //var_dump($_SESSION);
                                }


                                    if (!empty($_POST['reservation_submit'])){
                                        $id_user = $_SESSION['id'];
                                        $id_service = $offre;
                                        $date_res = date("Y-m-d");
                                            //var_dump($_SESSION);

                                        // defined puis check value
                                        //if(isset($_SESSION['estim_error']))
                                        if ($_SESSION['estim_exists'] === true){
                                            if ($_SESSION['estim_error'] === false){
                                                $total_prix = $_SESSION['estim_prix_total'];
                                                $facture = new FactureModel($date_res,$total_prix);
                                                $facture->insert();
                                                $id_facture_juste_insered = FactureModel::getLastFacture();
                                                $reservation = new ReservationModel($id_user,$id_service,$id_facture_juste_insered,$date_res);
                                                $reservation->addReservation();
                                                unset($_SESSION['estim_exists']);
                                                unset($_SESSION['estim_error']);
                                                unset($_SESSION['service_prix_total']);
                                                unset($_SESSION['estim_prix_total']);
                                                echo "Réservation enregistré";
                                                exit(0);
                                            }else{
                                                // error
                                                echo "L'un des champes est invalide";
                                                exit(0);
                                            }
                                        }else{
                                            // prix basique
                                            $total_prix = $_SESSION['service_prix_total'];
                                            $facture = new FactureModel($date_res,$total_prix);
                                            $facture->insert();
                                            $id_facture_juste_insered = FactureModel::getLastFacture();
    
                                            $reservation = new ReservationModel($id_user,$id_service,$id_facture_juste_insered,$date_res);
                                            $reservation->addReservation();
                                            echo "tarif_base";
                                            $_SESSION['service_prix_total'];
                                            exit(0);
                                        }
                                    }
                                
                                $this->_view();
                            }
                        }

                    }else{
                        header('Location: /offres/list');
                        exit(0);
                    }
                    
                }else{
                    header('Location: /admin');
                    exit(0); // for sec reasons
                }
                
            }else{
                header('Location: /index/login');
                exit(0);
            }
            
        }
    }
?>