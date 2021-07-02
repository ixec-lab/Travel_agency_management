<?php
    namespace AGENCE_VOYAGE\CONTROLLERS;

    use AGENCE_VOYAGE\MODELS\UserModel;

    class ProfileController extends AbstractController{


        public function defaultAction(){

            // redirecte the user to login page if not loged in as user NOT ADMIN
            if (empty($_SESSION)){
                header("Location: /index/login");
                exit(0);
            }

            // get user information for page displaying
            if ($_SESSION['is_admin'] === false){
                $this->_data['nom'] = UserModel::getAllFromUser($_SESSION['id'])->NOMC;
                $this->_data['prenom'] = UserModel::getAllFromUser($_SESSION['id'])->PRENOMC;
                $this->_data['username'] = UserModel::getAllFromUser($_SESSION['id'])->USERC;
                $this->_data['tel'] = UserModel::getAllFromUser($_SESSION['id'])->TELEPHONEC;
                $this->_data['email'] = UserModel::getAllFromUser($_SESSION['id'])->EMAILC;
                $this->_data['sexe'] = UserModel::getAllFromUser($_SESSION['id'])->SEXE;
                $this->_data['bio'] = UserModel::getAllFromUser($_SESSION['id'])->BIOC;

                // Intercept sended data for change_base_infos button
                if (!empty($_POST['change_base_infos'])){
                    extract($_POST);
                    $user = [];

                    if (UserModel::getAllFromUser($_SESSION['id'])->PASSWORDC === md5($password) && !empty($password)){
                        if (!empty($nom)){
                            $nom = ucfirst(htmlentities($nom));
                            UserModel::updateUserBasicInfo($_SESSION['id'],$nom,UserModel::getAllFromUser($_SESSION['id'])->PRENOMC,UserModel::getAllFromUser($_SESSION['id'])->BIOC,UserModel::getAllFromUser($_SESSION['id'])->TELEPHONEC);
                            $user["nom"] = $nom;
                        }

                        if (!empty($prenom)){
                            $prenom = ucfirst(htmlentities($prenom));
                            UserModel::updateUserBasicInfo($_SESSION['id'],UserModel::getAllFromUser($_SESSION['id'])->NOMC,$prenom,UserModel::getAllFromUser($_SESSION['id'])->BIOC,UserModel::getAllFromUser($_SESSION['id'])->TELEPHONEC);
                            $user["prenom"] = $prenom;
                        }

                        if (!empty($bio)){
                            $bio = ucfirst(htmlentities($bio));
                            UserModel::updateUserBasicInfo($_SESSION['id'],UserModel::getAllFromUser($_SESSION['id'])->NOMC,UserModel::getAllFromUser($_SESSION['id'])->PRENOMC,$bio,UserModel::getAllFromUser($_SESSION['id'])->TELEPHONEC);
                            $user["bio"] = $bio;
                        }else{
                            $bio = null;
                            UserModel::updateUserBasicInfo($_SESSION['id'],UserModel::getAllFromUser($_SESSION['id'])->NOMC,UserModel::getAllFromUser($_SESSION['id'])->PRENOMC,$bio,UserModel::getAllFromUser($_SESSION['id'])->TELEPHONEC);
                            $user["bio"] = $bio;
                        }

                        if (!empty($tel)){
                            $tel = htmlentities($tel);
                            if (preg_match("/^(\+)?[0-9]{3}[1-9][0-9]{8}$/im",$tel)){
                                UserModel::updateUserBasicInfo($_SESSION['id'],UserModel::getAllFromUser($_SESSION['id'])->NOMC,UserModel::getAllFromUser($_SESSION['id'])->PRENOMC,UserModel::getAllFromUser($_SESSION['id'])->BIOC,$tel);
                                $user["tel"] = $tel;
                            }
                        }

                        echo json_encode($user);
                        
                    }else{
                        echo "Mot de passe erroné"; // TODO : send data back with json format
                    }

                    // echo json_encode($user);
                    exit(0); // isolate the interface from mini-api response
                }

                // intercept sended data for update_email button
                if(!empty($_POST['update_email'])){
                    extract($_POST);
                    //var_dump($_POST);
                    $user = [];
                    
                    // check if an email was sended

                    $old_email = htmlentities($old_email);
                    $new_email = htmlentities($new_email);
                    
                    if (filter_var($old_email,FILTER_VALIDATE_EMAIL)){
                        if (filter_var($new_email,FILTER_VALIDATE_EMAIL)){
                            if (UserModel::getAllFromUser($_SESSION['id'])->PASSWORDC === md5($passwordc) && !empty($passwordc)){
                                if (UserModel::getAllFromUser($_SESSION['id'])->EMAILC === $old_email && !empty($old_email)){
                                    UserModel::updateUserEmail($_SESSION['id'],$new_email);
                                    $user['email'] = $new_email;
                                    $user['msg'] = "Email mis à jour avec succès";
                                }else{
                                    $user['msg'] = "Email ne correspond pas";
                                }
                            }else{
                                $user['msg'] = "Mot de passe invalide";
                            }
                        }else{
                            $user['msg'] = "Veuillez saisir votre nouveau email";
                        }
                    }else{
                        $user['msg'] = "Veuillez saisir votre email actuel";
                    }

                    echo json_encode($user);
                    exit(0);
                }

                if (!empty($_POST['update_password'])){
                    extract($_POST);
                    $user = [];

                    $old_password = md5(htmlentities($old_password));
                    $new_password = md5(htmlentities($new_password));
                    $cnew_password = md5(htmlentities($cnew_password));

                    if (UserModel::getAllFromUser($_SESSION['id'])->PASSWORDC === $old_password && !empty($old_password)){
                        if ($new_password === $cnew_password){
                            UserModel::updateUserPassword($_SESSION['id'],$new_password);
                            $user['msg'] = "Mot de passe mis à jour avec succès";
                        }else{
                            $user['msg'] = "Mot de passe ne correspond pas avec le nouveau";
                        }
                    }else{
                        $user['msg'] = "Mot de passe ne correspond pas avec nos enregistrements";
                        // disconnect the user when bad password attempt (3 times) -- new function in futur--
                    }

                    echo json_encode($user);
                    exit(0);
                }

                $this->_view();
            }else{
                die("don't try to play with us");
            }
            
        }
    }
?>