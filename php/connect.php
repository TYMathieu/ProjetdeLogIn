<?php


try {
  // connexion à la bdd
  $connexion = new PDO(
    'mysql:host=localhost:3306;dbname=connexion',
    'root',
    ''
  );

  // Mettre les attributs
  $connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Exception $e) {
  echo $e->getMessage();
}
