<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Morpion</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php

include 'functions.php';

if (empty($_SESSION['grille'])) {
  $_SESSION['grille'] = array(
    "a1" => "_",
    "a2" => "_",
    "a3" => "_",
    "b1" => "_",
    "b2" => "_",
    "b3" => "_",
    "c1" => "_",
    "c2" => "_",
    "c3" => "_",
  );
}

if (empty($_SESSION['last_move'])) {
  $_SESSION['last_move'] = "_";
}
if (empty($_SESSION['last_player'])) {
  $_SESSION['last_player'] = "_";
}
if (empty($_SESSION['turn'])) {
  $_SESSION['turn'] = 0;
}

if (isset($_GET['move'])) {
  $_SESSION['grille'][$_GET['move']] = "X";
  $_SESSION['last_player'] = "human";
  $_SESSION['last_move'] = $_GET['move'];
  $_SESSION['turn'] = $_SESSION['turn']+1;
}


if (getWinner($_SESSION['grille'])) {
  echo '<br> On a un gagnant <br>';
  grille($_SESSION['grille']);
  die();
} else {
  echo '<br> On continu <br>';
}

// si l'IA peut gagner => gagner
if (!empty(IACanWin($_SESSION['grille']))) {
  $_SESSION['grille'][IACanWin($_SESSION['grille'])] = "O";
  $_SESSION['last_player'] = "ia";
  $_SESSION['turn'] = $_SESSION['turn']+1;
  if (getWinner($_SESSION['grille'])) {
    echo '<br> On a un gagnant <br>';
    grille($_SESSION['grille']);
    die();
  }
} elseif (!empty(playerCanWin($_SESSION['grille']))) {
  // si le joueur peut gagner => le bloquer
  $_SESSION['grille'][playerCanWin($_SESSION['grille'])] = "O";
  $_SESSION['last_player'] = "ia";
  $_SESSION['turn'] = $_SESSION['turn']+1;
} else {
  // sinon => chercher le meilleur placement

  // mais pour l'instant joue au hasard.
  if ($_SESSION['last_player'] == "human") {
    $_SESSION['grille'][checkBestMove($_SESSION['grille'], $_SESSION['turn'])] = "O";
    $_SESSION['turn'] = $_SESSION['turn']+1;
  }
}



// Debug : affichage du tableau
debug($_SESSION);
grille($_SESSION['grille']);
// checkBestMove($_SESSION['grille'])

?>

</body>
</html>
