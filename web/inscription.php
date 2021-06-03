<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', 'password');
}
catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}

// Vérification des données 

$req = $bdd->query('SELECT pseudo FROM membres');
//pseudo valide?
while ($pseudos_membres = $req->fetch()) {
  if ($pseudos_membres['pseudo'] == $_POST['pseudo']) {
    die('Erreur : pseudo déjà pris! <br /> <a href="formulaire.php">Retour au formulaire.</a>');
  }
}
//mot de passe valide?
if ($_POST['mdp'] != $_POST['mdp2']) {
  die('Erreur sur votre confirmation de mot de passe! <br /> <a href="formulaire.php">Retour au formulaire.</a>');
}

// On hache le mot de passe 
$hachage_mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

// On envoie en base de données les informations du nouveau membre si tout s'est bien passé
$req = $bdd->prepare('INSERT INTO membres(nom, prenom, pseudo, mdp, mail) VALUES(:nom, :prenom, :pseudo, :mdp, :mail)');
$req->execute(array(
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'pseudo' => $_POST['pseudo'],
    'mdp' => $hachage_mdp,
    'mail' => $_POST['mail'] ));
    
// Retour a l'accueil
  echo 'Inscription réussie!<br /> <a href="connexion.php">Retour à l\'écran de connexion.</a>';

