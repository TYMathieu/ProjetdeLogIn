<?php
// Si le fichier a déjà été inclu, alors ne l'inclut pas une deuxième fois
require_once("connect.php");
require_once("Controller.php");
require_once("MyError.php");

// Démarre/Reprend une session 
session_start();

// Nouvel objet controller 
$controler = new Controller($connexion);

// Récupère une variable et la filtre
$name = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

// Si la variable est un string (chaine de caractères)
if (is_string($name)) {

  $pwd = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

  $token = filter_input(INPUT_POST, 'token', FILTER_VALIDATE_REGEXP, [
    // Tableau associatif d'options
    "options" => [
      // regex = expressions régulières
      "regexp" => '#^[A-Fa-f0-9]{48}$#'
    ]
  ]);

  // Récupération de la ligne de la BDD de l'user via la fonction getUser de l'objet controler
  $user = $controler->getUser($name);

  // vérifier si la variable est un tableau
  if (is_array($user)) {

    // Appel de la fonction qui vérifie les mots de passe
    if ($controler->verifyPassword($pwd)) {

      // comparaison de deux chaines en utilisant la même durée (?)
      if (hash_equals($_SESSION['token'], $token)) {

        $_SESSION['user'] = $user['username'];
        header("Location:../accueil.php");
      } else {

        // Appel de fonction pour appliquer l'erreur
        $_SESSION['error']->setError(-8, "Identification incorrecte ! Veuillez réessayer...");
        header("Location:../index.php?error");
      }
    } else {

      $_SESSION['error']->setError(-7, "Identification incorrecte ! Veuillez réessayer...");
      header("Location:../index.php?error");
    }
  } else {

    $_SESSION['error']->setError(-6, "Identification incorrecte ! Veuillez réessayer...");
    header("Location:../index.php?error");
  }
} else {

  $_SESSION['error']->setError(-5, "Identification incorrecte ! Veuillez réessayer...");
  header("Location:../index.php?error");
}
