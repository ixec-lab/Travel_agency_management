<?php
  use AGENCE_VOYAGE\MODELS\ActualiteModel;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Islem Meghnine">
    <meta name="Agence de voyage" content="Lejdar" >
    <title>Accueil - Lejdar </title>

    <link rel="stylesheet" href="<?= CSS_PATH?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>index.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>slick.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>slicknav.css">
    <!-- Begin Font awsome lib -->
    <link rel="stylesheet" href="<?= FONT_PATH?>css/all.css">
    <!-- End font awsome lib -->
    <link rel="stylesheet" href="<?= CSS_PATH?>nice-select.css">
</head>
<body>

    
<!-- Top bar Start -->
<div class="topbar">
    <div class="container">
        <div class="row">
            <div class="col col-sm col-md col-lg text-center text-color"><i class="fas fa-phone"></i> +213 549555599</div>
            <div class="col col-sm col-md col-lg text-center text-color"><i class="far fa-paper-plane"></i> contact@ladjdar.dz</div>
            <div class="col col-sm col-md col-lg text-center text-color"><i class="fas fa-map-pin"></i> Adresse 501, algérie</div>
        </div>
    </div>
</div>
<!-- top-bar End -->
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
            <a class="nav-link active" aria-current="page" href="/" id="home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/offres/list">Offres</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/gallerie">Gallerie</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact</a>
          </li>

        </ul>
        <?php if (empty($_SESSION)):?>
          <div>
              <span onclick="openNav()" class="btn btn-outline-dark"><i class="fas fa-user"></i> Connexion / Inscription</span>
          </div>
          <?php else: ?>
            <div class="">
                
                <div class="dropdown">
                  <button style="background-color: #0674ba;color:white;" class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  <i style="font-size:25px;color:white;" class="fas fa-user-circle"></i> <?php if (!empty($_SESSION['admin_id'])){ echo ucfirst($_SESSION['admin_username']);}else if (!empty($_SESSION ['id'])){echo $_SESSION['nom']. " " . $_SESSION['prenom'];}?>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="/profile"><i class="fas fa-user"></i> Mon profile</a></li>
                    <li><a class="dropdown-item" href="/index/logout"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
                  </ul>
                </div>
              </div> 
        <?php endif;?>
      </div>
    </div>
  </nav>
  <!-- Header End -->
  <!-- Begin news bar -->
  <div class="containerH">
    <div class="ticker">
      <div class="title">
        <h5 class="show-on-desktop blink-1"><span class="badge bg-danger">Promo</span></h5>
         <div class="news">
           <marquee>
              <p style="color: #000000"><?php $act = ActualiteModel::getActulaite(); if(!empty($act)) echo $act->TXT; else echo "Ne ratez pas nos offres avenir" ?></p>
             </marquee>
          </div>

    </div>
  </div>
  </div>
  <!-- End news bar -->

  <?php if (empty($_SESSION)):?>
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
  
  <!-- bg Start -->
  <div class="bg-cover">
    <div class="row w-100">
      <div class="col-12 col-sm-12 col-md-6 col-md-6">
        <div class="search-form-right">
          <form method="POST" autocomplete="off" action="/offres/list">
            <h2 class="header-text text-center">Trouvez votre voyage</h2>
              <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="mb-2">
                    <label for="date-dep"><i class="far fa-calendar-minus"></i> Date de départ</label>
                    <input type="date" id="date-dep" name="date-dep" class="form-control" required>
                  </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="autocomplete mb-2">
                      <label for="distiniation"><i class="fas fa-map-marked"></i> Distination</label>
                      <input type="text"  name="distiniation" id="distiniation" class="form-control" placeholder="Distination" value="" required>
                    </div>
                </div>
              </div>
              <div>
                <input type="submit" value="Chercher" class="btn btn-primary mt-3"/>
              </div>
              
          </form>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
          <div class="text-left">
            <h1 class="cover-text">Planifier de chez vous</h1>
            <h3 class="text-center cover-text-mini"> - Lejdar Agency - </h3>
            <div class="text-center d-flex justify-content-center">
              <a href="#facebook" class="m-3"><img src="<?= IMAGES_PATH?>facebook.png" width="40" height="40" alt="facebook"></a>
              <a href="#twitter" class="m-3"><img src="<?= IMAGES_PATH?>twitter.png" width="40" height="40" alt="twitter"></a>
              <a href="#instagram" class="m-3"><img src="<?= IMAGES_PATH?>instagram.png" width="40" height="40" alt="instagram"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- bg End-->

  <!-- Title for section -->
  <div class="prt-2 mt-5">
    <h1 class="header-text text-center" id="services">Nos services</h1>
<!-- Offers Section -->
  <div class="container mt-5 prt-2" >
    <div class="row">
      <div class="col-md-4">
        <div class="card mb-4 box-shadow shadow-drop-center">
          <img class="card-img-top" src="<?= IMAGES_PATH?>makka.jpg" width="354" height="225">
          <div class="card-body">
              <div class="mb-2 d-flex justify-content-end">
                <span class="fa fa-star rated"></span>
                <span class="fa fa-star rated"></span>
                <span class="fa fa-star rated"></span>
                <span class="fa fa-star rated"></span>
                <span class="fa fa-star rated"></span>
              </div>
            <p class="card-text">Hajj & Omra.</p>
            <div class="d-flex justify-content-between align-items-center">
              <button class="btn btn-outline-warning">Plus d'information</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4 box-shadow shadow-drop-center">
          <img class="card-img-top" src="<?= IMAGES_PATH?>dist2.jpg" width="354" height="225">
          <div class="card-body">
            <div class="mb-2 d-flex justify-content-end">
              <span class="fa fa-star rated"></span>
              <span class="fa fa-star rated"></span>
              <span class="fa fa-star rated"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
            </div>
            <p class="card-text">Voyage organisé</p>
            <div class="d-flex justify-content-between align-items-center">
              <button class="btn btn-outline-warning">Plus d'information</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4 box-shadow shadow-drop-center">
          <img class="card-img-top" src="<?= IMAGES_PATH?>dist3.jpg" width="354" height="225">
          <div class="card-body">
            <div class="mb-2 d-flex justify-content-end">
              <span class="fa fa-star rated"></span>
              <span class="fa fa-star rated"></span>
              <span class="fa fa-star rated"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
            </div>
            <p class="card-text">Voyage personnelle</p>
            <div class="d-flex justify-content-between align-items-center">
              <button class="btn btn-outline-warning">Plus d'information</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div> 

  <!-- Footer section -->
 <!-- <footer class="container-fluid">
    <p class="d-flex justify-content-end"><a href="#"> <img src="<?= IMAGES_PATH?>up-arrow.png" alt="up-arrow" width="30" height="30"> </a></p>
    <p class="d-flex justify-content-center">© <script>var a = new Date(); document.write(a.getFullYear());</script> Ladjdar </p>
  </footer>-->


<!--footer -->
<footer class="bg-dark footer-08 text-white">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9 py-5">
                    <div class="row">
                        <div class="col-md-4 mb-md-0 mb-4">
                            <h2 class="footer-heading">About us</h2>
                            <p>Notre Agence est ouverte de <span class="text-white"> 09:00 a 17:00 </span>si vous avez
                                des questions n'hesiter pas a nous les envoyer a travers conact us </p>
                            <p>vous pouvez nous contacter sur le numero qui est affiché en-bas</p>
                            <div class="footer-adr">
                                <ul class="ftco-footer-social list-unstyled">
                                    <li>
                                        <h6 class=" text-white "><i class="fas fa-map-marker-alt text-muted"></i>
                                            Adresse : 46 Rue
                                            Mohamed Lazzouni, Douéra , Alger ,Algerie</h6>
                                    </li>

                                    <li>
                                        <h6 class="text-white"><i class="fas fa-phone text-muted"></i> +213 542789600
                                        </h6>
                                    </li>
                            </div>
                            </ul>
                            <ul class="social p-0">
                                <li>
                                    <a href="https://www.facebook.com/lejdartravelagencyalger/" target="_blank">
                                        <i class="fab fa-facebook" tabindex="0"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/lejdartravelagencyalger" target="_blank">
                                        <i class="fab fa-instagram" tabindex="0"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.twitter.com/lejdartravelagencyalger" target="_blank">
                                        <i class="fab fa-twitter" tabindex="0"></i>
                                    </a>
                                </li>
                            </ul>

                        </div>
                        <div class="col-md-8">
                            <div class="row justify-content-center">
                                <div class="col-md-12 col-lg-9">
                                    <div class="row">
                                        <div class="col-md-4 mb-md-0 mb-4">
                                            <h2 class="footer-heading">Services</h2>
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="py-1 d-block">Hadj &amp; Omra</a></li>
                                                <li><a href="#" class="py-1 d-block">Voyage organisé</a></li>
                                                <li><a href="#" class="py-1 d-block">Voyage personnalisé</a></li>

                                            </ul>
                                        </div>
                                        <div class="col-md-4 mb-md-0 mb-4">
                                            <h2 class="footer-heading">About</h2>
                                            <ul class="list-unstyled">
                                                <li><a href="#">Staff</a></li>
                                                <li><a href="#">Team</a></li>
                                                <li><a href="#" class="py-1 d-block">Careers</a></li>
                                                <li><a href="#" class="py-1 d-block">Blog</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4 mb-md-0 mb-4">
                                            <h2 class="footer-heading">Resources</h2>
                                            <ul class="list-unstyled">
                                                <li><a href="#" class="py-1 d-block">Security</a></li>
                                                <li><a href="#" class="py-1 d-block">Global</a></li>
                                                <li><a href="#" class="py-1 d-block">Charts</a></li>
                                                <li><a href="#" class="py-1 d-block">Privacy</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 py-md-5 py-4 aside-stretch-right pl-lg-5">
                    <h2 class="footer-heading footer-heading-white">Contact us</h2>
                    <form method = "POST" class="contact-form">

                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Votre Email">
                        </div>
                        <div class="form-group">
                            <input type="text" name="sujet" class="form-control" placeholder="Sujet">
                        </div>
                        <div class="form-group">
                            <textarea name="msg" cols="30" rows="3" class="form-control"
                                placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="contact_submit" class="form-control submit px-3 mt-2" value="Envoyer">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row" style="background-color: rgb(0, 0, 0);">
                <div class="col-md-12">
                    <!-- Copyright -->
                    <div class="text-center p-3 text-muted ">
                        © 2021 Lejdar:
                        <a class="text-white" href="index.html"> www.lejdar.dz </a>
                    </div>
                    <!-- Copyright -->
                </div>
            </div>
        </div>
    </footer>

  <!-- End footer section -->
<!-- JS here -->
    <script src="<?= JS_PATH?>popper.js"></script>
    <script src="<?= JS_PATH?>jquery.min.js"></script>
    <script src="<?= FONT_PATH?>js/all.min.js"></script>
    <script src="<?= JS_PATH?>jquery.nice-select.min.js"></script>
    <script src="<?= JS_PATH?>bootstrap.min.js"></script>

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

    <script>
      /* Distination suggestions */
      /* Beta version */
      var distinations = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia &amp; Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre &amp; Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts &amp; Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad &amp; Tobago","Tunisia","Turkey","Turkmenistan","Turks &amp; Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe","El hadj","Omra"];

      function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
              b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}
</script>

<script>
  autocomplete(document.getElementById("distiniation"), distinations);
  </script>
</body>
</html>