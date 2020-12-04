<?php
session_start(); //Session connexion
require ('../config/functions.php');

if (is_loggedin())
{
    $bdd = db();
    $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ? ");
    $req->execute(array($_SESSION["id"]));
    $users=$req->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST["submit"]))
    {
        post_comment($users);

    }
}

else
{
    redirect('connexion.php');
}

?>

<!--Debut Display-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/index.css" />
    <title>Commentaires</title>
</head>
<body class="body5">
<header>
<nav class="nav">
<!--Nav PHP-->
<a href='profil-index.php'>Bienvenue</a>
<a href='profil.php'>Profil</a>
<a href='discussion.php'> On Dis-cuisine ?</a>
<a href='deconnexion.php'>Deconnexion</a>
<!--Nav PHP-->
</nav>
</header>
<main>

<section class="flex1">
<img src="../images/pexels.jpg" alt="chat">
<article>

    <article class="scroll">
    <h1><?php echo $users['login'] ." ". "commence à discuter !"; ?> </h1>

    <?php
    
  $req = $bdd->prepare("SELECT messages.message, messages.date, utilisateurs.login FROM messages INNER JOIN utilisateurs WHERE messages.id_utilisateur = utilisateurs.id ORDER BY messages.id DESC");
  $req->execute();
  $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
      foreach  ($resultat as $row)
      {
          $date=date('d/m/Y', strtotime($row["date"]));
          echo "<div class='background'>";
          echo '<div><p><span>'.$row['login'].'</span>' . '<span class="date"> | '. $date . ' </span><br></p></div>';
          echo '<div class="message">'. $row['message']  .'</div>';
          echo "</div>";
      }
    ?>
    </article>

    <article>
        <!--Debut form -->
        <form class="form_discussion" method="post" action="discussion.php">
            <div class="formflex">
                <div>
                    <!--<label for="description">Commentaires</label>-->
                    <textarea id="description" name="description" rows="3" cols="110" placeholder="Ecris !" ></textarea>
                </div>

                <input class="submit1" type="submit" name="submit" value="Commentes !">
            </div>
        </form>
        <!--End form -->
    </article>

    </article>
    </section>

   
    
</main>
<footer>
</footer>
</body>
</html>

<!--End Display-->