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

// Bin2Hex converti des données binaire en hexa ; random_bytes génère des octets pseudo aléatoires sécurisé
$_SESSION["token"] = bin2hex(random_bytes(24));

// Si la variable de session erreur n'existe pas ou est null
if (!isset($_SESSION['error']))
  // création de la variable de session error
  $_SESSION['error'] = new MyError()


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
      <h2>Se connecter</h2>
      <p class="error">
        <?php
        // Affichage de l'erreur si le paramètre est présent dans l'url
        if (isset($_GET['error'])) {
          echo "<strong>" . $_SESSION['error'] . "</strong>";
        }
        ?>
      </p>
      <form action="php/login.php" method="post">
        <label for="username">PSEUDO</label><br>
        <input type="text" name="username" required><br>
        <label for="password">MOT DE PASSE</label><br>
        <input type="password" name="password" required><br>
        <input type="hidden" value="<?= $_SESSION["token"] ?>" name="token">
        <input type="submit" value="CONNEXION">
      </form>
      <p>Si tu n'es pas inscrit, tu peux toujours le faire <a href="sign-in.php">ici</a> !</p>
    </main>
  </div>
</body>

</html>