<?php
#Functions for database ...

function db()

{
    try{
        $bdd=new PDO("mysql:host=localhost;dbname=discussion","root","");
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

    return $bdd;
}

#Functions for strlen login or mdp ... not necessary in this project i did directly in the register page

function length_text($login, $password)
{
    if (strlen($login) <= 6 && strlen($password) <= 6)
    {
        return true;
    }
    else
    {
        return false;

    }
}

#Functions if login exist in database ...

 function login_exist($login)
 {
     $bdd = db();
     $req = $bdd ->prepare('SELECT id FROM utilisateurs WHERE login = ?');  //Request for the verification of login
     $req->execute(array($login));
     $user = $req->rowCount();

     if ($user == 0)
     {
         return true;
     }
     else
     {
         return false;
     }
 }

#Fonction to compare if password == password2

function password($password, $password2)
{
    if ($password == $password2)
    {
        return true;
    }
    else
    {
        return  false;
    }
}


#Functions to insert users information in database ...

function insert_register($password, $login)
{
    $bdd = db();
    $password3 = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10)); //Password security
    $req = $bdd->prepare("INSERT INTO utilisateurs(login, password) VALUES(?, ?)"); //Insert to the database
    $req->execute(array($login, $password3));
    return $req;
}

#Functions for redirect ...

function redirect($url)
{
    header("Location: $url");
}

#Functions for logout ...

function logout()
{
    session_destroy();
    unset($_SESSION['id']);
    return true;
}


#Functions for login page ...

function connexion($login, $password)
{
    $bdd = db();
    $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? ");
    $req->execute(array($login));
    $users=$req->fetch(PDO::FETCH_ASSOC);

    if( $req->rowCount() > 0)
            {
                if(password_verify($password, $users['password']))
                {
                    $_SESSION['id'] = $users['id'];
                    return true;
                }
                else
                {
                    return false;
                }
            }
}


#Function if session

function is_loggedin()
{
    if(isset($_SESSION['id']))
    {
        return true;
    }
}

#Functions for profil ...

function update_login($newlogin)
{
    $bdd = db();
    $req = $bdd->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
    $req->execute(array($newlogin, $_SESSION['id']));
    return true;

}

function update_password($newpassword)
{
    $bdd = db();
    $password3 = password_hash( $newpassword, PASSWORD_BCRYPT, array('cost' => 10));
    $req = $bdd->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
    $req->execute(array($password3, $_SESSION['id']));
    return true;

}

function post_comment($users)
{
    $bdd = db();
    $id_utilisateur = $users["id"];
    $description= htmlspecialchars($_POST["description"]);
    $date=date('Y-m-d h:i:s');

    $req = $bdd->prepare('INSERT INTO messages (message, id_utilisateur, date) VALUES (?,?,?)');
    $req->execute(array( $description, $id_utilisateur,$date));
}


#Functions for discussion page ... not necessary yet

/*function request_display_comment()
{
    $bdd = db();
    $req = $bdd->prepare("SELECT messages.message, messages.date, utilisateurs.login FROM messages INNER JOIN utilisateurs WHERE messages.id_utilisateur = utilisateurs.id ORDER BY messages.id DESC");
    $req->execute();
    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
}

function request_session()
{
    $bdd = db();
    $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ? ");
    $req->execute(array($_SESSION["id"]));
    $users=$req->fetch(PDO::FETCH_ASSOC);
    return true;

}*/
?>