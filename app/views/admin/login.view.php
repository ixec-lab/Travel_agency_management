<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Islem Meghnine">
    <meta name="Agence de voyage" content="Lejdar" >
    <title>Administration - Ladjdar</title>

    <link rel="stylesheet" href="/app/views/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/app/views/assets/css/login.css">
    <link rel="stylesheet" href="/app/views/assets/css/slick.css">
    <link rel="stylesheet" href="/app/views/assets/css/slicknav.css">
    <!-- Begin Font awsome lib -->
    <link rel="stylesheet" href="/app/views/assets/fonts/css/all.css">
    <!-- End font awsome lib -->
</head>
<body class="color-change-2x">
    <div>
    <?php if (isset($bad_login)) echo($bad_login);?>
        <div class="style-form">
            <form class="form-signin" method="POST">
                <img class="mx-auto d-block" src="<?= IMAGES_PATH?>/logo.png" width="150" hieght="150">
                <h1 class="h3 mb-3 font-weight-normal text-center">Administration</h1>
                <label for="email" class="sr-only">Username</label>
                <input type="text" id="email" name="email" class="form-control mb-2" placeholder="Nom d'utilisateur / Email" required autofocus autocomplete="off">
                <label for="password" class="sr-only">Password</label>
                <input type="password" id="password" name="password" class="form-control mb-4" placeholder="Mot de passe" required>
                <input class="btn btn-md btn-primary  mx-auto d-block" type="submit" name="login" id="login" value="Connexion">
                <div class="mb-1 mt-3 text-center col-12">
                    <!-- <small><a href="/index/register">Vous avez pas un compte ?</a> | </small> -->
                    <small><a href="/index">Accueil</a></small>
                </div>
                <p class="mt-2 mb-3 text-muted text-center">Ladjdar agency &copy; <script>var date = new Date(); document.write(date.getFullYear());</script></p>
            </form>
        </div>
    </div>

    <!-- JS here -->
    <script src="/app/views/assets/js/popper.js"></script>
    <script src="/app/views/assets/js/jquery.min.js"></script>
    <script src="/app/views/assets/fonts/js/all.min.js"></script>
   <script src="/app/views/assets/js/bootstrap.min.js"></script>
   <script>
    $(document).ready(function(){
        alert("ATTENTION! , Touts les essaies sont enregistrés");
    });
   </script>
   
</body>
</html>