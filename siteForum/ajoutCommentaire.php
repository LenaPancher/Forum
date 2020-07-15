<?php session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$id_billet = $_GET['id_billet'];

// Effectuer ici la requête qui insère le message
if (isset($_POST['message'])) {
    $pseudo = htmlspecialchars($_SESSION['pseudo']);
    $message = htmlspecialchars($_POST['message']);
    $reponse = $bdd->prepare('INSERT INTO commentaires(id_billet, auteur, commentaire, date_commentaire) VALUES(:id_billet, :auteur, :commentaire, NOW()) ');
    $reponse->execute(array(
        'id_billet' => $_GET['id_billet'],
        'auteur' => $pseudo,
        'commentaire' => $message,
    ));
    header('location:' . $_SERVER['HTTP_REFERER']);
}

if (isset($_POST['titre']) && isset($_POST['contenu'])) {
    $titre = htmlspecialchars($_POST['titre']);
    $contenu = htmlspecialchars($_POST['contenu']);
    $reponse = $bdd->prepare('INSERT INTO billets(titre, contenu, date_creation) VALUES(:titre, :contenu, NOW()) ');
    $reponse->execute(array(
        'titre' => $titre,
        'contenu' => $contenu,
    ));
    header('location:' . $_SERVER['HTTP_REFERER']);
}

?>