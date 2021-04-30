<?php

namespace Model\Manager;

use App\AbstractManager;

class UserManager extends AbstractManager
{

  private static $classname = "Model\Entity\User"; // fully qualified classname

  public function __construct()
  {
    self::connect(self::$classname);
  }


  public function findAll()
  {

    $sql = "SELECT * FROM user";

    return self::getResults(
      self::select($sql, null, true),
      self::$classname
    );
  }

  public function findOneById($id)
  {
    $sql = "SELECT * FROM user u WHERE u.id_user = :id";

    return self::getOneOrNullResult(
      self::select($sql, ["id" => $id], false),
      self::$classname
    );
  }

  public function countMessagesById($id)
  {
    $sql = "SELECT COUNT(`user_id`) AS nbMessages FROM `message` WHERE `user_id` = :id";
    return self::getOneOrNullResultInt(
      self::select($sql, ["id" => $id], false),
      self::$classname
    );
  }

  public function findOneByEmail($email)
  {
    $sql = "SELECT * FROM `user` WHERE `email` = :email";

    return self::getOneOrNullResult(
      self::select($sql, ["email" => $email], false),
      self::$classname
    );
  }

  public function findOneByPseudo($pseudo)
  {
    $sql = "SELECT * FROM `user` WHERE `pseudo` = :pseudo";

    return self::getOneOrNullResult(
      self::select($sql, ["pseudo" => $pseudo], false),
      self::$classname
    );
  }

  public function addUser($email, $pseudo, $hash)
  {
    $sql = "INSERT INTO user (`id_user`, `pseudo`, `email`, `password`, `dateRegistration`, `icon`, `description`, `statut`) VALUES (null, :pseudo, :email, :password, CURRENT_TIMESTAMP, null, null, 0)";

    return self::create($sql, ["pseudo" => $pseudo, "email" => $email, "password" => $hash]);
  }

  public function getStatus($id)
  {

    $sql = "SELECT * FROM `user` WHERE `statut` = 1 and `id_user` = :id";

    return self::getOneOrNullResult(
      self::select($sql, ["id" => $id], false),
      self::$classname
    );
  }

  public function deleteUser($id)
  {
    $sqlUser = "DELETE FROM `user` WHERE `id_user` = :id"; // OK

    return self::delete($sqlUser, ["id" => $id]);
  }

  public function searchUser($search)
  {
    $search = "%" . $search . "%";
    $sql = "SELECT * FROM `user` WHERE pseudo LIKE :search";

    return self::getResults(
      self::select($sql, ["search" => $search], true),
      self::$classname
    );
  }
}
