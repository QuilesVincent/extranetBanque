<?php
session_start();
$_SESSION = array();
session_destroy();
header('Location:../partie_1_inscription_connexion/pageInscriptionConnexion.php');

?>