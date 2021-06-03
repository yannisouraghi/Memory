<?php   // Vérifie dans accueil.php et memory.php s'il existe des cookies pour la connexion automatique

// On vérifie si il existe un cookie pour le pseudo et un pour le mot de passe haché
if (isset($_COOKIE['pseudo']) AND isset($_COOKIE['mdp'])) {
 
  // Lecture en base de donnée 
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', 'password');
  }
  catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
  }
  $req = $bdd->prepare('SELECT id, pseudo, mdp FROM membres WHERE pseudo = :pseudo');
  $req->execute(array(
    'pseudo' => $_COOKIE['pseudo']));
  $resultat = $req->fetch();
  // On teste si le pseudo et le mdp haché dans les cookies sont dans la base de donnée
  if ($resultat['pseudo'] == $_COOKIE['pseudo'] AND $resultat['mdp'] == $_COOKIE['mdp']) {
    //si oui on affecte les cookies aux variables de session
    $_SESSION['id'] = $resultat['id'];
    $_SESSION['pseudo'] = $resultat['pseudo'];
  }
  $req->closeCursor();
}    
