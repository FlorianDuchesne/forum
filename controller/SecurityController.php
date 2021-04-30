<?php

namespace Controller;

use Model\Manager\UserManager;
use App\Router;
use App\Session;

class SecurityController
{

  public function logout()
  {

    Session::removeUser();
    Router::redirectTo("home");
  }

  public function login()
  {
    if (!empty($_POST)) {

      $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
      $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

      $model = new UserManager;

      if ($user = $model->findOneByEmail($email)) {

        if (password_verify($password, $user->getPassword())) {

          Session::setUser($user);
          $status = $model->getStatus($user->getId());
          if (!$status) {
            Router::redirectTo("home");
          } else {
            Session::setAdmin($user);
            header("Location: ?ctrl=admin&method=login");
            var_dump("admin pris");
          }
        } else var_dump("le mot de passe est incorrect");
      } else var_dump("l'identifiant n'existe pas");
    }

    return [
      "view" => "security/login.php",
      "data" => null
    ];
  }
  // public function log()
  // {
  //On vérifie si le formulaire est rempli
  //On nettoie les inputs
  // On vérifie si TOUS les champs sont renseignés
  // On instancie un user manager
  // On cherche si l'identifiant est bien dans la bdd
  // On décrypte le mot de passe haché dans la bdd
  // On vérifie si le mot de passe décrpyté correspond au mot de passe rentré
  // On déclare l'utilisateur comme étant en session.
  // S'il est admin, on l'indique dans les infos de la session
  // }

  public function register()
  {

    // On vérifie si notre formulaire est rempli
    // S'il est rempli, je nettoie mes inputs
    // Je vérifie si TOUS les champs ont été renseignés correctement et filtrés
    // Si les deux mots de passe correspondent
    // alors on instancie notre user manager
    // et on cherche si l'identifiant n'existe pas déjà dans la base de données
    // et on hache le mot de passe
    // puis on rajoute l'utilisateur en base de données
    // puis on redirige vers le login

    if (!empty($_POST)) {

      $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
      $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
      $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_STRING);
      $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_STRING);

      if ($email && $password && $confirmPassword && $pseudo) {

        if ($password == $confirmPassword) {

          $model = new UserManager;
          if (!$model->findOneByEmail($email) && !$model->findOneByPseudo($pseudo)) {

            $hash = password_hash($password, PASSWORD_BCRYPT);
            if ($model->addUser($email, $pseudo, $hash)) {

              Router::redirectTo("security", "login");
            }
          } else var_dump("Email déjà existant");
        } else var_dump("les deux mots de passe sont différents");
      } else var_dump("champs manquants !");
    }



    return [
      "view" => 'security/register.php',
      "data" => null
    ];
  }
}
