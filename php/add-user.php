<?php
// Si le fichier a déjà été inclu, alors ne l'inclut pas une deuxième fois
require_once("connect.php");
require_once("Controller.php");
require_once("MyError.php");

// Démarre/Reprend une session existante
session_start();

// Création d'une nouvelle classe controler, controler.
$controler = new Controller($connexion);

// Récupération de variable + filtrage
$name = filter_input(INPUT_POST, 'username', FILTER_VALIDATE_REGEXP, [
  // Tableau associatif d'options
  "options" => [
    // regex = expressions régulières
    "regexp" => '#^[A-Za-z][A-Za-z0-9_-]{5,31}$#'
  ]
]);

// Si la variable est un string (chaine de caractères)
if (is_string($name)) {

  $pwd1 = filter_input(INPUT_POST, 'password', FILTER_VALIDATE_REGEXP, [
    "options" => [
      "regexp" => '#^.*(?=.{8,63})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).*$#'
    ]
  ]);

  if (is_string($pwd1)) {

    $user = $controler->getUser($name);


    if (is_array($user)) {

      $_SESSION['error']->setError(-3, "Cet identifiant est déjà pris ! Veuillez en choisir un autre...");
      header("Location:sign-in.php?error");
    } else {

      $pwd2 = filter_input(INPUT_POST, 'verifpassword', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

      if ($pwd1 === $pwd2) {

        $status = $controler->addUser(strtolower($name), password_hash($pwd1, PASSWORD_ARGON2I));

        if ($status) {

          header("Location:../index.php");
        } else {

          $_SESSION['error']->setError(-9, "Erreur inconnue ! Veuillez réessayer...");
          header("Location:../sign-in.php?error");
        }
      } else {

        $_SESSION['error']->setError(-4, "Les deux mots de passe saisis ne concordent pas ! Veuillez réessayer...");
        header("Location:../sign-in.php?error");
      }
    }
  } else {

    $_SESSION['error']->setError(-2, "Le mot de passe doit comporter au moins 8 caractères, et contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial ! Veuillez réessayer...");
    header("Location:../sign-in.php?error");
  }
} else {

  $_SESSION['error']->setError(-1, "Le nom d'utilisateur doit comporter entre 6 et 32 caractères alphanumériques, et commencer par une lettre ! Veuillez réessayer...");
  header("Location:../sign-in.php?error");
}
