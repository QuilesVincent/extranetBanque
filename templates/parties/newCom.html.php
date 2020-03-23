<?php

$idActor = $_GET['actor'];
$idUser = $_GET['user'];
session_start();

?>



<!DOCTYPE html>
    <html>
        <head>
            <title>Comment Actor</title>
            <meta charset='utf-8'>
            <link href='public/css/headerAccueil&Acteur.css' rel='stylesheet'>
            <link href='public/css/newCom.css' rel='stylesheet'><!--Faire fichier css-->
            <link href="public/css/footerGeneral.css" rel="stylesheet">
            <!--Ajouter des polices google pour rendre le tout plus jolie-->
            
        </head>

        <body>
        <!--Insertion de la partie header-->
            <?php include('templates/parties/morceaux/general/headerAccueil&Acteur.php'); ?>
            <hr />
        <!--Insertion du formulaire pour écrire le commentaire-->
            <div class="divForm">
                <!-- Message d'erreur si nécessaire,si com vide ou déjà posté -->
                <?= isset($_GET['comAlready']) ? \DatabaseFunction::writteAlert("Vous avez déjà posté un commentaire", "h1") : (isset($_GET['comEmpty']) ? \DatabaseFunction::writteAlert("Le commentaire ne peut être vide", "h1") : "<h1> Ecrivez le commentaire voulu </h1>");?>
                <form action='index.php?controller=actor&task=showBack&actor=<?php echo htmlspecialchars($idActor);?>&user=<?php echo htmlspecialchars($idUser);?>' method='post'>
                    <div class="divContentComment">
                        <textarea name='contentCom'></textarea>
                    </div>
                    <div class="divSubmit">
                        <button type='submit' name='submitCom' class='submitCom'>Valider</button>
                        <a href="index.php?controller=actor&task=showOneSelected&actor=<?php echo htmlspecialchars($idActor). "&user=".htmlspecialchars($idUser)?>">Annuler</a>
                    </div>

                </form>
            </div>
        <?php include('templates/parties/morceaux/general/footer.php');?>
        </body>
    </html>