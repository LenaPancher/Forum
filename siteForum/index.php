<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Forum</title>
</head>

<body>

<?php
if (isset($_SESSION['id'])) {
    include("navConnecter.php");
} else include("navigation.php");
?>

<div class="fond">
    <div><img src="fond.png"></div>
</div>
<div class="container">
    <div class="row presentation">
        <div class="col-12 col-lg-4">
            <div class="card">
                <img class="card-img-top" src="interview.png" alt="echanger" height="300">
                <div class="card-body">
                    <h5 class="card-title">Créer ou rejoignez un sujet de discussion !</h5>
                    <p class="card-text">Besoin de s'exprimer ? <span
                                class="font-weight-bold">Démarrer des conversations</span> en publiant
                        des blogs ou <span class="font-weight-bold">participer à des discussions</span> existantes
                        en répondant à des posts.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <img class="card-img-top" src="speak.png" alt="discussion" height="300">
                <div class="card-body">
                    <h5 class="card-title">Échanger et discuter entre vous ! </h5>
                    <p class="card-text">Vous souhaitez <span
                                class="font-weight-bold">donner ou avoir des conseils</span>,
                        <span class="font-weight-bold"> échanger sur des passions</span>, vous aimeriez une
                        <span class="font-weight-bold">réponse à vos question ?</span> N'hésitez pas !</p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
