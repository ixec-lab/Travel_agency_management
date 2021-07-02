<?php
    use AGENCE_VOYAGE\MODELS\ReservationModel;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Yacine Mahi">
    <link rel="stylesheet" href="<?= FONT_PATH?>css/all.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>nice-select.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>slick.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>slicknav.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>bs-user-profile.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>user-profile.css">


    <title>My Profile</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card-box text-center">
                    <img src="<?php if ($sexe === "H") echo IMAGES_PATH."man.png"; else echo IMAGES_PATH."woman.png"?>" class="rounded-circle avatar-xl img-thumbnail" alt="profile-image">

                    <h4 class="mb-0" id="profile-nom"><?= $nom ?></h4> <h4 class="mb-0" id="profile-prenom"><?= $prenom?></h4>
                    <p class="text-muted"><?= "@" . $username?></p>

                    <a class="btn btn-success btn-xs waves-effect mb-2 waves-light" href="/index">Acceuil</a>
                    <a class="btn btn-danger btn-xs waves-effect mb-2 waves-light" href="/index/logout"><i class="fas fa-sign-out-alt"></i></a>

                    
                    <div class="text-left mt-3">
                    <?php if (!empty($bio)):?>
                        <h4 class="font-13 text-uppercase" id="apropos">A propos :</h4>
                        <p class="text-muted font-13 mb-3" id="profile-side-bio">
                            <?= $bio?>
                        </p>
                    <?php endif;?>
                        <p class="text-muted mb-2 font-13"><strong>Nom :</strong> <span class="ml-2" id="profile-side-nom"><?= $nom?></span></p>
                        <p class="text-muted mb-2 font-13"><strong>Prénom :</strong> <span class="ml-2" id="profile-side-prenom"><?= $prenom?></span>
                        </p>

                        <p class="text-muted mb-2 font-13"><strong>Tel :</strong><span class="ml-2" id="profile-side-tel"><?= $tel?></span></p>

                        <p class="text-muted mb-2 font-13"><strong>E-mail :</strong> <span
                                class="ml-2 " id ="profile-side-email"><?= $email?></span></p>

                        <p class="text-muted mb-1 font-13"><strong>Localisation :</strong> <span class="ml-2">DZ</span>
                        </p>
                    </div>
                        
                </div> <!-- end card-box -->

            </div> <!-- end col-->

            <div class="col-lg-8 col-xl-8">
                <div class="card-box">
                    <ul class="nav nav-pills navtab-bg">
                        <li class="nav-item">
                            <a href="#about-me" data-toggle="tab" aria-expanded="true" class="nav-link ml-0 active">
                                <i class="fas fa-user"></i> Mes Informations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="fas fa-user-cog"></i> Modification
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane show active" id="about-me">

                        <h5 class="mb-3 mt-4 text-uppercase"><i class="fas fa-hotel"></i>
                                Reservation D'Hotel </h5>
                            <div class="table-responsive">
                                <table class="table  table-hover mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Hotel</th>
                                            <th>Ville</th>
                                            <th>Étoile</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $hotels = ReservationModel::getReservedHotelByClient($_SESSION['id']); if(empty($hotels)) echo "pas de réservation pour le moment"; else foreach($hotels as $hotel):?>
                                        <tr>
                                            <td><?= $hotel->NOMH?></td>
                                            <td><?= $hotel->VILLEH?></td>
                                            <td><span class="fa fa-star checked"> <?= $hotel->ETOILE?></span> </td>
                                            <?php 
                                                if(ReservationModel::getReservationByClient($_SESSION['id'])->STATUS === "valider"){
                                                    $etat = "badge badge-success";
                                                }elseif(ReservationModel::getReservationByClient($_SESSION['id'])->STATUS === "refuser"){
                                                    $etat = "badge badge-danger";
                                                }elseif(ReservationModel::getReservationByClient($_SESSION['id'])->STATUS === "en attente"){
                                                    $etat = "badge badge-warning";
                                                }else{
                                                    $etat = "badge badge-secondary";
                                                }
                                            ?>
                                            <td><span style="font-size: 15px" class="<?= $etat?>"><?= ReservationModel::getReservationByClient($_SESSION['id'])->STATUS ?></span></td>

                                        </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        <hr>
                        <h5 class="mb-3 mt-4 text-uppercase"><i class="fas fa-bus"></i>
                                Reservation de bus </h5>
                            <div class="  table-responsive table-hover">
                                <table class="table  mb-0">
                                    <thead class="thead-light">
                                    <?php 
                                        $buss = ReservationModel::getReservedBusByClient($_SESSION['id']); 
                                    ?>
                                        <tr>
                                            <th>Matricule bus</th>
                                            <th>Date départ</th>
                                            <th>Date retour</th>
                                            <th>Chauffeur</th>
                                            <th>Compagnie</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tbody> 

                                    <?php if(!empty($buss)):?>
                                        <?php foreach($buss as $bus):?>
                                            <tr>
                                                <td><?= $bus->MATRICULE_B?></td>
                                                <td><?= $bus->DATE_DEP?></td>
                                                <td><?= $bus->DATE_RET?></td>
                                                <td><?= $bus->NOM . ' ' . $bus->PRENOM?></td>
                                                <td><?= $bus->NOM_COMPAGNIE?></td>
                                                <td><span style="font-size:15px;" class="<?= $etat?>"><?= ReservationModel::getReservationByClient($_SESSION['id'])->STATUS?></span></td>
                                            </tr>
                                        <?php endforeach;?>
                                    <?php endif?>

                                    </tbody>
                                </table>
                            </div>
                        <hr>
                            <h5 class="mb-3 mt-4 text-uppercase"><i class="fas fa-plane-departure"></i>
                                Reservation de Vol </h5>
                            <div class="  table-responsive table-hover">
                                <table class="table  mb-0">
                                    <thead class="thead-light">
                                    <?php 
                                        $vols = ReservationModel::getReservedVolByClient($_SESSION['id']); 
                                    ?>
                                        <tr>
                                            <th>Numéro de vol</th>
                                            <th>Ville d'arrivée</th>
                                            <th>Date départ</th>
                                            <th>Date retour</th>
                                            <th>Compagnie</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tbody> 

                                    <?php if(!empty($vols)):?>
                                        <?php foreach($vols as $vol):?>
                                            <tr>
                                                <td><?= $vol->NUM_VOL?></td>
                                                <td>Alger</td>
                                                <td><?= $vol->DATE_ALLER?></td>
                                                <td><?= $vol->DATE_RETOUR?></td>
                                                <td><?= $vol->NOM_COMPAGNIE?></td>
                                                <td><span style="font-size:15px;" class="<?= $etat?>"><?= ReservationModel::getReservationByClient($_SESSION['id'])->STATUS?></span></td>
                                            </tr>
                                        <?php endforeach;?>
                                    <?php endif?>

                                    </tbody>
                                </table>
                            </div>
                            <hr>
 
                            <!-- <h5 class="mb-4 text-uppercase mt-4"><i class="fas fa-suitcase-rolling"></i>
                                Mes Voyages</h5> -->

                            <!-- <ul class="list-unstyled timeline-sm">
                                <li class="timeline-sm-item">
                                    <span class="timeline-sm-date">2015 - 05</span>
                                    <h5 class="mt-0 mb-1">Tunise</h5>
                                    <p>Sousse</p>
                                    <p class="text-muted mt-2"> Hotel :***********************************</p>

                                </li>
                                <li class="timeline-sm-item">
                                    <span class="timeline-sm-date">2012 - 12</span>
                                    <h5 class="mt-0 mb-1">France</h5>
                                    <p>Paris</p>
                                    <p class="text-muted mt-2">Hotel :**********************************</p>
                                </li>
                                <li class="timeline-sm-item">
                                    <span class="timeline-sm-date">2010 - 08</span>
                                    <h5 class="mt-0 mb-1">Thailand</h5>
                                    <p>Pataya</p>
                                    <p class="text-muted mt-2 mb-0">Hotel : *****************************</p>
                                </li>
                            </ul> -->

                        </div>
                        <!-- end timeline content-->

                        <div class="tab-pane" id="settings">
                            <form method="POST">
                                <h5 class="mb-3 text-uppercase bg-light p-2"><i class="fas fa-id-card"></i> Information Personnelle</h5>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nom">Nom </label>
                                            <input type="text" class="form-control" id="nom" name="nom"
                                                placeholder="Entrez votre nom" value="<?= $nom?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prenom">Prénom </label>
                                            <input type="text" class="form-control" id="prenom" name="prenom"
                                                placeholder="Entrez votre prenom" value="<?= $prenom?>">
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="userbio">Bio</label>
                                            <textarea class="form-control" id="bio" name="bio" rows="4"
                                                placeholder="Ecrivez qlq chose..."><?php if (!empty($bio)) echo $bio;?></textarea>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tel">Téléphone </label>
                                            <input type="text" class="form-control" id="tel" name="tel"
                                                placeholder="Entrer votre téléphone" value="<?= $tel?>">
                                            <span class="form-text text-muted"><small>Si vous voulez changer votre email <a href="#" data-toggle="modal"
                                                        data-target="#emailmodel">cliquez</a> ici.</small></span>
                                        </div>
                                        <!-- Modal -->
                                        <div class="container">
                                            <div class="modal fade" id="emailmodel" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <!-- Modal-Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Modification de l'email</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                           
                                                        </div>
                                                        <!-- Modal-body -->
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <h5 class="mb-3">Veillez Entrer vos informations :</h5>
                                                                <input type="email" class="form-control mb-3" id="old-email" name="old-email" placeholder="Entrez votre ancien email">
                                                                <input type="email" class="form-control mb-3" id="new-email" name="new-email" placeholder="Entrer votre nouveau email">
                                                                <input type="password" class="form-control" id="econfpassword" name="econfpassword" placeholder="Entrer votre mot de passe">
                                                               
                                                            </div>
                                                        </div>
                                                        <!-- Modal-Footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="update_email" name="update_email" value="save_email">Sauvegarder</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Mot de passe</label>
                                            <input type="password" class="form-control" id="validate_password" name="validate_password"
                                                placeholder="Entrer votre mot de passe">

                                            <span class="form-text text-muted"><small>Si vous voulez changer votre mot de passe <a href="#" data-toggle="modal" data-target="#pwModal">cliquez</a> ici.</small></span>

                                        </div>
                                         <!-- Modal -->
                                         <div class="container">
                                            <div class="modal fade" id="pwModal" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Modification du Mot De Passe</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                           
                                                        </div>
                                                        <!-- Modal-body -->
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <h5 class="mb-3">Veillez Entrer vos informations :</h5>
                                                                <input type="password" class="form-control mb-3" id="old-password" name="old-passwod" placeholder="Entrez votre ancien mot de passe">
                                                                <input type="password" class="form-control mb-3" id="new-password" name="new-password" placeholder="Entrez votre nouveau mot de passe">
                                                                <input type="password" class="form-control" id="cnewpassword" name="cnewpassword" placeholder="Confirmez votre nouveau mot de passe">
                                                               
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div  >
                                                                <p class="mr-5 pr-5"  >Changer votre mot de passe </p>
                                                            </div>
                                                           
                                                            <span>
                                                               
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" id="update_password" name="update_password" value="save_password">Valider</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="text-right">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2" id="change_base_infos" name="change_base_infos" value="save_infos"><i class="fas fa-save"></i> Save</button>
                                </div>
                            </form>
                        </div>
                        <!-- end settings content-->

                    </div> <!-- end tab-content -->
                </div> <!-- end card-box-->

            </div> <!-- end col -->

        </div>
    </div>

    <script src="<?= JS_PATH?>jquery.min.js"></script>
    <script src="<?= JS_PATH?>popper.js"></script>
    <script src="<?= JS_PATH?>bs-user-profile.js"></script>
    <script src="<?= JS_PATH?>user_profile.js"></script>
</body>

</html>