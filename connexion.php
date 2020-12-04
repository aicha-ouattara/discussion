<?php
session_start(); //Session connexion
require ('functions.php');


if(isset($_POST["submit"]))
{
    $login = htmlspecialchars($_POST["login"]);
    $password = htmlspecialchars($_POST["password"]);

    if(connexion($login, $password))
    {
        redirect('profil-index.php');
    }
    else
    {
        $error = "Wrong Details !";
    }
}

?>

<!-- Debut page display -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css" />
    <title>Inscription</title>
</head>

<body class="body2">
<header>
    <nav class="nav">
    <a href='index.php'>Accueil</a>
<a href='inscription.php'>Inscription</a>
<a href='connexion.php'>Connexion</a>
<a href='discussion.php'> On DIScuisine ?</a>

    </nav>
</header>

<main>

    <section>
        <!--Debut form -->
        <form class="form" method="post" action="connexion.php">
          <h1>Connexion</h1>
                <div>
                    <label for="login"></label>
                    <input type="text" name="login" id="login" placeholder="Votre login">
                </div>


                <div>
                    <label for="password"></label>
                    <input type="password" name="password" id="password" placeholder="Votre mot de passe">
                </div>

                <div>
                    <input type="submit" name="submit" value="JE M'INSCRIS">
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
    <p></p>
</footer>

</body>

</html>

<!--End page display -->
