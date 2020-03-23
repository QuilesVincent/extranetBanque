<?php

session_start();
if(isset($result)){
    $_SESSION['userName'] = $result['userName'];
    $_SESSION['lastName'] = $result['lastName'];
    $_SESSION['firstName'] = $result['firstName'];
    $_SESSION['id'] = $result['id_user'];
}

?>
            <link href='public/css/headerAccueil&Acteur.css' rel='stylesheet'>
            <link href='public/css/accueil.css' rel='stylesheet'>
            <link href="public/css/footerGeneral.css" rel="stylesheet">
            <!--Ajouter des polices google pour rendre le tout plus jolie-->
            
        </head>

        <body>
            <?php include('templates/parties/morceaux/general/headerAccueil&Acteur.php'); ?>
            <hr />

            <section class='sectionGBAF'>
                <div class='textGBAFPres'>
                    <h1>Le GBAF</h1>
                    <p>Le GBAF est donc une entité commerciale balablabalbalablabalbalblabalabalalbalablabalablablababablba balablabalbalablabalbalblabalabalalbalablabalablablababablba balablabalbalablabalbalblabalabalalbalablabalablablababablba
                        balablabalbalablabalbalblabalabalalbalablabalablablababablba balablabalbalablabalbalblabalabalalbalablabalablablababablba balablabalbalablabalbalblabalabalalbalablabalablablababablba
                    </p>
                </div>
                <div class='imageGBAFPresentationDiv'>
                    <img src='public/logo/gbaf.png' alt='Une photo illustrant les bureau de la société GBAF' class='imgGBAFPres'>
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
                    <?php include('templates/parties/morceaux/actor/divActeurInAccueil.php');?>
                </div>
            </section>
            <hr />
            <?php include('templates/parties/morceaux/general/footer.php');?>

        </body>
    </html>