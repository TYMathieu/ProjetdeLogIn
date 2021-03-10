<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: index.php');
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
  <title>Accueil</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div id="background"></div>
  <div class="container">
    <main>
      <h1>Accueil</h1>
      <p>Bienvenue <?php echo ucwords($_SESSION['user']); ?> !</p>
      <p>Nous espérons que ta nouvelle vie marine te plaieras.</p>
      <p>Ne t'inquiètes pas, si ce n'est pas le cas tu peux toujours te <a href="php/logout.php">déconnecter</a> !</p>

    </main>
  </div>

</body>

</html>