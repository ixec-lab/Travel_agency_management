<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Islem Meghnine">
    <meta name="Agence de voyage" content="Lejdar" >
    <title>Register - Ledjdar</title>

    <link rel="stylesheet" href="<?= CSS_PATH?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>slick.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>slicknav.css">
    <!-- Begin Font awsome lib -->
    <link rel="stylesheet" href="<?= FONT_PATH?>/css/all.css">
    <link rel="stylesheet" href="<?= CSS_PATH?>register.css">
    <!-- End font awsome lib -->
</head>
<body class="color-change-2x">
    <?php if (!empty($this->_error)): ?>
        <?php foreach($this->_error as $er => $data): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops !</strong> <?= $data ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endforeach;?>

    <?php endif;?>

<div>
        <div class="style-form">
            <form class="form-register" method="POST">
                <img class="mx-auto d-block" src="<?= IMAGES_PATH?>logo.png" width="150" hieght="150">
                <h1 class="h3 mb-3 font-weight-normal text-center">Inscrivez-vous</h1>
                <div class="row">
                    <div class="col-12  col-md-6 ">
                        <div class="form-group">
                            <label for="nom" class="cols-sm-2 control-label mb-2"><i class="fa fa-user fa"
                                    aria-hidden="true"></i> Nom :</label>
                            <div class="cols-sm-10 ">
                                <div class="input-group">

                                    <input type="text" class="form-control" name="nom" id="nom"
                                        placeholder="Saisissez votre nom " />
                                </div>
                            </div>
                        </div>
                    </div>
                        
                      <div class="col-12  col-md-6 ">   
                        <div class="form-group">
                            <label for="prenom" class="cols-sm-2 control-label mb-2"><i class="fa fa-user fa"
                                    aria-hidden="true"></i> Prénom :</label>
                            <div class="cols-sm-10 ">
                                <div class="input-group">

                                    <input type="text" class="form-control" name="prenom" id="prenom"
                                        placeholder="Saisissez votre prénom" />
                                </div>
                            </div>
                        </div>
                    </div>  

                    <div class="col-12  col-md-6 ">   
                        <div class="form-group">
                            <label for="sexe" class="cols-sm-2 control-label mb-2 mt-2"><i class="fas fa-venus-mars"></i> Sexe :</label>
                            <div class="cols-sm-10 ">
                                <div class="input-group">
                                    <select style="padding:11px" class="form-select" name="sexe" id="sexe" aria-placeholder="Choisissez votre sexe ">
                                       
                                        <option value="chose" selected disabled>Selectionner votre sexe </option>
                                        <option value="H">Homme</option>
                                        <option value="F">Femme</option>
                                       
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div> 
                    

                    <div class="col-12 col-md-6" > 

                        <div class="form-group">
                            <label for="date" class="cols-sm-2 control-label mb-2 mt-2"><i class="fas fa-calendar-alt"></i> Date de naissance :</label>
                            <div class="cols-sm-10 ">
                                <div class="input-group">

                                    <input type="date" class="form-control" name="date" id="date"
                                        placeholder="jj/mm/aaaa" />
                                </div>
                            </div>
                        </div>


                    </div>
                    

                    <div class="col-12 col-md-6" > 

                        <div class="form-group">
                            <label for="adresse" class="cols-sm-2 control-label mb-2 mt-2"><i class="fas fa-map"></i> Adresse :</label>
                            <div class="cols-sm-10 ">
                                <div class="input-group">

                                    <input type="text" class="form-control" name="adresse" id="adresse"
                                        placeholder="Saisissez votre adresse" />
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-12  col-md-6 ">   
                        <div class="form-group">
                            <label for="tel" class="cols-sm-2 control-label mb-2 mt-2"><i class="fas fa-phone-alt"></i> Téléphone :</label>
                            <div class="cols-sm-10 ">
                                <div class="input-group">

                                    <input type="text" class="form-control" minlength="9" maxlength="14" name="tel" id="tel"
                                        placeholder="Saisissez votre numéro de tel" />
                                </div>
                            </div>
                        </div>
                    </div>  
                     


                       <div class="col-12 col-md-6" >
                       
                        <div class="form-group">
                            <label for="username" class="cols-sm-2 control-label mb-2 mt-2"><i class="fas fa-user-circle"></i> Nom d'utilisateur :</label>
                            <div class="cols-sm-10">
                                <div class="input-group">

                                    <input type="text" class="form-control" name="username" id="username"
                                        placeholder="Identifiant" />
                                </div>
                            </div>
                        </div>
                      </div> 
                      <div class="col-12 col-md-6" >
                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label mb-2 mt-2"><i class="fa fa-envelope fa"
                                    aria-hidden="true"></i> Votre E-mail :</label>
                            <div class="cols-sm-10">
                                <div class="input-group">

                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Saisissez votre E-mail" />
                                </div>
                            </div>
                        </div>


                      </div>

                      <div class="col-12 col-md-6" >
                        <div class="form-group">
                            <label for="password" class="cols-sm-2 control-label mb-2 mt-2"><i
                                    class="fa fa-lock fa-lg" aria-hidden="true"></i> Mot de passe :</label>
                            <div class="cols-sm-10">
                                <div class="input-group">

                                    <input type="password" class="form-control" name="password"
                                        id="password" placeholder="Entrez votre mot de passe" />
                                </div>
                            </div>
                        </div>
                        
                      </div>
                    <div class="col-12 col col-md-6">
                        
                        
                        <div class="form-group">
                            <label for="confirm" class="cols-sm-2 control-label mb-2 mt-2"><i class="fa fa-lock fa-lg"
                                    aria-hidden="true"></i> Confirmation du mot de passe :</label>
                            <div class="cols-sm-10">
                                <div class="input-group">

                                    <input type="password" class="form-control" name="confirmp" id="confirmp"
                                        placeholder="Confirmez votre mot de passe" />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                        <div class="container">
                            <div class="row w-100 mb-3">
                                <label for="idPassport"><i style="font-size: 20px;" class="fas fa-passport"></i> &nbsp; Passeport</label>
                                <input type="text" class="form-control" id="idPassport" name="idPassport">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                           <input class="btn btn-lg btn-primary w-25" type="submit" name="register" id="register" value="S'inscrire">
                         </div>
                    <div class="mb-1 mt-3 text-center col-12">
                        <small><a href="/index/login">Se connecter</a> | </small>
                        <small><a href="/index">Accueil</a></small>
                    </div>
                <p class="mt-2 mb-3 text-muted text-center">Lejdar agency &copy; <script>var date = new Date(); document.write(date.getFullYear());</script></p>
            </form>
        </div>
    </div>

    <!-- JS here -->
    <script src="<?= JS_PATH?>popper.js"></script>
    <script src="<?= JS_PATH?>jquery.min.js"></script>
    <script src="<?= FONT_PATH?>js/all.min.js"></script>
    <script src="<?= JS_PATH?>bootstrap.min.js"></script>
</body>
</html>