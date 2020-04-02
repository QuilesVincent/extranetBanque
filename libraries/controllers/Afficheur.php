<?php

namespace Controllers;
require_once('../libraries/autoload.php');

class Afficheur extends \Controllers\Controller
{
    protected $modelName = \Models\Afficheur::class;

    public function __construct()
    {
        parent::__construct();
    }

    public function afficheAccueil()
    {
        $pageTitle = "Accueil";
        \Renderer::render('parties/accueil', compact("pageTitle"));
    }

    public function afficheChangeDonneUser()
    {
        $pageTitle = "Changement d'information de compte utilisateur";
        \Renderer::render('parties/paramUser', compact("pageTitle"));
    }
    public function afficheChangeDonneUserPremiereConnexion()
    {
        $pageTitle = "première connexion";
        \Renderer::render('parties/paramUserPremiereConnexion', compact("pageTitle"));
    }

    public function afficheResetPassword()
    {
        $pageTitle = "Réinitialisation du password";
        \Renderer::render('parties/newPassword', compact("pageTitle"));
    }
    public function afficheNewCom()
    {
        $pageTitle = "Nouveux commentaire";
        \Renderer::render('parties/newCom', compact("pageTitle"));
    }

}