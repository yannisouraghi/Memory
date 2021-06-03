<?php
session_start();
include 'cookie.php';
if (!isset($_SESSION['id']) OR !isset($_SESSION['pseudo'])) {
  header('Location: deconnexion.php');
}
try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', 'password');
}
catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}
$req1 = $bdd->prepare('INSERT INTO sauvegarder(code, cpt, cf, taille, id_pseudos) VALUES(:code, :cpt, :cf, :taille, :id_pseudos)');
$req1->execute(array(
  'code' => $_POST['code'],
  'cpt' => $_POST['cpt'],
  'cf' => $_POST['CF'],
  'taille' => $_POST['taille'],
  'id_pseudos' => $_SESSION['id']));
  
// Retour à l'accueil
header('Location: accueil.php');

?>
