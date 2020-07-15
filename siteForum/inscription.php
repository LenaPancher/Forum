<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Mon super blog</title>
    <meta charset="utf-8"/>
</head>
<body>

<?php
if (isset($_SESSION['id'])) {
    include("navConnecter.php");
} else include("navigation.php");
?>

<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=espace_membres;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<div class="container marge">
    <div class="row">
        <div class="col">
            <h1 class="text-center">Inscription</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <form method="post" action="inscription.php">
                <div class="form-group">
                    <input type="text" name="pseudo" id="pseudo" required placeholder="Pseudo">
                </div>
                <div class="form-group">
                    <input type="password" name="pass1" id="pass1" required placeholder="Mot de passe">
                </div>
                <div class="form-group">
                    <input type="password" name="pass2" id="pass2" required placeholder="Retapez votre mot de passe">
                </div>
                <div class="form-group">
                    <input type="email" name="mail" id="mail" required placeholder="Adresse mail">
                </div>
                <div class="form-group">
                    <input type="submit" value="Envoyer">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
// Vérification de la validité des informations
if (isset($_POST['pseudo'], $_POST['pass1'], $_POST['pass2'], $_POST['mail'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $mail = htmlspecialchars($_POST['mail']);

    // Vérification du pseudo et du mail
    $reponse = $bdd->query('SELECT pseudo, email FROM membres WHERE pseudo = "' . $pseudo . '" OR email = "' . $mail . '"');
    if (!$donnees = $reponse->fetch()) {
        // Vérification des mots de passe
        if ($pass1 === $pass2) {
            // Hachage du mot de passe
            $pass_hache = password_hash($pass1, PASSWORD_DEFAULT);
            if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail'])) {
                // Insertion
                $req = $bdd->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass1, :mail, CURDATE())');
                $req->execute(array(
                    'pseudo' => $pseudo,
                    'pass1' => $pass_hache,
                    'mail' => $mail,
                ));
                header('Location: connexion.php');
            } else {
                echo "L'adresse mail n'est pas valide.";
            }
        } else {
            echo "Les deux mots de passe ne sont pas identiques.";
        }
    } else {
        echo "Le compte est déjà crée";
    }
}
?>

</body>
</html>