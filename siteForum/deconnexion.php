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

<div class="container marge">
    <div class="row">
        <div class="col">
            <h1 class="text-center">Déconnexion</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <p>Voulez-vous vriament vous déconnecter ?</p>
            <form method="post" action="deconnexion.php">
                <input type="submit" name="submit" value="Se déconnecter">
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    // Suppression des variables de session et de la session
    $_SESSION = array();
    session_destroy();

// Suppression des cookies de connexion automatique
    setcookie('login', '');
    setcookie('pass_hache', '');

    header('Location:index.php');
}
?>

</body>
</html>

