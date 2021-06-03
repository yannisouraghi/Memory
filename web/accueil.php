<?php 
session_start();
include 'cookie.php';
if (!isset($_SESSION['id']) OR !isset($_SESSION['pseudo'])) {
  header('Location: deconnexion.php');
}
?>
<!DOCTYPE html>

<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Projet - Accueil</title>
    <link rel="stylesheet" href="accueil.css" />
    <link rel="stylesheet" href="connexion.css" />
  </head>
  
  <body>
   <nav>
     <ul>
       <li><a href="deconnexion.php">Deconnexion</a></li>
       <li><a href="accueil.php">Accueil</a></li>
       <li><a href="connexion.php">Connexion</a></li>
     </ul>
   </nav>
   <h2 id="bvn">Bienvenue <?php echo $_SESSION['pseudo']; ?> </h2>
   <p id="abr" title="Toutes les cartes sont étalées faces cachées. Un premier
          joueur retourne deux cartes. Si c'est la même image qui apparaît sur les deux
          cartes, le joueur gagne les cartes et en retourne à nouveau deux. Si les deux
          cartes ne vont pas ensemble, les cartes se retournent face cachée à l'endroit
          exact où elles étaient. Le joueur gagne quand toutes les
          cartes sont retournées." onclick="pushregle()">
          Règles du jeu
          <script>
            function pushregle() {
              let a = document.getElementById('abr');
              a.id = "abr2";
              a.innerHTML = a.title;
              a.onclick = popregle;
            }
            function popregle() {
              let a = document.getElementById('abr2');
              a.id = "abr";
              a.innerHTML = "Règles du jeu";
              a.onclick = pushregle;
            }
          </script>
    </p>
   <div class="jeu">
     <a class="button" href="memory.php">
      <button id="b1" value="jeu">Jouer au jeu du memory</button>
     </a>
       <a class="button" href="charger_partie.php">
        <button id="b2" value="sauv">Charger l'ancienne partie</button>
       </a>
   </div>
  </body>
</html>
