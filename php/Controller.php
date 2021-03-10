<?php


class Controller
{

  private $_connexion;
  private $_user;





  public function __construct($connexion)
  {
    $this->_connexion = $connexion;
  }



  public function  getUser($uname)
  {

    try {
      // Initialisation de la requete
      $sql = "SELECT username, password FROM user WHERE username = LOWER(:name)";

      // préparation de la requete
      $statement = $this->_connexion->prepare($sql);

      // inscription des paramètres de la requete
      $statement->bindParam("name", $uname);

      // execution de la requete
      $statement->execute();

      // Récupération de la ligne
      $this->_user = $statement->fetch();

      return $this->_user;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }


  public function verifyPassword($upwd)
  {
    sleep(1);
    // vérification que la variable corespond au hachage
    return password_verify($upwd, $this->_user['password']);
  }

  public function addUser($uname, $upwd)
  {

    try {

      $sql = "INSERT INTO user (username, password) VALUES (:name, :pwd)";

      $statement = $this->_connexion->prepare($sql);

      $statement->bindParam("name", $uname);

      $statement->bindParam("pwd", $upwd);



      return $statement->execute();
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
}
