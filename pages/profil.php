<?php
session_start(); //Session connexion
require ('../config/functions.php');

if (is_loggedin())
{
    $bdd = db();
    $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ? ");
    $req->execute(array($_SESSION["id"]));
    $users=$req->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['newlogin']) AND !empty($_POST['newlogin']) AND $_POST['newlogin'] != $users['login'])
    {
        $newlogin = htmlspecialchars($_POST['newlogin']);
        if (strlen($newlogin) <6)
        {
            $error = "6 characters minimun pour le login";
        }
        else{
            update_login($newlogin);
            $msg = "Votre profil a été bien modifié !";
        }

    }
    if(isset($_POST['newpassword']) AND !empty($_POST['newpassword']) AND $_POST['newpassword'] != $users['password'])
    {
        $newpassword = ($_POST['newpassword']);
        if (strlen($newpassword) <6)
        {
            $error = "6 characters minimun pour le mot de passe ";
        }
        else{
            update_password($newpassword);
            $msg = "Votre profil a été bien modifié !";
        }

    }
}

else
{
    redirect('connexion.php');
}
?>



<!--Debut page display -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css" />
    <title>Profil</title>
</head>

<body class="body4">
<header>
    <nav class="nav">
        <!--Nav-->
        <a href='profil-index.php'>Bienvenue</a>
        <a href='discussion.php'>On Dis-cuisine ?</a>
        <a href='deconnexion.php'>Deconnexion</a>
        <!--Nav-->
    </nav>
</header>

<main>

    <section>
        <!--Debut form -->
        <form class="form" method="post" action="profil.php">
            <h1><?php echo $users['login']. " "."Modifie ton profil"; ?>  </h1>
            <div>
                <div>
                    <!-- <label for="login">Login</label>-->
                    <input type="text" name="newlogin" id="login" placeholder="votre login">
                </div>

                <div>
                    <!--<label for="password">Mot de passe</label>-->
                    <input type="password" name="newpassword" id="password" placeholder="Votre mot de passe ">
                </div>

                <input class="submit"  type="submit" name="submit" value="Modifie">
            </div>
            <?php
            if(isset($msg))
            {
                echo $msg;
            }
            if(isset($error))
            {
                echo $error;
            }
            ?>

        </form>
        <!--End form -->

    </section>

    <article class="profil">
        <a href="discussion.php">Discussion</a>
        <a href="deconnexion.php">Deconnexion</a>
    </article>
</main>

<footer>
</footer>

</body>

</html>

<!--End page display -->