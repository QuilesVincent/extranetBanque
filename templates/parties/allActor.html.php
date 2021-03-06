<?php
//If not session, redirect
if(empty($_SESSION['connect'])) {
    \Http::redirect('index.php');
}

if(isset($result)){
    $_SESSION['userName'] = $result['userName'];
    $_SESSION['lastName'] = $result['lastName'];
    $_SESSION['firstName'] = $result['firstName'];
    $_SESSION['id'] = $result['id_user'];
    $_SESSION['connect'] = "yes";
}

?>
            <link href='css/headerAccueil&Acteur.css' rel='stylesheet'>
            <link href='css/accueil.css' rel='stylesheet'>
            <link href="css/footerGeneral.css" rel="stylesheet">
            <!--Ajouter des polices google pour rendre le tout plus jolie-->
            
        </head>

        <body>
            <?php include('../templates/parties/morceaux/general/headerAccueil&Acteur.php'); ?>
            <hr />

            <section class='sectionGBAF'>
                <div class='textGBAFPres'>
                    <h1>Le GBAF</h1>
                    <p>Le GBAF est une entitée regroupant différents acteurs bancaire. Tout d'abord créé pour regrouper différents acteurs bancaire, le GBAF a ensuite décidé de devenir
                    une réelle associations pour répondre aux questionnements des consommateurs. En effet le GBAF permet maintenant de se renseigner plus facilement sur les services bancaires proposés par
                    les acteur bancaire du GBAF</p>
                </div>
                <div class='imageGBAFPresentationDiv'>
                    <img src='image/logo/gbaf.png' alt='Une photo illustrant les bureau de la société GBAF' class='imgGBAFPres'>
                </div>
            </section>
            <hr />

            <section class='sectionActeurs'>
                <div class='partie1Acteur'>
                    <h2>Les acteurs partenaires</h2>
                    <p>Vous trouverez ci-dessous, un descriptif rapide des différentes entités commerciales partenaires. Pour plus d'informations sur chaque acteurs, cliquez
                        sur le lien présent en dessous du nom de l'entité voulu
                    </p>
                </div>
                <div class='partie2Acteur'>
                    <?php include('../templates/parties/morceaux/actor/divActeurInAccueil.php');?>
                </div>
            </section>
            <hr />
            <?php include('../templates/parties/morceaux/general/footer.php');?>

        </body>
    </html>