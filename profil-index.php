<?php
session_start(); //Session connexion
require ('functions.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/index.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Que voulez-vous faire ?</title>
</head>
<body class="body3">
<header>
<nav class="nav">

<!--Nav PHP-->
<a href='profil-index.php'>Bienvenue</a>
<a href='profil.php'>Profil</a>
<a href='discussion.php'> On DIScuisine ?</a>
<a href='deconnexion.php'>Deconnexion</a>


<!--Nav PHP-->

</nav>
</header>
<main>
    <article class="profil_index_a">
       
        <?php
        if (is_loggedin()) {
        $bdd = db();
        $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ? ");
        $req->execute(array($_SESSION["id"]));
        $users=$req->fetch(PDO::FETCH_ASSOC);
        
            echo "<h1>Bienvenue " . $users['login'] . " ! </h1>

                    <a href='profil.php'>Modifier votre profil</a><br/>
					<a href='discussion.php'>Discussion</a><br/>
					<a href='deconnexion.php'>Se déconnecter</a>";
        } else {
            redirect("connexion.php");
        }
        ?>
         <p>
        Les recettes du monde sont toujours à la mode . Envie de faire un petit tour du globe ? Voyagez à 
        travers nos nombreuses recettes étrangères et découvrez les saveurs du monde. Prenez place à une table en Inde, 
        au Japon, en Chine, au Maghreb, en Italie, en Grèce, aux Etats-Unis… Les recettes du monde s’invitent chez vous.
        Discutez avec tous les passionnés du globe !
        </p>
    </article>

</main>
<footer></footer>
</body>
</html>
