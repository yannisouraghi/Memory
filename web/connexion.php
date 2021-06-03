<!DOCTYPE html>

<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Projet - Page d'accueil</title>
    <link rel="stylesheet" href="connexion.css" />
  </head>
  
  <body id="background">
    <nav>
      <ul>
        <li><a href="formulaire.php">Inscription</a></li>
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="connexion.php">Connexion</a></li>
      </ul>
    </nav>
    <header>
      <h1>Jeu du mémory</h1>
      
      <h2 id="intro"> Bienvenue sur le Jeu du mémory pour 1 joueur! Essayez de
retourner les cartes en un nombre de tours le plus petit possible!  </h2>
    </header>
    <section>
      <div id="login">
        <fieldset id="field">
          <legend>
            Authentification
          </legend>  
          <h3>Entrez votre pseudo et votre mot de passe:</h3> <br />
          <form class="login" action="connexion2.php" method="post">
            <p>
              Pseudo :
              <input type="text" name="pseudo" /> <br />
              Mot de passe :
              <input type="password" name="mdp" /> <br />
              Connexion automatique : 
              <input type="checkbox" name="check_box" /> <br />
              <input type="submit" value="Se connecter" />
              </p>
          </form>
        </fieldset>
      </div>
    </section>

  </body>
</html>
