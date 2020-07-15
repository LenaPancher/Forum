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
            <div class="col-12 billet">
                <?php
                $reponse = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%i") AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5');
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <div class="news">
                        <h3> <?php echo htmlspecialchars($donnees['titre']) . " le " . $donnees['date_creation_fr'] ?> </h3>
                        <p> <?php echo htmlspecialchars($donnees['contenu']) ?> <br/>
                            <a href="commentaire.php?id_billet=<?php echo $donnees['id'] ?>"><i>Commentaires</i></a></p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center commentaire">
                <h2>Ajouter un sujet :</h2>
                <form method="post" action="ajoutCommentaire.php">
                    <div class="form-group">
                        <input type="text" name="titre" id="titre" required placeholder="Titre du sujet">
                    </div>
                    <div class="message">
                        <textarea name="contenu" id="contenu" required rows="3" placeholder="Message..."></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Envoyer" id="envoyer">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
