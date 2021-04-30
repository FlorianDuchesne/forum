<?php

namespace Model\Manager;

use App\AbstractManager;

class MessageManager extends AbstractManager
{

  private static $classname = "Model\Entity\Message"; // fully qualified classname

  public function __construct()
  {
    self::connect(self::$classname);
  }

  public function findOneById($id)
  {
    $sql = "SELECT * FROM message m WHERE id_message = :id";

    return self::getOneOrNullResult(
      self::select($sql, ["id" => $id], false),
      self::$classname
    );
  }

  public function findAll()
  {

    $sql = "SELECT m.id_message, m.content FROM message m";

    return self::getResults(
      self::select($sql, null, true),
      self::$classname
    );
  }

  public function findMessagesByTopic($id)
  {
    $sql = "SELECT * FROM message m WHERE m.topic_id = :id";

    return self::getResults(
      self::select($sql, ["id" => $id], true),
      self::$classname
    );
  }

  public function findMessagesByUser($id)
  {
    $sql = "SELECT * FROM message m WHERE m.user_id = :id";

    return self::getResults(
      self::select($sql, ["id" => $id], true),
      self::$classname
    );
  }


  // public function findUserbyMessageId($id)
  // {
  //   $sql = "SELECT m.`user_id`, u.pseudo FROM `message` m INNER JOIN user u ON u.`id_user` = m.user_id WHERE `id_message` = :id";

  //   return self::getResults(
  //     self::select($sql, ["id" => $id], false),
  //     self::$classname
  //   );
  // }

  public function countMessagesByTopic($id)
  {
    $sql = "SELECT COUNT(id_message) AS nbMessages FROM message m WHERE topic_id = :id";

    return self::getOneOrNullResultInt(
      self::select($sql, ["id" => $id], false),
      self::$classname
    );
  }

  public function dernierMessage($id)
  {
    $sql = "SELECT * FROM `message` WHERE `topic_id` = :id ORDER BY `dateCreation` DESC LIMIT 1";

    return self::getOneOrNullResult(
      self::select($sql, ["id" => $id], false),
      self::$classname
    );
  }

  // $messageModel->createMessage($message, $topicId, $user);

  public function createMessage($message, $topicId, $user)
  {
    $sql = "INSERT INTO `message`(`id_message`, `content`, `dateCreation`, `topic_id`, `user_id`) VALUES (null, :message, CURRENT_TIMESTAMP, :topic, :user)";

    return self::create($sql, ["message" => $message, "topic" => $topicId, "user" => $user]);
  }

  public function deleteMessageById($id)
  {
    $sql = "DELETE FROM `message` WHERE `id_message` = :id";

    return self::delete($sql, ["id" => $id]);
  }

  public function editMessage($content, $id)
  {
    $sql = "UPDATE `message` SET `content`= :content WHERE `id_message` = :id";

    return self::update($sql, ["content" => $content, "id" => $id]);
  }

  public function searchMessage($search)
  {
    $search = "%" . $search . "%";
    $sql = "SELECT * FROM `message` WHERE content LIKE :search";

    return self::getResults(
      self::select($sql, ["search" => $search], true),
      self::$classname
    );
  }
}
