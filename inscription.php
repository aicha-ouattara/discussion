<?php
require ('functions.php');

if(isset($_POST["submit"]))
{
    $login = htmlspecialchars($_POST["login"]);
    $password = htmlspecialchars($_POST["password"]);
    $password2 = htmlspecialchars($_POST["password2"]);

    if(empty($login))
    {
        $error = "Renseignez un login !";
    }
    else if(empty($password) AND empty($password2)) {
        $error = "Renseignez un password !";
    }
    else if(strlen($password) < 6 OR strlen($password2) < 6 OR strlen($login) < 6){
        $error = "6 characters minimun pour le mot de passe et le login";
    }
    else
    {
        login_exist($login);
        
        if(!login_exist($login))
        {
            $error = "Désolé le login exite déjà !";
        }
        elseif(!password($password, $password2))
        {
            $error = "Désolé les mots de passe ne sont pas identique !";
        }
        else
        {
            if(insert_register($password, $login))
            {
                redirect('connexion.php');
            }
        }
    }
}



?>



<!-- Debut-page-display -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css" />
    <title>Inscription</title>
</head>

<body class="body1">
<header>
<nav class="nav1">
<!--Nav-->
<a href='index.php'>Accueil</a>
<a href='inscription.php'>Inscription</a>
<a href='connexion.php'>Connexion</a>
<a href='discussion.php'> On Dis-cuisine ?</a>
<!--Nav-->
</nav>
</header>

<main>
<article>
</article>
    <section>
        <!--Debut form -->
        <form class="form" method="post" action="inscription.php">
        <h1>Inscription</h1>

                <div>
                    <label for="login"></label>
                    <input type="text" name="login" id="login" placeholder="Votre login">
                </div>


                <div>
                     <!--<label for="password"></label>-->
                    <input type="password" name="password" id="password" placeholder="Votre mot de passe">
                </div>

                <div>
                    <!--<label for="password2"></label>-->
                    <input type="password" name="password2" id="password2" placeholder="Confirmation">
                </div>

                <div>
                    <input class="submit" type="submit" name="submit" value="JE M'INSCRIS">
                </div>
            <?php
            if(isset($error))
            {
                echo $error;
            }
            ?>
        </form>
        <!--End form -->

    </section>
</main>

<footer>
</footer>

</body>

</html>

<!--End-page-display -->
