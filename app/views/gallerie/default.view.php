<?php
  use AGENCE_VOYAGE\MODELS\GallerieModel;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>

    <link rel="stylesheet" href="<?= CSS_PATH?>galleriev2.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>bootstrap.min.css">
    <!-- Begin Font awsome lib -->
    <link rel="stylesheet" href="<?= FONT_PATH?>css/all.css">
    <title>Gallerie - Lajdar</title>
</head>
<body>

<!-- Header Start-->
<nav class="navbar navbar-expand-lg navbar-light bg-light pb-3 shadow-lg navbar-toped" id="navbar">
    <div class="container">
      <a style="color:#0776bd;" class="navbar-brand header-text" href="#"><img src="<?= IMAGES_PATH?>logo.webp" width="72" height="72" alt="logo_brand">Lejdar</span></a>
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
            <a class="nav-link active" href="/gallerie">Gallerie</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/index/default#contact">Contact</a>
          </li>
        </ul>
        <?php if(empty($_SESSION)): ?>
        <div>
            <span onclick="openNav()" class="btn btn-outline-dark"><i class="fas fa-user"></i> Connexion / Inscription</span>
        </div>
        <?php elseif ($_SESSION["is_admin"] === false): ?>
        <?php var_dump($_SESSION);?>
            <div class="">
                
                <div class="dropdown">
                  <button style="background-color: #0674ba;color:white;" class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  <i style="font-size:25px;color:white;" class="fas fa-user-circle"></i> <?= $_SESSION['nom'] . " " . $_SESSION['prenom'];?>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> Mon profile</a></li>
                    <li><a class="dropdown-item" href="/index/logout"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
                  </ul>
                </div>
              </div> 
          <?php else:?>
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
      </div>
    </div>
  </nav>
  <!-- Header End -->
  <?php if (empty($_SESSION)): ?>
     <!-- The overlay -->
      <div id="myNav" class="overlay">

        <!-- Button to close the overlay navigation -->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <!-- Overlay content -->
        <div class="overlay-content">
          <a href="/index/login">Connexion</a>
          <a href="/index/register">Inscription</a>
        </div>

      </div>
  <?php endif;?>
    <h1 class="text-center header-text mt-5 mb-5">Gallerie</h1>

    <div class="container">
    <div class="gallery" id="gallery">
      <?php $images = GallerieModel::getAllPathesGallerie(); if(empty($images)) $error = "Aucune image pour le moment"; else foreach($images as $image):?>
      <?php var_dump($images);?>
        <div class="gallery-item">
            <div class="content">
            <?php if(!empty($error)):?>
              <h2><?= $error;?></h2>
            <?php else:?>
              <img src="<?= $image->IMAGE?>" alt="<?= "Image " . $image->ID_IMG?>">
            <?php endif;?>
            </div>

        </div>
        <?php endforeach;?>
    </div>
    </div>

      <!-- Footer section -->
  <footer class="container-fluid">
    <p class="d-flex justify-content-end"><a href="#"> <img src="<?= IMAGES_PATH?>up-arrow.png" alt="up-arrow" width="30" height="30"> </a></p>
    <p class="d-flex justify-content-center">Ladjdar © <script>var a = new Date(); document.write(a.getFullYear());</script></p>
  </footer>
  <!-- End footer section -->
    <script src="<?= JS_PATH?>popper.js"></script>
    <script src="<?= JS_PATH?>jquery.min.js"></script>
    <script src="<?= JS_PATH?>bootstrap.min.js"></script>
    <script src="<?= JS_PATH?>gallerie.js"></script>

    <script>
        /* Open when someone clicks on the span element */
        function openNav() {
            $("#myNav").css("width","100%");
        }

        /* Close when someone clicks on the "x" symbol inside the overlay */
        function closeNav() {
          $("#myNav").css("width","0%");
        }
    </script>
     
</body>
</html>