<!DOCTYPE html>

<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Projet - Page d'inscription</title>
    <link rel="stylesheet" href="formulaire.css" />
    <link rel="stylesheet" href="connexion.css" />
  </head>
    
  <body>
    <nav>
      <ul>
       <li><a href="formulaire.php">Inscription</a></li>
       <li><a href="accueil.php">Accueil</a></li>
       <li><a href="connexion.php">Connexion</a></li>
     </ul>
    </nav>
    <fieldset>
      <legend>
        Veuillez remplir le formulaire ci-dessous.
      </legend>
      <form action="inscription.php" method="post" class="form">
        <p class="truc">
          Nom : <input type="text" name="nom"/> <br />
          Prénom : <input type="text" name="prenom" /> <br />
          Pseudo : <input type="text" name="pseudo" required="required" /> <br />
          Mot de passe : <input type="password" name="mdp" required="required"/> <br />
          Confirmer le mot de passe : <input type="password" name="mdp2" required="required" /> <br />
          Mail : <input type="email" name="mail" /> <br />
          <input type="submit" value="Valider" />
        </p>
      </form>
    </fieldset>
  </body>
</html>
