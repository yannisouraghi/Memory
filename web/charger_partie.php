<?php
 
session_start();
include 'cookie.php';
if (!isset($_SESSION['id']) OR !isset($_SESSION['pseudo'])) {
  header('Location: deconnexion.php');
}
// connexion base de donnée 
try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', 'password');
}
catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}
// On va chercher en base de donnée la derniere partie sauvegardée par le joueur
$req = $bdd->prepare('SELECT code, cpt, cf, taille  FROM sauvegarder 
                                                  WHERE id_pseudos = :pseudo
                                                  ORDER BY ID DESC');
$req->execute(array('pseudo' => $_SESSION['id']));
$code = $req->fetch();

?>
<!DOCTYPE html>
<html>
<head>
<title> Memory</title>
<meta charset ="utf-8" />
    <link rel="stylesheet" href="memory.css"/>
    <link rel="stylesheet" href="connexion.css" />
    <script>
        "use strict";
        var recup2 = <?php echo json_encode($code['cpt']); ?>;
        var recup3 = <?php echo json_encode($code['cf']); ?>;
        var recup4 = <?php echo json_encode($code['taille']); ?>;
        class Card {
            constructor(value) {
                this.value = value;
            }
        }
        var cards_flip = [];
        var cards_ids = [];
        var cards_flipped = parseInt(recup3);
        var n = recup2;

        function flipBack () {
            let card0 = document.getElementById(cards_ids[0]);
            let card1 = document.getElementById(cards_ids[1]);
            card0.src = '../img_cartes/doscarte.jpg';
            card1.src = '../img_cartes/doscarte.jpg';
            cards_flip = [];
            cards_ids = [];
        }

        function end () {
            alert("Terminé, vous avez fait un score de "+n+"");  
        }
        function sauv () {
            document.getElementById('code').value = document.getElementById('table').innerHTML;
        }
        function flip(carte, valeur) {
            if (carte.innerHTML === "" && cards_flip.length < 2) {
                carte.src = '../img_cartes/carte' + valeur + '.png';
                carte.alt = valeur;
                if (cards_flip.length === 0) {
                    cards_flip.push(valeur);
                    cards_ids.push(carte.id);
                } else if (cards_flip.length === 1) {
                    ++n;
                    document.getElementById('cmpt').innerHTML = '<div>compteur <br>'+n+'</div>';
                    cards_flip.push(valeur);
                    cards_ids.push(carte.id);
                    if (cards_flip[0] === cards_flip[1]) {
                        document.getElementById(cards_ids[0]).removeAttribute('onclick');
                        document.getElementById(cards_ids[1]).removeAttribute('onclick');
                        cards_flipped += 2;
                        cards_flip = [];
                        cards_ids = [];
                        if (cards_flipped === parseInt(recup4)) {
                            setTimeout(end, 200);
                        }
                    } else {
                        setTimeout(flipBack, 600);
                    }
                }
            }
        }
    </script>
</head>
<body>
<nav>
    <ul>
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="connexion.php">Connexion</a></li>
    </ul>
</nav>
    <div id="board"></div>
    <script>
      var recup1 = <?php echo json_encode($code['code']); ?>;
      document.getElementById('board').innerHTML = recup1;
      document.getElementById('cmpt').innerHTML = '<div>compteur <br>'+n+'</div>';
    </script>
    <p id="cmpt"></p>
</body>
</html>
