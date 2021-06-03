<?php
session_start();
if (!isset($_SESSION['id']) AND !isset($_SESSION['pseudo'])) {
  echo 'Vous n\'êtes pas connecté au site! Veuillez vous <a href="connexion.php"> connecter</a>.';
}

else {
// Suppression des variables de session et de la session
  $_SESSION = array();
  session_destroy();

// Suppression des cookies de connexion automatique
  setcookie('pseudo', '');
  setcookie('mdp', '');

// Retour au menu de connexion
  echo 'Vous vous êtes bien déconnecté! <a href="connexion.php">Retour au menu de connexion</a>';
}
?>
