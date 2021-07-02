<?php
use AGENCE_VOYAGE\MODELS\OffreModel;
use AGENCE_VOYAGE\MODELS\ProposerModel;
use AGENCE_VOYAGE\MODELS\AvoirModel;
use AGENCE_VOYAGE\MODELS\ReservationModel;
?>

<!doctype html>
<html class="no-js" lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Offres - Lejdar</title>
    <meta name="description" content="Agence de voyage">
    <meta name="Author" content="Islem Meghnine">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS here -->
    <link rel="stylesheet" href="<?= CSS_PATH?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>owl.carousel.min.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>slicknav.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>flaticon.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>price_rangs.css">
    <link rel="stylesheet" href="<?= FONT_PATH?>css/all.min.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>themify-icons.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>slick.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>nice-select.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>offres.css">
</head>


<body>
    <!-- Header Start-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light pb-3 shadow-lg navbar-toped" id="navbar">
        <div class="container">
            <a class="navbar-brand header-text" href="#"><img src="<?= IMAGES_PATH?>logo.webp" width="72" height="72"
                    alt="logo_brand">Lejdar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#mobile-version-toggel1" aria-controls="mobile-version-toggel1" aria-expanded="false"
                aria-label="Toggle navigation">
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
                        <a class="nav-link active" href="/offres/list">Offres</a>
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
                <?php elseif ($_SESSION["is_admin"] === false): ?>
                    <div class="">
                        
                        <div class="dropdown">
                        <button style="background-color: #0674ba;color:white;" class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i style="font-size:25px;color:white;" class="fas fa-user-circle"></i> <?= $_SESSION['nom'] . " " . $_SESSION['prenom'];?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        
                            <li><a class="dropdown-item" href="/profile"><i class="fas fa-user"></i> Mon profile</a></li>
                            <li><a class="dropdown-item" href="/index/logout"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
                        </ul>
                        </div>
                    </div> 
                <?php else: ?>
                    <div class="">
                        
                        <div class="dropdown">
                        <button style="background-color: #0674ba;color:white;" class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i style="font-size:25px;color:white;" class="fas fa-user-circle"> </i> <?= $_SESSION['admin_username'];?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        
                            <li><a class="dropdown-item" href="/admin"><i class="fas fa-user"> </i> Administration</a></li>
                            <li><a class="dropdown-item" href="/admin/logout"><i class="fas fa-sign-out-alt"> </i> Déconnexion</a></li>
                        </ul>
                        </div>
                    </div> 

                <?php endif;?>
                <!-- end here -->
            </div>
        </div>
    </nav>
    <!-- Header End -->
    <?php if(empty($_SESSION)):?>
        <!-- The overlay -->
        <div id="myNav" class="overlay-header">

            <!-- Button to close the overlay navigation -->
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

            <!-- Overlay content -->
            <div class="overlay-content-header">
                <a href="/index/login">Connexion</a>
                <a href="/index/register">Inscription</a>
            </div>

        </div>
    <?php endif;?>
    <!-- listing Area Start -->
    <div class="listing-area pt-70 pb-120">
        <div class="container">
            <div class="row">
                <!-- Left content -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <div class="small-section-tittle2 mb-45">
                                <h4>Que cherchez vous ?</h4>
                            </div>
                        </div>
                    </div>
                    <!-- offers Category Listing start -->
                    <div class="category-listing mb-50">
                        <!-- single one -->
                        <div class="single-listing">
                            <!-- input 
                            <div class="input-form">
                                <input type="text" placeholder="Vacances , Omara , Voyage  ?">
                            </div>-->
                            <!-- Select offer items start -->
                            <form method="POST">
                            <div class="select-job-items1">
                                <label for="offer_type">Type de service</label>
                                <select id="offer_type" name="offer_type">
                                    <option value="" selected>Tous</option>
                                    <option value="hadj">Hajj</option>
                                    <option value="omra">Omra</option>
                                    <option value="personnalise">Voyage personelle</option>
                                    <option value="organise">Voyage organisé</option>
                                </select>
                            </div>
                            <!--  Select offer items End-->
                            <!-- Select offer items start -->
                            <div class="select-job-items2">
                                <label for="offer_dispo">Disponibilité</label>
                                <select id="offer_dispo" name="offer_dispo">
                                    <option value="Disponible">Disponible</option>
                                    <option value="Indisponible">Indisponible</option>
                                    <option value="" selected>Tous</option>
                                </select>
                            </div>
                            <!--  Select offer items End-->
                            <!-- select-Categories start 
                            <div class="select-Categories pt-140 pb-20">
                                <label class="container">Full Time
                                    <input type="checkbox" >
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Ratings
                                    <input type="checkbox" checked="checked active">
                                    <span class="checkmark"></span>
                                </label>
                            </div>-->
                            <!-- select-Categories End -->
                            <!-- Select offer items start -->
                            <div class="input-form">
                                <label for="offer_budget">Votre budget</label>
                                <input id="offer_budget" name="offer_budget" type="text" autocomplete="off">
                            </div>

                            <!-- <div class="input-form">
                                <label for="offer_dep">Date de départ</label>
                                <input type="date" id="offer_dep" name="offer_dep">
                            </div> -->
                            <!--  Select offer items End-->
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="single-listing">
                                    <input type="submit" id="filter_submit" name="filter_submit" class="btn btn-primary d-flex justify-content-center mt-20" value="filtrer">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end">
                                    <div class="single-listing">
                                            <a href="/offres/list" id="filter_submit" name="filter_submit" class="btn btn-danger d-flex justify-content-center mt-20">Vider</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <!-- offer Category Listing End -->
                </div>
                <!-- Right content -->
                <div class="col-xl-8 col-lg-8 col-md-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="count mb-35">
                                <span><?php if(empty($_POST['offer_type']) && empty($_POST['offer_dispo']) && empty($_POST['offer_budget'])){$nbrOffer = (int)OffreModel::CountAllOffers(); if ($nbrOffer > 1) echo $nbrOffer . " Offres au totals"; elseif($nbrOffer === 1) echo "Une seule offre a afficher"; else echo "0 Offre disponible";}else{ $nbrOffer = count($this->_data['filterd_data']); if($nbrOffer > 1) echo $nbrOffer . " Offres au totals pour ce filtre"; elseif($nbrOffer === 1) echo "Une seule résultat pour ce filtre"; else echo "Aucun résultat pour ce filtre"; } ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- listing Details Stat-->
                    <div class="listing-details-area">
                        <div class="container">
                            <div class="row">

                            <?php  if(count($this->_data) === 0): // if filtring is disabled ?>
                            <?php $offres = OffreModel::getAllServices(); if (empty($offres)) echo "<h1>Aucune Offre pour le moment</h1>"; else foreach($offres as $offre): ?>
                                <div class="col-lg-6">
                                    <div class="single-listing mb-30">
                                        <div class="list-img">
                                            <img src="<?= $offre->IMG_S?>" width="354" height="225" alt="">
                                            <!-- <span>Open</span> -->
                                        </div>
                                        <div class="list-caption">
                                        <?php if($offre->disponibilite === "Disponible"):?>
                                            <span style="background-color: rgb(66, 180, 66);">Disponible</span>
                                        <?php else: ?>
                                            <span style="background-color: rgb(220,20,60);">Indisponible</span>
                                        <?php endif;?>
                                            <h3><?= $offre->TITRE?></h3>
                                            <?php
                                                
                                                $tariftrans = 0;

                                                if (AvoirModel::getTypeTransportInService($offre->ID_SERVICE) === "bus"){
                                                    $tariftrans = OffreModel::getBusPrice($offre->ID_SERVICE);
                                                }else{
                                                    $tariftrans = OffreModel::getVolPrice($offre->ID_SERVICE);
                                                }

                                                $total = (int)$tariftrans + (int)$offre->TARIF + (int)OffreModel::getHotelPrice($offre->ID_SERVICE);

                                                //echo $tariftrans . "<br>" . $offre->TARIF . "<br>" . OffreModel::getHotelPrice($offre->ID_SERVICE);
                                            ?>
                                            <h6 style="font-weight: bold;"><?= "Prix : " . $total . " DA"?></h6>
                                            <!-- Hotels -->
                                            <?php $hotel = ProposerModel::getHotelInService($offre->ID_SERVICE); if (!empty($hotel)):?>
                                            <h6 style="font-weight: bold;"><?= "Hotel : " . $hotel?></h6>
                                            <?php endif; ?>
                                            <!-- Vols -->
                                            <?php $trans = AvoirModel::getTransportInService($offre->ID_SERVICE); if (!empty($trans)):?>
                                            <h6 style="font-weight: bold;"><?= "Transport : " . $trans . " (". AvoirModel::getTypeTransportInService($offre->ID_SERVICE) .")"?></h6>
                                            <?php endif; ?>
                                            <p><?= "Description: " . $offre->DESCRIPTION ?></p>
                                            <div class="list-footer">
                                                <ul>
                                                    <li>
                                                    <form method="POST" action="/offres/reserver/">
                                                        <input type="text" name="offre" value="<?= $offre->ID_SERVICE?>" class="btn btn-sm btn-primary" hidden>
                                                        <input type="submit" name="action"  value="reserver" class="btn btn-sm btn-primary">
                                                    </form>
                                                    </li>
                                                    <?php if(!empty($offre->NBR_M)):?>
                                                    <li style="font-weight: bold;"><?= ReservationModel::getResevationCount($offre->ID_SERVICE)?>/<?= $offre->NBR_M;?> Places réservée</li>
                                                    <?php endif;?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach;?>
                                <?php else: // filtre enabled?>
                                        <?php foreach($this->_data['filterd_data'] as $offre): ?>
                                    <div class="col-lg-6">
                                        <div class="single-listing mb-30">
                                            <div class="list-img">
                                                <img src="<?= $offre->IMG_S?>" width="354" height="225" alt="">
                                                <!-- <span>Open</span> -->
                                            </div>
                                            <div class="list-caption">
                                            <?php if($offre->disponibilite === "Disponible"):?>
                                                <span style="background-color: rgb(66, 180, 66);">Disponible</span>
                                            <?php else: ?>
                                                <span style="background-color: rgb(220,20,60);">Indisponible</span>
                                            <?php endif;?>
                                                <h3><?= $offre->TITRE?></h3>
                                                <h6 style="font-weight: bold;"><?= "Prix : " . $offre->TARIF . " DA"?></h6>
                                                <!-- Hotels -->
                                                <?php $hotel = ProposerModel::getHotelInService($offre->ID_SERVICE); if (!empty($hotel)):?>
                                                <h6 style="font-weight: bold;"><?= "Hotel : " . $hotel?></h6>
                                                <?php endif; ?>
                                                <!-- Vols -->
                                                <?php $trans = AvoirModel::getTransportInService($offre->ID_SERVICE); if (!empty($trans)):?>
                                                <h6 style="font-weight: bold;"><?= "Transport : " . $trans . " (". AvoirModel::getTypeTransportInService($offre->ID_SERVICE) .")"?></h6>
                                                <?php endif; ?>
                                                <p><?= "Description: " . $offre->DESCRIPTION ?></p>
                                                <div class="list-footer">
                                                    <ul>
                                                        <li>
                                                        <form method="POST" action="/offres/reserver/">
                                                            <input type="text" name="offre" value="<?= $offre->ID_SERVICE?>" hidden>
                                                            <input type="text" name="csrf" value="TOKEN" hidden>
                                                            <input type="submit" name="action"  value="Réserver" class="btn btn-sm btn-primary">
                                                        </form>
                                                        </li>
                                                        <?php if(!empty($offre->NBR_M)):?>
                                                        <li style="font-weight: bold;">3/<?= $offre->NBR_M;?> Places réservée</li>
                                                        <?php endif;?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <!-- JS here -->

                    <script>
                        /* Open when someone clicks on the span element */
                        function openNav() {
                            $("#myNav").css("width", "100%");
                        }

                        /* Close when someone clicks on the "x" symbol inside the overlay */
                        function closeNav() {
                            $("#myNav").css("width", "0%");
                        }
                    </script>

                    <!-- All JS Custom Plugins Link Here -->
                    <script src="<?= JS_PATH?>modernizr-3.5.0.min.js"></script>
                    <!-- Jquery, Popper, Bootstrap -->
                    <script src="<?= JS_PATH?>jquery.min.js"></script>
                    <script src="<?= JS_PATH?>popper.js"></script>
                    <script src="<?= JS_PATH?>bootstrap.min.js"></script>
                    <!-- Jquery Mobile Menu -->
                    <script src="<?= JS_PATH?>jquery.slicknav.min.js"></script>

                    <!-- Jquery Slick , Owl-Carousel Plugins -->
                    <script src="<?= JS_PATH?>owl.carousel.min.js"></script>
                    <script src="<?= JS_PATH?>slick.min.js"></script>
                    <!-- One Page, Animated-HeadLin -->

                    <script src="<?= JS_PATH?>price-range.js"></script>

                    <!-- Nice-select, sticky -->
                    <script src="<?= JS_PATH?>jquery.nice-select.min.js"></script>
                    <script src="<?= JS_PATH?>jquery.sticky.js"></script>

                    <!-- Jquery Plugins, main Jquery -->
                    <script src="<?= JS_PATH?>offres.js"></script>

</body>

</html>