<?php

namespace Model\Manager;

use App\AbstractManager;

class HomeManager extends AbstractManager
{

  private static $classname = "Model\Entity\Category"; // fully qualified classname

  public function __construct()
  {
    self::connect(self::$classname);
  }

  // public function search($search)
  // {
  //   $search = "%" . $search . "%";
  //   // $sql = "SELECT * FROM `category` c INNER JOIN topic t ON c.id_category = t.category_id INNER JOIN message m ON t.id_topic = m.topic_id INNER JOIN user u ON m.user_id = u.id_user WHERE c.name LIKE :search OR m.content LIKE :search OR t.title LIKE :search OR u.pseudo LIKE :search";
  //   $sql = "SELECT * FROM topic t INNER JOIN message m ON t.id_topic = m.topic_id INNER JOIN user u ON m.user_id = u.id_user WHERE m.content LIKE :search OR t.title LIKE '%religion%' OR u.pseudo LIKE '%religion%'";
  //   return self::getResults(
  //     self::select($sql, ["search" => $search], true),
  //     self::$classname
  //   );
  // }
}
