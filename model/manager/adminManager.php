<?php

namespace Model\Manager;

use App\AbstractManager;

class AdminManager extends AbstractManager
{

  private static $classname = "Model\Entity\Admin"; // fully qualified classname

  public function __construct()
  {
    self::connect(self::$classname);
  }

  public function CountTopics()
  {

    $sql = "SELECT COUNT(id_topic) AS nbeTopics FROM topic";

    return self::getOneOrNullResultInt(
      self::select($sql, null, false),
      self::$classname
    );
  }

  public function CountMessages()
  {

    $sql = "SELECT COUNT(id_message) AS nbMessages FROM message";

    return self::getOneOrNullResultInt(
      self::select($sql, null, false),
      self::$classname
    );
  }

  public function lockTopic($id)
  {
    $sql = "UPDATE `topic` SET `lock`=1 WHERE `id_topic` = :id";

    return self::update($sql, ["id" => $id]);
  }
}
