<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', 'password');
}
catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
} 

//  Récupération de l'utilisateur et de son mot de passe haché 
$req = $bdd->prepare('SELECT id, mdp FROM membres WHERE pseudo = :pseudo');
$req->execute(array(
    'pseudo' => $_POST['pseudo']));
$resultat = $req->fetch();

// Comparaison du mdp envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($_POST['mdp'], $resultat['mdp']);

if (!$resultat) {
    echo 'Mauvais identifiant ou mot de passe ! <a href="connexion.php">Retour</a>';
}
else {
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['pseudo'] = $_POST['pseudo'];
        if (isset($_POST['check_box'])) {
          setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true); 
          setcookie('mdp', $resultat['mdp'], time() + 365*24*3600, null, null, false, true);
        }
        header('Location: accueil.php');
    }
    else {
        echo 'Mauvais identifiant ou mot de passe ! <a href="connexion.php">Retour à la page de connexion.</a>';
    }
}
$req->closeCursor();
?>
