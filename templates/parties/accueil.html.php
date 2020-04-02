<!DOCTYPE html>
    <html lang="fr">
        <head>
            <title>Inscription/connexion</title>
            <meta charset='utf-8'>
            <link href='css/connexionInscription.css' rel='stylesheet'>
            <link href="css/footerGeneral.css" rel="stylesheet">
            
        </head>

        <body>
            <header>
                <div class='titleName'>
                    
                    <div class="img_contener">
                        <img src="image/logo/gbafMiniature.png">
                    </div>
                </div>
                <!--Affichage du formulaire de connexion -->
                <div class='connexionFormContent'>
                <?php
//Affichage d'un type de formulaire en fonction de mauvais mdp (ou username) renseigné
if(empty($_GET['errConnexion']))
                    {?>
                    <form action='index.php?controllers=actor&task=showAll' method='post' class='connexionForm'>
                        <div class='mailConnexionContent'> <!-- variable class à changer par userName au lie de mail-->
                            <label for='userNameConnexion'>UserName</label>
                            <input type='text' name='userNameConnexion' id='inputUserNameConnexion'>
                        </div>
                        <div class='passwordConnexionContent'>
                            <label for='passwordConnexion'>Mot de passe</label>
                            <input type='password' name='passwordConnexion' id='inputPasswordConnexion'>
                            <a href='index.php?controllers=afficheur&task=afficheResetPassword'>Mot de passe oublié ?</a>
                        </div>
                        <div class='buttonConnexionContent'>
                            <input type='submit' name='submitConnexion' value='connexion'></button>
                        </div>
                    </form>
                    <?php
                    }
                    else
                    {?>
                    <form action="index.php?controllers=actor&task=showAll" method='post' class='connexionForm'>
                        <div class='mailConnexionContent'> <!-- variable class à changer par userName au lie de mail-->
                            <label for='userNameConnexion'>UserName</label>
                            <input type='text' name='userNameConnexion' id='inputUserNameConnexion' placeholder="Erreurs d'identifiants">
                        </div>
                        <div class='passwordConnexionContent'>
                            <label for='passwordConnexion'>Mot de passe</label>
                            <input type='password' name='passwordConnexion' id='inputPasswordConnexion'>
                            <a href='index.php?controllers=afficheur&task=afficheResetPassword'>Mot de passe oublié ?</a>
                        </div>
                        <div class='buttonConnexionContent'>
                            <input type='submit' name='submitConnexion' value='connexion'></button>
                        </div>
                    </form>
                    <?php
                    }?>
                </div>
            </header>
            <section class='inscriptionSection'>
                <div class='partieEsthetique'>
                    <div class='partieEsthetiqueContent'>
                        <h1>LE GBAF</h1>
                        <h2>Une solution pour trouver le service qui vous correspond</h2>
                        <p>Pour gagner vraiment de l'argent, il faut effectuer les recherches et trouver
                            les bons placements. Pour conserver toute la satisfaction de vos clients, voici un site vous permettant
                            d'effectuer le travail à leur place
                        </p>
                    </div>  
                </div>
              
            </section>
        <?php include('../templates/parties/morceaux/general/footer.php');?>
        </body>
    </html>