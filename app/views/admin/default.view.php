<?php

use AGENCE_VOYAGE\MODELS\AdminModel;
use AGENCE_VOYAGE\MODELS\HotelModel;
use AGENCE_VOYAGE\MODELS\ServiceModel;
use AGENCE_VOYAGE\MODELS\TransportModel;
use AGENCE_VOYAGE\MODELS\ProposerModel;
use AGENCE_VOYAGE\MODELS\AvoirModel;
use AGENCE_VOYAGE\MODELS\ChauffeurModel;
use AGENCE_VOYAGE\MODELS\ContactModel;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="<?=FONTS_PATH_ADMIN?>source.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= PLUGINS_PATH_ADMIN?>fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= FONTS_PATH_ADMIN?>ionicons.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= PLUGINS_PATH_ADMIN?>tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= PLUGINS_PATH_ADMIN?>icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= PLUGINS_PATH_ADMIN?>jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= CSS_PATH_ADMIN?>adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= PLUGINS_PATH_ADMIN?>overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= PLUGINS_PATH_ADMIN?>daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= PLUGINS_PATH_ADMIN?>summernote/summernote-bs4.min.css">
  <!-- Data Table -->
  <link rel="stylesheet" href="<?= PLUGINS_PATH_ADMIN?>datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= PLUGINS_PATH_ADMIN?>datatables-responsive/css/dataTables.bootstrap4.min.css">
  <style>
   .checked{ background-color: orange;}
  </style>
</head>
<body class="layout-fixed sidebar-collapse">
<div class="wrapper">

   <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= IMAGES_PATH?>logo.png" alt="Lejdar_logo" height="120" width="120">
  </div>
  

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
    <!--
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      -->
      <li class="nav-item d-none d-sm-inline-block">
        <div class="row">
          <img src="<?= IMAGES_PATH?>facebook.png" class="round mt-1 ml-2" height="32" width="32">
          <p class="mt-2 ml-2">Bienvenue, <b><?= AdminModel::getAllFromUser($_SESSION['admin_id'])->USER_ADMIN?></b></p>
          <a href="/admin/logout" class="mt-2 ml-2"><i class="fas fa-sign-out-alt"></i></a>
        </div>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-center text-bold">Tableau de bord</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>Réservation</p>
              </div>
              <div class="icon">
                <i class="fas fa-suitcase-rolling"></i>
              </div>
              <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= AdminModel::countFrom('ID_C','CLIENT')?></h3>

                <p>Utilisateurs</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>150 DA</h3>

                <p>Revenu</p>
              </div>
              <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
              </div>
              <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  <div class="container-fluid">
    <!-- List des utilisateurs -->
    <div class="card">
              <div class="card-header">
              <i class="fas fa-users"> </i> Liste des Utilisateurs
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="users" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Adresse</th>
                <th>Téléphone</th>
                <th>Num passeport</th>
            </tr>
        </thead>
        <tbody>
          <?php $list = AdminModel::getUsersList(); if (!empty($list) > 0) foreach($list as $user => $data):?>
            <tr>
                <td><?=$data->ID_C?></td>
                <td><?=$data->NOMC?></td>
                <td><?=$data->PRENOMC?></td>
                <td><?=$data->DATE_DE_NAISSANCE?></td>
                <td><?=$data->ADRESSEC?></td>
                <td><?=$data->TELEPHONEC?></td>
                <td><?=$data->NUM_PASSEPORT?></td>
            </tr>
          <?php endforeach;?>
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Adresse</th>
                <th>Téléphone</th>
                <th>Num passeport</th>
            </tr>
        </tfoot>
    </table>
              <!-- /.card-body -->
            </div>
  </div>

    <!-- List des Messages -->
    <div class="card">
              <div class="card-header">
              <i class="fas fa-envelope"></i> Liste des Messages
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="messages" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Email</th>
                <th>Sujet</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
          <?php $list = ContactModel::getAllContact(); if (!empty($list) > 0) foreach($list as $message => $data):?>
            <tr>
                <td><a href="mailto:<?=$data->EMAIL?>"><?=$data->EMAIL?></a></td>
                <td><?=$data->SUJET?></td>
                <td><?=$data->MSG?></td>

            </tr>
          <?php endforeach;?>
        </tbody>
        <tfoot>
            <tr>
                <th>Email</th>
                <th>Sujet</th>
                <th>Message</th>
            </tr>
        </tfoot>
    </table>
              <!-- /.card-body -->
            </div>
  </div>


    <!-- List des CHAUFFEURS -->
    <div class="card">
              <div class="card-header">
              <i class="fas fa-envelope"></i> Liste des Chauffeurs
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="messages" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Téléphone</th>
                <th>Disponibilité</th>
            </tr>
        </thead>
        <tbody>
          <?php $chauffeurs = ChauffeurModel::getAllChauffeur(); if (!empty($chauffeurs)) foreach($chauffeurs as $chauffeur => $data):?>
            <tr>
                <td><?= $data->NOM?></td>
                <td><?=$data->PRENOM?></td>
                <td><?=$data->TEL_CH?></td>
                <td><?php if($data->STATUS_CH === "disponible") echo "<span style=\"font-size: 15px;\" class=\"badge badge-success\">Disponible</span>"; else echo "<span style=\"font-size: 15px;\" class=\"badge badge-danger\">Indisponible</span>";?></td>

            </tr>
          <?php endforeach;?>
        </tbody>
        <tfoot>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Téléphone</th>
                <th>Disponibilité</th>
            </tr>
        </tfoot>
    </table>
              <!-- /.card-body -->
            </div>
  </div>

  <!-- List des réservations -->
  <div class="card">
              <div class="card-header">
                <i class="fas fa-file-alt"></i> List des Réservations
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="Reservations" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Offre</th>
                <th>Nom client</th>
                <th>Prenom client</th>
                <th>Type service</th>
                <th>Date réservation</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $reservations = AdminModel::getServiceReserved(); if(empty($reservations)):?>
          <tr>
            <?= "Pas de réservation pour le moment" ?>
          </tr>
        <?php else: ?>
          <?php foreach($reservations as $reservation):?>
            <tr> 

              <?php
                                                if($reservation->STATUS === "valider"){
                                                  $etat = "badge badge-success";
                                              }elseif($reservation->STATUS === "refuser"){
                                                  $etat = "badge badge-danger";
                                              }elseif($reservation->STATUS === "en attente"){
                                                  $etat = "badge badge-warning";
                                              }else{
                                                  $etat = "badge badge-secondary";
                                              }
              ?>
                <td><?= $reservation->TITRE?></td>
                <td><?= $reservation->NOMC?></td>
                <td><?= $reservation->PRENOMC?></td>
                <td><?= $reservation->TYPE_V?></td>
                <td><?= $reservation->DATE_RES?></td>
                <td><span style="font-size: 15px" class="<?= $etat?>"><?= $reservation->STATUS?></span></td>
                <td>
                <div class="row">
                  <div class="col-md-6 col-12 col-sm-12 col-lg-6">
                    <button style="font-size: 15px" class="btn btn-danger" id="res_ref_action<?= $reservation->ID_SERVICE?>" value="del<?= $reservation->ID_SERVICE?>">Refuser</button>
                  </div>
                  <div class="col-md-6 col-12 col-sm-12 col-lg-6">
                  <button style="font-size: 15px" class="btn btn-success" id="res_acc_action<?= $reservation->ID_SERVICE?>" value="acc<?= $reservation->ID_SERVICE?>">Accepter</button>
                  </div>
                </div>
                </td>
                
            </tr>
          <?php endforeach;?>
        <?php endif;?>
        </tbody>
        <tfoot>
            <tr>
                <th>Offre</th>
                <th>Nom client</th>
                <th>Prenom client</th>
                <th>Type service</th>
                <th>Date réservation</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
              <!-- /.card-body -->
    </div>
  </div>

      <!-- List des offres -->
      <div class="card">
              <div class="card-header">
              <i class="fas fa-users"> </i> Liste des Offres
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="offres" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Titre</th>
                <th>Prix</th>
                <th>Compagnie</th>
                <th>Hôtel</th>
                <th>Type voyage</th>
                <th>Place max</th>
                <th>Place réserver</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
          <?php $offres = ServiceModel::getAllServices(); if(!empty($offres)) foreach($offres as $offre): ?>
            <tr id="id_item<?= $offre->ID_SERVICE?>">
                <td><?= $offre->ID_SERVICE?></td>
                <td> <img src="<?= $offre->IMG_S?>" alt="image" height="60" width="60"></td>
                <td><?= $offre->TITRE?></td>
                <td><?= $offre->TARIF?></td>
                <td><?php $avoir = AvoirModel::getTransportInService($offre->ID_SERVICE); if(!empty($avoir)) echo $avoir;?></td>
                <td><?php $proposer = ProposerModel::getHotelInService($offre->ID_SERVICE); if (!empty($proposer)) echo $proposer;?></td>
                <td><?= $offre->TYPE_V?></td>
                <td><?= $offre->NBR_M?></td>
                <td>pas encore</td>
                <td><?= $offre->DESCRIPTION?></td>
                <td>
                  <div class="row">
                    <div class="col-6">
                    <a href="#" data-toggle="modal" data-target="#modifModal<?= $offre->ID_SERVICE?>"><i style="font-size: 35px;" class="fas fa-pen-square"></i></a>
                    </div>
                    <div class="col-6">
                    <a href="#" data-toggle="modal" data-target="#suppModal<?= $offre->ID_SERVICE?>"><i style="font-size: 30px;" class="fas fa-trash text-danger"></i></a>
                    </div>
                  </div>
                </td>
            </tr>
                    <!-- modifié Modal -->
                    <div class="modal fade" id="modifModal<?= $offre->ID_SERVICE?>" tabindex="-1" role="dialog" aria-labelledby="modifModalTitle<?= $offre->ID_SERVICE?>" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Mettre à jour</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            ...
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- suppression Modal -->
                    <div class="modal fade" id="suppModal<?= $offre->ID_SERVICE?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Suppression</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Voulez vous vraiment supprimer l'annonce ?</p>
                        </div>
                        <div class="modal-footer">
                        <?php if(empty($avoir) && empty($proposer)):?>
                          <button type="button" onclick="suppItemOffre(<?= $offre->ID_SERVICE?>)" class="btn btn-danger">Supprimer</button>
                        <?php else: ?>
                          <button type="button" onclick="suppItemFullOffre(<?= $offre->ID_SERVICE?>)" class="btn btn-danger">Supprimer</button>
                        <?php endif; ?>
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                        </div>
                      </div>
                    </div>
                  </div>
            <?php endforeach;?>
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Titre</th>
                <th>Prix</th>
                <th>Compagnie</th>
                <th>Hôtel</th>
                <th>Type voyage</th>
                <th>Place réserver</th>
                <th>Place max</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
              <!-- /.card-body -->
            </div>
  </div>

  <!-- bare d'actualité -->
    <div class="row">
      <div class="col-lg-6 col-12 col-sm-12">
        <div class="card">
          <div class="card-header">
            <i class="far fa-newspaper"></i> Bare d'actualité
          </div>
          <div class="card-body">
            <form method="POST">
            <label for="actbar">Promo du jour</label>
              <textarea name="actbar" id="actbar" cols="71" rows="3" class="form-control" placeholder="Votre actualité à afficher"></textarea>
              <div class="d-flex justify-content-center mt-2">
                <input type="submit" name="submit_promo" id="submit_promo" class="btn btn-primary" value="Sauvgarder">
              </div>  
            </form>
          </div>
        </div>
          <!-- Gallerie photo  upload-->
        <div>
          <div class="card">
              <div class="card-header">
              <i class="far fa-images"></i> Gestion Gallerie
              </div>
              <div class="card-body">
              <form method="POST" enctype="multipart/form-data">
                  <label for="gallerie-image"></label>
                  <input type="file" name="gallerie-image" id="gallerie-image" class="form-control-file">
                  <div class="d-flex justify-content-center mt-2">
                    <input type="submit" name="submit_gallerie" id="submit_gallerie" value="Téléverser" class="btn btn-primary">
                  </div>
              </form>
              </div>
          </div>
        </div>

        <!-- Ajouter Hôtel -->
        <div class="card">
              <div class="card-header">
              <i class="fas fa-hotel"></i> Ajouter hôtel
              </div>
              <div class="card-body">
                <form method="POST">
                  <div class="row">
                    <div class="col-md-6 col-12 col-lg-6 col-sm-6">
                      <label for="h_nom">Nom de l'hôtel</label>
                      <input type="text" name="h_nom" id="h_nom" class="form-control" placeholder="Nom Hôtel">
                    </div>
                    <div class="col-md-6 col-12 col-lg-6 col-sm-6">
                      <label for="h_etoile">Etoile</label>
                      <select name="h_etoile" id="h_etoile" class="form-control">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                      </select>
                    </div>
                  </div>
                  <label for="h_ville">Ville de l'hôtel</label>
                  <input type="text" name="h_ville" id="h_ville" class="form-control"placeholder="Ville">
                  <label for="h_nbr_chambre">Nombre de chambre</label>
                  <input type="number" min="1" name="h_nbr_chambre" id="h_nbr_chambre" class="form-control"placeholder="Nombre de chambre">
                  <div class="d-flex justify-content-center mt-2">
                    <input type="submit" name="submit_hotel" id="submit_hotel" value="Ajouter" class="btn btn-primary">
                  </div>
                </form>
              </div>
          </div>

        <!-- ajouter une chambre pour un hotel -->
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-6">
                <i class="far fa-edit"></i> Ajouter une chambre
              </div>
              <div class="col-md-6">
                <div class="d-flex justify-content-end">
                  <span style="font-size:15px;" class="badge badge-info"><span id="chambre_occup">0</span>/<span id="chambre_max">0</span></span>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form method="POST">
              <div class="row">
              <div class="col-md-6 col-12 col-sm-12">
                  <label for="chambre_hotel">Hôtel</label>
                    <select name="chambre_hotel" id="chambre_hotel" class="form-control">
                    <?php $hotels = HotelModel::getAllHotels(); if (empty($hotels)):?>
                      <option value="0">Aucun hôtel pour le moment</option>
                    <?php else: ?>
                      <option value="0" selected disabled>Séléctionnez un hôtel</option>
                      <?php foreach($hotels as $hotel):?>  
                        <option value="<?= $hotel->ID_H?>"><?= $hotel->NOMH . " (" . $hotel->VILLEH .")"?></option>
                      <?php endforeach;?>
                    <?php endif;?>
                    </select>
                </div>
                <div class="col-lg-6">
                  <label for="chambre_type">Type de chambre</label>
                  <select name="chambre_type" id="chambre_type" class="form-control">
                      <option value="simple">Simple</option>
                      <option value="double">Double</option>
                      <option value="triple">Triple</option>
                      <option value="suite">Suite</option>
                  </select>
                </div>

                <div class="col-12 col-md-12">
                  <label for="chambre_prix" class="mt-2">Prix</label>
                  <input type="number" min="1" name="chambre_prix" id="chambre_prix" class="form-control">
                </div>
              </div>
              <div class="d-flex justify-content-center mt-2">
                  <input type="submit" name="submit_chambre" id="submit_chambre" value="Ajouter" class="btn btn-primary">
                </div>
            </form>
          </div>
        </div>
        <!-- fin ajouter une chambre -->
      </div>
      <div class="col-lg-6 col-12 col-sm-12">
        <!-- Ajouter un service -->
        <div class="card">
          <div class="card-header">
          <i class="far fa-edit"></i> Ajouter un service
          </div>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-lg-6">
                  <label for="titre">Titre</label>
                  <input type="text" name="titre" id="titre" class="form-control" placeholder="Titre de l'offre">
                </div>
                <div class="col-lg-6">
                  <label for="image">Image</label>
                  <input type="file" name="image" id="image" class="form-control-file">
                </div>
                <div class="col-lg-6">
                  <label for="prix">Prix</label>
                  <input type="number" name="prix" id="prix" min="1" class="form-control">
                </div>
                <div class="col-lg-6">
                  <label for="type">Type de voyage</label>
                  <select name="type" id="type" class="form-control">
                    <option value="0" selected disabled>Séléctionner le type</option>
                    <option value="hadj">Hadj</option>
                    <option value="omra">Omra</option>
                    <option value="organise">Organisé</option>
                    <option value="personnalise">Personnalisé</option>
                  </select>
                </div>
                <div class="col-lg-6">
                  <label for="plmax" id="lb_plmax">Places max</label>
                  <input type="number" name="plmax" id="plmax" min="1" class="form-control">
                </div>
                <div class="col-lg-6">
                  <label for="hotel" id="lb_hotel">Hôtel</label>
                  <select name="hotel" id="hotel" class="form-control">
                    <option value="0" selected disabled>Séléctionner l'hôtel</option>
                    <?php $hotels = HotelModel::getAllHotels(); if(empty($hotels)) $error = "Aucun hotel pour le moment"; else foreach($hotels as $hotel):?>
                    <option value="<?=$hotel->ID_H?>"><?= $hotel->NOMH . " ( " . $hotel->VILLEH . " )" ?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="col-lg-6">
                  <label for="type_trans" id="lb_type_trans">Type de transport</label>
                  <select name="type_trans" id="type_trans" class="form-control">
                    <option value="0" selected disabled>Séléctionner le type de transport</option>
                    <?php $trans = TransportModel::getAllTransports(); if (empty($trans)) $error = "Aucun transport pour le moment"; else foreach($trans as $tran):?>
                    <option value="<?= $tran->ID_TRANSPORT?>"><?= $tran->TYPE_T . " ( " . $tran->NOM_COMPAGNIE . " )"?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                <!--<div class="col-lg-6">
                  <label for="hotel" id="hotel">Hôtel</label>
                  <select name="hotel" id="hotel" class="form-control">
                    <option value="0" selected disabled>Séléctionner l'hôtel</option>
                    <option value="hotel1">hotel1</option>
                  </select>
                </div>-->
              </div>
              
              <label for="desc">Description</label>
              <textarea name="desc" id="desc" cols="71" rows="3" placeholder="Description de l'offre" class="form-control"></textarea>
              <div class="d-flex justify-content-center">
                <input type="submit" name="submit" id="submit" class="btn btn-primary mt-2" value="Ajouter">
              </div>
              <?php if (!empty($image_errors)):?>
              <?php if (count($image_errors) > 0) : ?>
                <div class="alert alert-danger mt-2" role="alert">
                    <?php foreach($image_errors as $err):?>
                      <p><?= $err ?></p>
                    <?php endforeach;?>
                </div>
              <?php endif; ?>
              <?php endif;?>
            </form>
          </div>
        </div>
        <!-- Ajouter un moyen de transport avec tous les détailles -->
        <div class="card">
              <div class="card-header">
              <i class="fas fa-car-side"></i> Ajouter Transport
              </div>
              <div class="card-body">
              <form method="POST">
                  <div class="row">
                    <div class="col-md-6 col-12 col-sm-12">
                      <label for="trans_type">Séléctionez type de transport</label> 
                      <select name="trans_type" id="trans_type" class="form-control">
                        <option value="bus">Bus</option>
                        <option value="avion">Avion</option>
                      </select>
                    </div>
                    <div class="col-md-6 col-12 col-sm-12">
                      <label for="trans_nom_compagnie">Nom compagnie</label> 
                      <input type="text" name="trans_nom_compagnie" id="trans_nom_compagnie" class="form-control">
                    </div>
                    <!-- BUS informations section -->
                    <div class="col-md-6 col-12 col-sm-12">
                      <label for="trans_nbr_place">Nombre de place</label> 
                      <input type="number" min="1" name="trans_nbr_place" id="trans_nbr_place" class="form-control">
                    </div>
                    <div class="col-md-6 col-12 col-sm-12">
                      <label for="trans_tarif">Tarif</label> 
                      <input type="number" name="trans_tarif" id="trans_tarif" class="form-control">
                    </div>
                    <div class="col-md-6 col-12 col-sm-12">
                      <label for="trans_matricule" id="lbl_trans_matricule">Matricule</label> 
                      <input type="text" name="trans_matricule" id="trans_matricule" class="form-control" placeholder="Ex: xxxxxx-xxx-xx">
                    </div>
                    <div class="col-md-6 col-12 col-sm-12">
                      <label for="trans_chauffeur" id="lbl_trans_chauffeur">Chauffeur</label> 
                      <select name="trans_chauffeur" id="trans_chauffeur" class="form-control">
                      <?php $chauffeurs = ChauffeurModel::getAllChauffeur(); if(empty($chauffeurs)):?>
                        <option value="0" selected disabled>Aucun chauffeur pour le moment</option>
                      <?php else: ?>
                        <?php foreach($chauffeurs as $chauffeur):?>
                          <?php if ($chauffeur->STATUS_CH === "disponible"):?>
                           <option value="<?= $chauffeur->ID_CHAUF?>"><?= $chauffeur->NOM . " " . $chauffeur->PRENOM?></option>
                           <?php else: ?>
                            <option value="0" disabled><?= $chauffeur->NOM . " " . $chauffeur->PRENOM . " (Non disponible)"?></option>
                          <?php endif;?>
                        <?php endforeach;?>
                      <?php endif;?>
                      </select>
                    </div>
                    <div class="col-md-12 col-12 col-sm-12">
                      <label for="trans_num_vol" id="lbl_trans_num_vol">Numéro de vol</label> 
                      <input type="text" name="trans_num_vol" id="trans_num_vol" class="form-control" placeholder="Numéro de vol">
                    </div>
                    <div class="col-md-6 col-12 col-sm-12">
                      <label for="trans_date_dept" id="lbl_trans_date_dept">Date de départ</label> 
                      <input type="date" name="trans_date_dept" id="trans_date_dept" class="form-control">
                    </div>
                    <div class="col-md-6 col-12 col-sm-12">
                      <label for="trans_date_rtr" id="lbl_trans_date_rtr">Date de retour</label> 
                      <input type="date" name="trans_date_rtr" id="trans_date_rtr" class="form-control">
                    </div>
                  </div>
                  <div class="d-flex justify-content-center">
                      <input type="submit" name="trans_submit" id="trans_submit" class="btn btn-primary mt-2" value="Ajouter">
                  </div>
              </form>
              </div>
          </div>
          <div class="card">
              <div class="card-header">
              <i class="fas fa-bus"></i> &nbsp; Ajouter un chauffeur
              </div>
              <div class="card-body">
              <form method="POST">
                  <div class="row">
                      <div class="col-md-6 col-12 col-sm-12 col-lg-6">
                        <label for="chauf_nom">Nom du chauffeur</label>
                        <input type="text" name="chauf_nom" id="chauf_nom" class="form-control" placeholder="Nom">
                      </div>
                      <div class="col-md-6 col-12 col-sm-12 col-lg-6">
                        <label for="chauf_prenom">Prénom du chauffeur</label>
                        <input type="text" name="chauf_prenom" id="chauf_prenom" class="form-control" placeholder="Prénom">
                      </div>
                  </div>
                  <label for="chauf_Num" class="mt-2">Numéro du chauffeur</label>
                  <input type="text" name="chauf_Num" id="chauf_Num" class="form-control" placeholder="Numéro de téléphone">
                  <div class="d-flex justify-content-center mt-2">
                    <input type="submit" name="submit_chauf" id="submit_chauf" value="Ajouter" class="btn btn-primary">
                  </div>
              </form>
              </div>
          </div>
      </div>
    </div>
  </div>
  <!-- Fin container fluid -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= PLUGINS_PATH_ADMIN?>jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= PLUGINS_PATH_ADMIN?>jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= PLUGINS_PATH_ADMIN?>bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= PLUGINS_PATH_ADMIN?>chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= PLUGINS_PATH_ADMIN?>sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= PLUGINS_PATH_ADMIN?>jqvmap/jquery.vmap.min.js"></script>
<script src="<?= PLUGINS_PATH_ADMIN?>jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= PLUGINS_PATH_ADMIN?>jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= PLUGINS_PATH_ADMIN?>moment/moment.min.js"></script>
<script src="<?= PLUGINS_PATH_ADMIN?>daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= PLUGINS_PATH_ADMIN?>tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= PLUGINS_PATH_ADMIN?>summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= PLUGINS_PATH_ADMIN?>overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= JS_PATH_ADMIN?>adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= JS_PATH_ADMIN?>demo.js"></script>

<!-- Data Tables -->
<script src="<?= PLUGINS_PATH_ADMIN?>datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= PLUGINS_PATH_ADMIN?>datatables/Dtjquery.js"></script>
<script src="<?= PLUGINS_PATH_ADMIN?>datatables/newDatatables.min.js"></script>

<!-- Main js -->
<script src="<?=JS_PATH?>admin.js"></script>


<!-- table Users -->
<script>
$(document).ready(function() {
    $('#users').DataTable();
} );
</script>

<!-- table réservations -->
<script>
$(document).ready(function() {
    $('#Reservations').DataTable();
} );
</script>

<!-- table Offres -->
<script>
$(document).ready(function() {
    $('#offres').DataTable();
} );
</script>

<!-- table Messages -->
<script>
$(document).ready(function() {
    $('#messages').DataTable();
} );
</script>

<!-- suppItemOffre function : delete offer item from the liste  -->
<script> 
  function suppItemOffre(id){
    var target = $("table#offres tr#id_item"+id+" td")
    console.log(target);
    $.ajax({
        method: "POST",
        url: "/admin",
        data: {del_service_submit: 'submit', id_service: id},
        success: function(data){
          console.log("request sended");
          alert(data);
          target.remove();
        },

        error : function(err){
          console.log('Erreur dans le serveur');
        }


        
    });
  }
</script>

<!-- suppItemFullOffre function : delete offer item from the liste  -->
<script> 
  function suppItemFullOffre(id){
    var target = $("table#offres tr#id_item"+id+" td")
    console.log(target);
    $.ajax({
        method: "POST",
        url: "/admin",
        data: {del_service_submit: 'full_submit', id_service: id},
        success: function(data){
          console.log("request sended");
          alert(data);
          target.remove();
        },

        error : function(err){
          console.log('Erreur dans le serveur');
        }


        
    });
  }
</script>

<script>
  $(document).ready(function(){
    $("#res_ref_action8").click(function(){
      alert($("#res_ref_action8").val());
    });


    $("#res_acc_action8").click(function(){
      alert($("#res_acc_action8").val());
    });
  });
</script>
</body>
</html>
