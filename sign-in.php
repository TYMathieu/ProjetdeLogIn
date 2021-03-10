<?php
// Si le fichier a déjà été inclu, alors ne l'inclut pas une deuxième fois
require_once("php/MyError.php");
// Démarre/Reprend une session 
session_start();

if (isset($_SESSION['user'])) {
  header('Location: accueil.php');
  exit();
} else {
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>LogIn Project</title>
</head>

<body>
  <div id="background"></div>
  <div class="container">
    <main>
      <h1>Les portes de l'océan</h1>
      <h2>S'inscrire</h2>
      <p class="error">
        <?php
        // Affichage de l'erreur si le paramètre est présent dans l'url
        if (isset($_GET['error'])) {
          echo "<strong>" . $_SESSION['error'] . "</strong>";
        }
        ?>
      </p>
      <form action="php/add-user.php" method="post">
        <label for="username">PSEUDO</label><br>
        <input type="text" name="username" required><br>
        <label for="password">MOT DE PASSE</label><br>
        <input type="password" name="password" required><br>
        <label for="verifpassword">CONFIRMEZ VOTRE MOT DE PASSE</label><br>
        <input type="password" name="verifpassword" required><br>
        <input type="submit" value="INSCRIPTION">
      </form>
      <p>Si tu as déjà un compte, clique <a href="index.php">ici</a> !
    </main>
  </div>
</body>

</html>