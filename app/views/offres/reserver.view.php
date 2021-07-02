<?php

use AGENCE_VOYAGE\MODELS\ProposerModel;
use AGENCE_VOYAGE\MODELS\AvoirModel;
use AGENCE_VOYAGE\MODELS\ChambreModel;
use AGENCE_VOYAGE\MODELS\ServiceModel;
use AGENCE_VOYAGE\MODELS\OffreModel;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Travel Agency">
    <meta name="Author" content="Islem Meghnine">

    <title>Réserver - Lajdar</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= CSS_PATH?>bootstrap.min.css" rel="stylesheet">
    <link href="<?= CSS_PATH?>reserver.css" rel="stylesheet">
    <link href="<?= CSS_PATH?>/alertifycss/alertify.min.css" rel="stylesheet">
    <link href="<?= CSS_PATH?>/alertifycss/themes/default.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= FONT_PATH?>css/all.css">


  </head>

<!-- Header Start-->
<nav class="navbar navbar-expand-lg navbar-light bg-light pb-3 shadow-lg navbar-toped mb-5" id="navbar">
    <div class="container">
      <a style="color:#0776bd;" class="navbar-brand header-text" href="#"><img src="<?= IMAGES_PATH?>logo.webp" width="72" height="72" alt="logo_brand">Lejdar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobile-version-toggel1" aria-controls="mobile-version-toggel1" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mobile-version-toggel1">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/" id="home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/index/default#services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/index/default#offres">Offres</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/gallerie/">Gallerie</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/index/default#contact">Contact</a>
          </li>
        </ul>
                <!-- here -->
                <?php if (empty($_SESSION)):?>
                    <div>
                        <span onclick="openNav()" class="btn btn-outline-dark"><i class="fas fa-user"></i> Connexion / Inscription</span>
                    </div>
                <?php else: ?>
                    <div class="">
                        
                        <div class="dropdown">
                        <button style="background-color: #0674ba;color:white;" class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i style="font-size:25px;color:white;" class="fas fa-user-circle"> </i> <?= $_SESSION['nom'] . " " . $_SESSION['prenom'];?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        
                            <li><a class="dropdown-item" href="/profile"><i class="fas fa-user"> </i> Mon profile</a></li>
                            <li><a class="dropdown-item" href="/index/logout"><i class="fas fa-sign-out-alt"> </i> Déconnexion</a></li>
                        </ul>
                        </div>
                    </div> 

                <?php endif;?>
                <!-- end here -->
      </div>
    </div>
  </nav>
  <!-- Header End -->

  <body class="bg-light">
    <div class="container">
    <?php if($service->TYPE_V === "organise" || $service->TYPE_V === "omra" || $service->TYPE_V === "hadj"): ?>
      <div class="row">
        <div class="col-md-4 order-md-2 mt-5">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="">Tarifs</span>
            <span class="badge bg-primary text-wrap">2</span>
          </h4>
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Chambre</h6>
                <small class="text-muted"><?= $type_chambre?></small>
              </div>
              <span class="text-muted"><?= $tarif_hotel?> DA</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Transport</h6>
                <?php 

                ?>
                <small class="text-muted">Meilleur Menus</small>
              </div>
              <span class="text-muted"><?= $tariftrans?> DA</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Totale (DA)</span>
              <strong id="res_total_prix"><?= $service_prix_total?> DA</strong>
            </li>
          </ul>
        </div>
        <div class="col-md-8 order-md-1 mt-5 bg-form">
          <h4 class="mb-3">Information d'une requête de réservation</h4>
          <form class="needs-validation" novalidate>
            <div class="row">
              <div class="col-md-6 mb-3">
                <h5 class="text-muted">Votre offre : <?= $service->TITRE?></h5>
                <h5 class="text-muted">Hôtel : <?= ProposerModel::getHotelInService($service->ID_SERVICE)?></h5>
                <h5 class="text-muted">Voyage par : <?= AvoirModel::getTypeTransportInService($service->ID_SERVICE)?></h5>
                <h5 class="text-muted">Compangnie : <?= AvoirModel::getTransportInService($service->ID_SERVICE)?></h5>
              </div>
              <div class="col-md-6 mb-3">
                <img src="<?= $service->IMG_S?>" alt="" height="180" width="300" class="img-thumbnail">
              </div>
            </div>
            <div class="mb-3">
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="adlt">Nombre d'adulte ?</label>
                <input type="number" name="reserver_adulte" id="reserver_adulte" min="1" max="5" value="1" class="form-control">
                <div class="invalid-feedback">
                Veuillez saissire le nombre des adultes
              </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="enf_personnes">Nombre d'enfant ?</label>
                <input type="number" name="reserver_enfant" id="reserver_enfant" min="0" step="1" required class="form-control" value="0">
              </div>
              <div class="col-md-4 mb-3">
                <label for="enf_personnes">Nombre de bébé ?</label>
                <input type="number" name="reserver_bb" id="reserver_bb" min="0" step="1" required class="form-control" value="0">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-12 col-sm-12 col-lg-6 mb-3" id="ele_enf">
                <!-- dynamique rendring forms -->
              </div>
            </div>


            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="reservation_condition" name="reservation_condition">
                  <label class="form-check-label" for="reservation_condition">j'accepte toutes les conditions de l'agence Lejdar Travel (<a href="#">Conditions</a>)</label>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
              <button type="submit" class="btn btn-primary btn-lg btn-block" id="reservation_submit" name="reservation_submit" type="submit" disabled>Réserver</button>
              </div>
              <div class="col-md-6">
                <div class="d-flex justify-content-end">
                <button class="btn btn-primary btn-lg btn-block" id="reservation_cal_submit" name="reservation_cal_submit" type="submit">Calculer</button>
                </div>
              </div>
            </div>
            
            <hr class="mb-1">
            <div class="mb-3">
              <small><span style="color: red">IMPORTANT</span>: Si vous ne payez pas dans les 15 prochaines jours, votre réservation sera automatiquement annulé</small>
            </div>

            
          </form>
        </div>
      </div>
      <?php endif;?>
      <!-- perso formulaire -->
      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">Lejdar &copy; <script>date = new Date(); document.write(date.getFullYear());</script></p>
      </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?= JS_PATH?>jquery.min.js"></script>
    <script src="<?= JS_PATH?>popper.js"></script>
    <script src="<?= JS_PATH?>bootstrap.min.js"></script>
    <script src="<?= JS_PATH?>alertify.min.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>

    <!-- <script>

      $(document).ready(function(){
        var lastenf = 0;
          var currenf = 0;
          $("#enf").change(function(){
            currenf = parseInt($("#enf").val());
                if(currenf - lastenf == 1){
                  //alert(currenf);
              $("#ele_enf").append("<label for='age_enfin"+currenf +"' id='age_enf"+currenf+"'>L'age de l'enfant "+currenf+"</label>\
                <input type='number' min='0' max='17' id='age_enfin"+currenf+"' name='age_enfin"+ currenf +"' class='mb-2'>");
              }else{
                //alert(currenf);
                $("#age_enf"+lastenf).remove();
                $("#age_enfin"+lastenf).remove();
              }
              lastenf  = currenf;
          });
      })
    </script> -->

    <script>
      $(document).ready(function(){
        $("#reservation_submit").attr('disabled');
        var checkbox_cond = $("#reservation_condition");
          checkbox_cond.click(function(){
            if (checkbox_cond.prop("checked") === true){
              $("#reservation_submit").removeAttr('disabled');
            }else{
              $("#reservation_submit").attr('disabled','disabled');
            }
          });
      });
    </script>


    <script>
    $(document).ready(function(){

        $("#reservation_cal_submit").click(function(event){
          event.preventDefault();

          var nbr_adult = $("#reserver_adulte").val();
          var nbr_enfant = $("#reserver_enfant").val();
          var nbr_bb = $("#reserver_bb").val();

        $.ajax({
          url: "/offres/reserver",
          xhrFields: { withCredentials: true },
          method: "POST",
          data: {prix_estim_submit: "submit", action: "reserver", nbr_adult: nbr_adult , nbr_enfant: nbr_enfant, nbr_bb: nbr_bb ,offre: <?= $_POST['offre']?> },

          success: function(data){
            res = JSON.parse(data);
            if (res.error == false){
              $("#res_total_prix").text(res.total + " DA");
            }else{
              $("#res_total_prix").text("0 DA");
              if(res.error_msg_adulte){
                var notification = alertify.notify(res.error_msg_adulte, 'error', 5, function() {
                    console.log('erreur');
              });
              }
              if(res.error_msg_enfant){
                var notification = alertify.notify(res.error_msg_enfant, 'error', 5, function() {
                    console.log('erreur');
              });
              }
              if(res.error_msg_bb){
                var notification = alertify.notify(res.error_msg_bb, 'error', 5, function() {
                    console.log('erreur');
              });
              }


            }
          },

          error: function(error){
            console.log("Erreur 500 interne dans le serveur");
          }
        });

        });
        $("#reservation_submit").click(function(event){
          event.preventDefault();

            $.ajax({
              url: "/offres/reserver",
              xhrFields: { withCredentials: true },
              method: "POST",
              data: {reservation_submit: "submit", action: "reserver", offre: <?= $_POST['offre']?> },
              success: function(data){
                if (data === "tarif_base"){
                  console.log(data);
                  alert("Tarif de base ajouter");
                }else{
                  console.log(data);
                  alert(data);
                }
              },

              error: function(error){
                alert("Erreur 500 interne dans le serveur");
              }

            });

        });


    }); 
    
    </script>
  </body>
</html>
