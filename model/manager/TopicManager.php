<?php

namespace Model\Manager;

use App\AbstractManager;

class TopicManager extends AbstractManager
{

  private static $classname = "Model\Entity\Topic"; // fully qualified classname

  public function __construct()
  {
    self::connect(self::$classname);
  }

  public function findThree()
  {
    $sql = "SELECT * FROM topic t ORDER BY dateCreation DESC LIMIT 3";

    return self::getResults(
      self::select($sql, null, true),
      self::$classname
    );
  }

  public function findAll()
  {

    $sql = "SELECT * FROM topic t ORDER BY dateCreation DESC ";

    return self::getResults(
      self::select($sql, null, true),
      self::$classname
    );
  }

  public function findOneById($id)
  {
    $sql = "SELECT * FROM topic t WHERE t.id_topic = :id";

    return self::getOneOrNullResult(
      self::select($sql, ["id" => $id], false),
      self::$classname
    );
  }

  public function findTopicsByCategory($id)
  {
    $sql = "SELECT * FROM topic t WHERE t.category_id = :id";

    return self::getResults(
      self::select($sql, ["id" => $id], true),
      self::$classname
    );
  }

  public function findTopicsByUser($id)
  {
    $sql = "SELECT * FROM topic t WHERE t.user_id = :id";

    return self::getResults(
      self::select($sql, ["id" => $id], true),
      self::$classname
    );
  }

  public function countTopicsByCategory($id)
  {
    $sql = "SELECT COUNT(id_topic) AS nbTopics FROM topic t WHERE t.category_id = :id";

    return self::getOneOrNullResultInt(
      self::select($sql, ["id" => $id], false),
      self::$classname
    );
  }

  public function countAnswers($id)
  {
    $sql = "SELECT COUNT(`id_message`) AS nbMessages FROM `message` WHERE `topic_id` = :id GROUP BY `topic_id`";

    return self::getOneOrNullResultInt(
      self::select($sql, ["id" => $id], false),
      self::$classname
    );
  }

  public function findByName($name)
  {
    $sql = "SELECT * FROM topic WHERE title = :title";

    return self::getOneOrNullResult(
      self::select($sql, ["title" => $name], false),
      self::$classname
    );
  }

  public function createTopic($topic, $category, $user)
  {
    $sql = "INSERT INTO `topic`(`id_topic`, `title`, `dateCreation`, `lock`, `user_id`, `category_id`) VALUES (NULL, :topic, CURRENT_TIMESTAMP, '0', :user, :category)";

    return self::create($sql, ["topic" => $topic, "user" => $user, "category" => $category]);
  }

  public function deleteTopic($id)
  {
    $sqlTopic = "DELETE FROM `topic`WHERE id_topic = :id";

    return self::delete($sqlTopic, ["id" => $id]);
  }

  public function searchTopic($search)
  {
    $search = "%" . $search . "%";
    $sql = "SELECT * FROM `topic` WHERE title LIKE :search";

    return self::getResults(
      self::select($sql, ["search" => $search], true),
      self::$classname
    );
  }
}
