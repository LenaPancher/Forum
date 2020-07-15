<?php
session_start();
?>

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
            <h1 class="text-center">Connexion</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <form action="connexion.php" method="post">
                <div class="form-group">
                    <input type="text" name="pseudo" id="pseudo" required placeholder="Pseudo">
                </div>
                <div class="form-group">
                    <input type="password" name="pass" id="pass" required placeholder="Mot de passe">
                </div>
                <div class="form-group">
                    <input type="submit" value="Se connecter"
                </div>
            </form>
        </div>
    </div>
</div>

<?php

//  Récupération de l'utilisateur et de son pass hashé
if (isset($_POST['pseudo'], $_POST['pass'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $reponse = $bdd->prepare('SELECT id, pass FROM membres WHERE pseudo = :pseudo');
    $reponse->execute(array(
        'pseudo' => $pseudo));
    $resultat = $reponse->fetch();

    // Comparaison du pass envoyé via le formulaire avec la base
    $isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);

    if ($isPasswordCorrect) {
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['pseudo'] = $pseudo;
        header('Location: accueilProfil.php');
    } else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}

?>

</body>
</html>
