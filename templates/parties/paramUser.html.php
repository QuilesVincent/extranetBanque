<?php

session_start();
$idUser = $_GET['user'];
$idUserSafe = htmlspecialchars($idUser);

$cheminAccueil = "index.php?controllers=actor&task=showBackAllActor&user=$idUserSafe";
$road = $cheminAccueil;

if(isset($_GET['actor'])){
    $idActor = $_GET['actor'];
    $cheminActor = "index.php?controllers=actor&task=showOneSelected&user=$idUserSafe&actor=$idActor";
    $road = $cheminActor;
};



?>

            <link href="css/paramUser.css" rel="stylesheet">
            <link href="css/footerGeneral.css" rel="stylesheet">
        </head>
        <body>
            <header class='principalHeader'>
                <h1>Page de changement d'information de votre compte perso</h1>
                <p>Le monde de la finance s'ouvre bientôt à vous</p>
                <a href=<?= $road;?>>Retour à la page précédente</a>
            </header>
            <div class="divForm">
                <?= isset($_GET['uname']) ? \DatabaseFunction::writteAlert("L'username n'est pas disponible", "h2") : false; ?>
                <?= isset($_GET['field']) ? \DatabaseFunction::writteAlert("Tous les champs doivent être remplis", "h2") : false; ?>
                <form action='index.php?controller=actor&task=showBack&user=<?=$idUserSafe ;?><?= isset($_GET['actor']) ? "&actor=$idActor" : "" ;?>' method='post' class='changeUserFormContent'>
                    <div class='firstLastNameContent'>
                        <input type='text' name='firstNameChangeUser' placeholder="Nouveau Prénom" class="inputForm">
                        <input type='text' name='lastNameChangeUser' placeholder="Nouveau Nom" class="inputForm inputName">
                    </div>
                    <div class='userNameChangeUserContent'>
                        <input type='text' name='userNameChangeUser' placeholder='Nouveau UserName' class='userNameChangeUser inputForm'>
                    </div>
                    <div class="passwordUserContent">
                        <input type='password' name='passwordChangeUser' placeholder="Nouveau Mot de passe" class='passwordChangeUser inputForm'>
                    </div>
                    <div class="secretQuestionContent">
                        <select name='secretQuestionChangeUser' class='secretQuestion inputForm'>
                        <option value='1'>Quelle est le nom de jeune fille de votre mère ?</option>
                        <option value='2'>Quel est le prénom de votre animal de compagnie ?</option>
                        <option value='3'>Quel est le nom de votre hacker préféré ?</option>
                        <option value='4'>Quel est le nom de votre entrepreneur préféré</option>
                    </select>
                    </div>
                    <div class="secretQuestionAnswerContent">
                        <input type='text' name='secretQuestionAnswerChangeUser' class='answerSecretQuestionChangeUser inputForm' placeholder="Nouvelle réponse à la question selectionné au dessus">
                    </div>
                    <button type='submit' name='submitChangeUser' class='submitChangeUser'>Valider</button>
                </form>
            </div>
            <?php include('../templates/parties/morceaux/general/footer.php');?>

        </body>
    </html>

