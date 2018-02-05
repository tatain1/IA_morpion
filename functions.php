<?php

// =====================
// FONCTIONS D'AFFICHAGE
// =====================
function debug($array) {
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

function grille($array) {
  echo '<table>';
  echo '<tr>';
  echo '<td><a href="index.php?move=a1">'. $array['a1']. '</a></td>';
  echo '<td><a href="index.php?move=a2">'. $array['a2']. '</a></td>';
  echo '<td><a href="index.php?move=a3">'. $array['a3']. '</a></td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td><a href="index.php?move=b1">'. $array['b1']. '</td>';
  echo '<td><a href="index.php?move=b2">'. $array['b2']. '</td>';
  echo '<td><a href="index.php?move=b3">'. $array['b3']. '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td><a href="index.php?move=c1">'. $array['c1']. '</td>';
  echo '<td><a href="index.php?move=c2">'. $array['c2']. '</td>';
  echo '<td><a href="index.php?move=c3">'. $array['c3']. '</td>';
  echo '</tr>';
  echo '</table>';
  echo '<a href="raz.php">RAZ</a>';
}

// =====================================
// FONCTIONS DE VERIFICATION DE VICTOIRE
// =====================================
function winRow($grille) {
  if ($grille['a1'] != "_" && $grille['a2'] != "_" && $grille['a3'] != "_") {
    if ($grille['a1'] == $grille['a2'] && $grille['a1'] == $grille['a3']) {
      return true;
    }
  }
  if ($grille['b1'] != "_" && $grille['b2'] != "_" && $grille['b3'] != "_") {
    if ($grille['b1'] == $grille['b2'] && $grille['b1'] == $grille['b3']) {
      return true;
    }
  }
  if ($grille['c1'] != "_" && $grille['c2'] != "_" && $grille['c3'] != "_") {
    if ($grille['c1'] == $grille['c2'] && $grille['c1'] == $grille['c3']) {
      return true;
    }
  }
}

function winColumn($grille) {
  if ($grille['a1'] != "_" && $grille['b1'] != "_" && $grille['c1'] != "_") {
    if ($grille['a1'] == $grille['b1'] && $grille['a1'] == $grille['c1']) {
      return true;
    }
  }
  if ($grille['a2'] != "_" && $grille['b2'] != "_" && $grille['c2'] != "_") {
    if ($grille['a2'] == $grille['b2'] && $grille['a2'] == $grille['c2']) {
      return true;
    }
  }
  if ($grille['a3'] != "_" && $grille['b3'] != "_" && $grille['c3'] != "_") {
    if ($grille['a3'] == $grille['b3'] && $grille['a3'] == $grille['c3']) {
      return true;
    }
  }
}

function winDiagonal($grille) {
  if ($grille['a1'] != "_" && $grille['b2'] != "_" && $grille['c3'] != "_") {
    if ($grille['a1'] == $grille['b2'] && $grille['a1'] == $grille['c3']) {
      return true;
    }
  }
  if ($grille['a3'] != "_" && $grille['b2'] != "_" && $grille['c1'] != "_") {
    if ($grille['a3'] == $grille['b2'] && $grille['a3'] == $grille['c1']) {
      return true;
    }
  }
}

function getWinner($grille) {
  if (winRow($grille) || winColumn($grille) || winDiagonal($grille)) {
    return true;
  } else {
    return false;
  }
}

// ===========================
// FONCTION DE COUPS POSSIBLES
// ===========================
function IACanWin($grille) {
  foreach ($grille as $key => $value) {
    if ($value == "_") {
      $grille_test = $grille;
      $grille_test[$key] = "O";
      if (getWinner($grille_test)) {
        return $key;
      }
    }
  }
}

function playerCanWin($grille) {
  foreach ($grille as $key => $value) {
    if ($value == "_") {
      $grille_test = $grille;
      $grille_test[$key] = "X";
      if (getWinner($grille_test)) {
        return $key;
      }
    }
  }
}

function playInFree($grille) {
  foreach ($grille as $key => $value) {
    if ($value == "_") {
      return $key;
    }
  }
}


 ?>
