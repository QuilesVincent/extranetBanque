<?php
session_start();


//Result is sent when the user changed his informations
if(isset($result)){
    $_SESSION['userName'] = $result['userName'];
    $_SESSION['lastName'] = $result['lastName'];
    $_SESSION['firstName'] = $result['firstName'];
    $_SESSION['id'] = $result['id_user'];
}
if(isset($_GET['dislike'])){
    $error = \DatabaseFunction::writteAlert("Impossible de dislike plus d'une fois", "h2");
};
if(isset($_GET['like'])){
    $error = \DatabaseFunction::writteAlert("Impossible de like plus d'une fois", "h2");
};
?>

            <link href='public/css/headerAccueil&Acteur.css' rel='stylesheet'>
            <link href='public/css/acteur.css' rel='stylesheet'>
            <link href="public/css/footerGeneral.css" rel="stylesheet">
            <!--Ajouter des polices google pour rendre le tout plus jolie-->
            
        </head>

        <body>
        <!--Insertion de l'Header-->
            <?php include('templates/parties/morceaux/general/headerAccueil&Acteur.php'); ?>
            
            <hr />
            <?= isset($error) ? $error : false;?>
            <a href='index.php?controller=actor&task=showBackAllActor&user=<?= htmlspecialchars($_SESSION['id']);?>' class='returnAccueilLien'>Retour à la page accueil</a>
            <!--Insertion de l'acteur, logo + description-->
            <section class='sectionActeur'>
                <?php include('templates/parties/morceaux/actorSelected/insertionActorPageActor.php');?>
            </section>
            <hr />
            <!--Insertion de la partie commentaire + like de l'acteur-->
            <section class='sectionCommentaire'>
                <header class='commentHeader'>
                    <div class='titleHeaderComment'>
                        <h1>Commentaire</h1>
                    </div>
                    <div class='buttonLien'>
                        <div class='lienNewCom'>
                            <div class='aLienNewCom'>
                                <a href='index.php?controlleur=afficheur&task=afficheNewCom&actor=<?php echo htmlspecialchars($actor['id_actor']);?>&user=<?= htmlspecialchars($_SESSION['id']);?>'>Nouveau Commentaire</a>
                            </div>
                        </div>
                        <div class='divFormPostLike'> 
                            <form action='index.php?controller=like&task=modification&actor=<?= htmlspecialchars($actor['id_actor']);?>&idUser=<?= $_SESSION['id'];?>' method='post' class='formPostLike'>
                                <button type='submit' name='like+' class='submitLikePost submitGoodLike'><img src="public/logo/like.png"><?= $actor['like_actor'];?></button>
                                <button type='submit' name='like-' class='submitLikePost submitBadLike'><img src="public/logo/dislike.png"><?= $actor['dislike_actor'];?></button>
                            </form>
                        </div>
                    </div>
                </header>
                <div class='divSectionComment'>
                    <?php include('templates/parties/morceaux/actorSelected/commentInsertion.php') ?>
                </div>
            </section>
            <hr />
            <?php include('templates/parties/morceaux/general/footer.php');?>

        </body>
    </html>

