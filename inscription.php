<?php
require ('functions.php');

if(isset($_POST["submit"]))
{
    $login = htmlspecialchars($_POST["login"]);
    $password = htmlspecialchars($_POST["password"]);
    $password2 = htmlspecialchars($_POST["password2"]);

    if(empty($login))
    {
        $error = "provide username !";
    }
    else if(empty($password) AND empty($password2)) {
        $error = "provide password !";
    }
    else if(strlen($password) < 6 OR strlen($password2) < 6 OR strlen($login) < 6){
        $error = "Password and login must be atleast 6 characters";
    }
    else
    {
        login_exist($login);
        
        if(login_exist($login) == $login)
        {
            $error = "sorry username already taken !";
        }
        elseif(!password($password, $password2))
        {
            $error = "sorry password not the same !";
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



<!-- Debut page display -->
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
<nav class="nav">

<!--Nav PHP-->
<a href='index.php'>Accueil</a>
<a href='inscription.php'>Inscription</a>
<a href='connexion.php'>Connexion</a>
<a href='discussion.php'> On DIScuisine ?</a>


<!--Nav PHP-->

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
                    <label for="password"></label>
                    <input type="password" name="password" id="password" placeholder="Votre mot de passe">
                </div>

                <div>
                    <label for="password2"></label>
                    <input type="password" name="password2" id="password2" placeholder="Confirmation">
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