            <link href='css/newPassword.css' rel='stylesheet'>
            <link href="css/footerGeneral.css" rel="stylesheet">
            <!--Ajouter des polices google pour rendre le tout plus jolie-->
            
        </head>

        <body>
        <header>
            <h1>GBAF</h1>
            <p>Une solution pour trouver le service qui vous correspond</p>
        </header>
        <div class="divForm">

            <?= isset($_GET['errP']) ? \DatabaseFunction::writteAlert("Erreur dans les champs rentrés", "h2") : (isset($_GET['emptyField']) ? \DatabaseFunction::writteAlert("Tous les champs doivent êtres remplis", "h2") : "<h2> Changez votre mot de passe </h2>");?>

            <form action='index.php?controllers=user&task=modifPassword' method='post' class='NewPasswordForm'>

                <div class='userNameDiv'>
                    <!--<label for='userName' class='userNameLabel'>Tapez votre UserName</label>-->
                    <input type='text' name='userName' placeholder='UserName' class='userName'>
                </div>
                <div class='secretQuestionDiv'>
                    <!--<label for='secretQuestion' class='labelSecretQuestion'>Selectionnez votre question secrète</label>-->
                    <select name='secretQuestion' class='secretQuestion'>
                        <option value='1'>Quelle est le nom de jeune fille de votre mère ?</option>
                        <option value='2'>Quel est le prénom de votre animal de compagnie ?</option>
                        <option value='3'>Quel est le nom de votre hacker préféré ?</option>
                        <option value='4'>Quel est le nom de votre entrepreneur préféré</option>
                    </select>
                </div>
                <div class='secretQuestionAnswer'>
                    <!--<label for='secretQuestionAnswer' class='labelSecretQuestionAnswser'>Réponse</label>-->
                    <input type='text' name='secretQuestionAnswer' class='answerSecretQuestion' placeholder="Réponse à la question selectionné au dessus">
                </div>
                <div class='passwordDiv'>
                    <!--<label for='password' class='labelPassword'>Tapez votre nouveau mot de passe</label>-->
                    <input type='password' name='password' class='password' placeholder="Password">
                </div>
                <div class="submitDiv">
                    <button type='submit' name='submit' class='submit'>Valider</button>
                    <a href="index.php">Annuler</a>
                </div>
            </form>
        </div>
        <?php include('../templates/parties/morceaux/general/footer.php');?>

        </body>
    </html>