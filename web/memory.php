<?php 
session_start();
include 'cookie.php';
if (!isset($_SESSION['id']) OR !isset($_SESSION['pseudo'])) {
  header('Location: deconnexion.php');
}
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
        class Card {
            constructor(value) {
                this.value = value;
            }
        }
        var cards_values = [];
        var cards_flip = [];
        var cards_ids = [];
        var cards_flipped;

        var n = 0;
        
        Array.prototype.shuffle = function() {
            let i = this.length;
            let j;
            let temp;
            while (--i > 0) {
                j = Math.floor(Math.random() * (i+1));
                temp = this[j];
                this[j] = this[i];
                this[i] = temp;
            }
        }

        function start(nbr) {
            n = 0;
            document.getElementById('cmpt').innerHTML = '<div>compteur <br>'+n+'</div>';
            cards_values.length = nbr;
            fillArray();
            newBoard();
        }

        function fillArray() {
            for (let i = 0, k = 0; k < (cards_values.length) / 2; ++k) {
                let card = new Card(k);
                cards_values[i] = card.value;
                cards_values[i + 1] = card.value;
                i += 2;
            }
        }

        function newBoard() {
            cards_flipped = 0;
            cards_values.shuffle();
            let imge = '<div id="table"><table class="all_cards"><tr>'; 
            for (let i = 0 ; i < cards_values.length ; ++i) {
                switch (cards_values.length) {
                    case 8:
                        if (i === 4) {
                            imge += '</tr><tr><td><img class="card card0 back" id="card_' + i + '" src="../img_cartes/doscarte.jpg" alt="0" onclick="flip(this, \'' + cards_values[i] + '\')"/></td>';
                            break;
                        }
                        imge += '<td><img class="card card0 back" id="card_' + i + '" src="../img_cartes/doscarte.jpg" alt="0" onclick="flip(this, \'' + cards_values[i] + '\')"/></td>';
                        break;
                    case 12:
                        if (i === 6) {
                            imge += '</tr><tr><td><img class="card card1 back" id="card_' + i + '" src="../img_cartes/doscarte.jpg" alt="0" onclick="flip(this, \'' + cards_values[i] + '\')"/></td>';
                            break;
                        }
                        imge += '<td><img class="card card1 back" id="card_' + i + '" src="../img_cartes/doscarte.jpg" alt="0" onclick="flip(this, \'' + cards_values[i] + '\')"/></td>';
                        break;
                    case 16:
                        if (i === 8) {
                            imge += '</tr><tr><td><img class="card card2 back" id="card_' + i + '" src="../img_cartes/doscarte.jpg" alt="0" onclick="flip(this, \'' + cards_values[i] + '\')"/></td>';
                            break;
                        }
                        imge += '<td><img class="card card2 back" id="card_' + i + '" src="../img_cartes/doscarte.jpg" alt="0" onclick="flip(this, \'' + cards_values[i] + '\')"/></td>';
                        break;
                }
            }
            imge += "</tr></table></div>";
            document.getElementById('board').innerHTML = imge;
        }

        function flipBack () {
            let card0 = document.getElementById(cards_ids[0]);
            let card1 = document.getElementById(cards_ids[1]);
            card0.src = '../img_cartes/doscarte.jpg';
            //card0.className.replace( /(?:^|\s)front(?!\S)/g , "" );
            //card0.className += "back";
            card1.src = '../img_cartes/doscarte.jpg';
            //card1.className.replace( /(?:^|\s)front(?!\S)/g , "" );
            //card1.className += "back";
            cards_flip = [];
            cards_ids = [];
        }

        function end () {
            alert("Terminé, vous avez fait un score de "+n+"");
            document.getElementById('board').innerHTML = "";
            newBoard();
            n = 0;
        }
        function sauv () {
            document.getElementById('code').value = document.getElementById('table').innerHTML;
            document.getElementById('CF').value = cards_flipped;
            document.getElementById('cpt').value = n;
            document.getElementById('taille').value = cards_values.length;

        }
        function flip(carte, valeur) {
            if (carte.innerHTML === "" && cards_flip.length < 2) {
                carte.src = '../img_cartes/carte' + valeur + '.png';
                carte.alt = valeur;
                //carte.className.replace( /(?:^|\s)back(?!\S)/g , "" );
                //carte.className += "front";
                //var card = document.querySelector('.all_cards');
                //card.classList.toggle('is-flipped');
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
                        if (cards_flipped === cards_values.length) {
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
    <div class="button">
      <h2>Choisissez un niveau</h2>
      <button onclick="start(8)" name="facile">Easy</button>
      <button onclick="start(12)" name="moyen">Medium</button>
      <button onclick="start(16)" name="dur">Hard</button>
    </div>
    <div id="board"></div>
    <p id="cmpt"></p>
    <form action="sauvegarde.php" method="post">
    <input id="code" name="code" type="hidden" value="" />
    <input id="CF" name="CF" type="hidden" value="" />
    <input id="cpt" name="cpt" type="hidden" value="" />
    <input id="taille" name="taille" type="hidden" value="" />
    <input type="submit" value="Sauvegarder" onclick="sauv()" />
    </form>
</body>
</html>
