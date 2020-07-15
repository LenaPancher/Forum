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
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

?>
<div class="blog">
    <div class="container">
        <div class="row">
            <div class="col billet">
                <?php
                $reponse = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%i") AS date_creation_fr FROM billets WHERE id = "' . $_GET['id_billet'] . '" ');
                $donnees = $reponse->fetch()
                ?>
                <div class="news">
                    <h3> <?php echo $donnees['titre'] . " le " . $donnees['date_creation_fr'] ?> </h3>
                    <p> <?php echo $donnees['contenu'] ?> <br/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-left">
                <p><a href="accueilProfil.php">Retour à liste des billets</a></p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 commentaire">
                <h2>Commentaires</h2>
                <?php
                $reponse = $bdd->query('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, "%d/%m/%Y à %Hh%i") as date_commentaire FROM commentaires WHERE id_billet = "' . $_GET['id_billet'] . '" ORDER BY date_commentaire ASC');
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <p><strong><?php echo $donnees['auteur'] ?></strong> : <?php echo $donnees['date_commentaire'] ?>
                    </p>
                    <p><?php echo $donnees['commentaire'] ?></p>
                    <?php
                }

                ?>
            </div>
            <div class="col-12 ajout_commentaire">
                <h2>Ajouter un commentaire :</h2>
                <form method="post" action="ajoutCommentaire.php?id_billet=<?= $_GET['id_billet'] ?>">
                    <p>
                        <input type="text" name="message" id="message" required placeholder="Message...">
                    </p>
                    <p>
                        <input type="submit" value="Envoyer" id="envoyer">
                    </p>

                </form>
            </div>
        </div>
    </div>
</div>


</body>
</html>
