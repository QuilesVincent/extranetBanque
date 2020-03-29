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