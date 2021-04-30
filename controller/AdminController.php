<?php

namespace Controller;

use Model\Manager\AdminManager;
use Model\Manager\MessageManager;
use Model\Manager\TopicManager;
use Model\Manager\UserManager;

class AdminController
{

  public function login()
  {
    $adminModel = new AdminManager;
    $countTopics = $adminModel->CountTopics();
    $countMessages = $adminModel->CountMessages();


    return [
      'view' => "admin.php",
      'data' => [
        "countTopics" => $countTopics,
        "countMessages" => $countMessages
      ]
    ];
  }

  public function lock()
  {

    $id = (isset($_GET['id'])) ? $_GET['id'] : null;
    $topicModel = new TopicManager;
    $adminModel = new AdminManager;
    $lockTopic = $adminModel->lockTopic($id);
    $topics = $topicModel->findAll();

    return [
      'view' => "listTopicsByCategory.php",
      'data' => [
        "topics" => $topics
      ]
    ];
  }

  public function deleteUser()
  {
    // $sqlMessages = "DELETE FROM `message` WHERE `user_id`= :id"; // OK
    // $sqlTopic = "DELETE FROM `topic` WHERE `user_id` = :id"; // OK
    // $sqlUser = "DELETE FROM `user` WHERE `id_user` = :id"; // OK

    // return self::delete($sqlMessages, ["id" => $id]);
    // return self::delete($sqlTopic, ["id" => $id]);
    // return self::delete($sqlUser, ["id" => $id]);

    $id = (isset($_GET['id'])) ? $_GET['id'] : null;
    $userModel = new UserManager;
    $messageModel = new MessageManager;
    $topicModel = new TopicManager;
    $user = $userModel->findOneById($id);
    $messages = $messageModel->findMessagesByUser($id);
    if (isset($messages)) {
      foreach ($messages as $value) {
        $idValue = $value->getId();
        $deleteMessage = $messageModel->deleteMessageById($idValue);
      }
    }
    $topics = $topicModel->findTopicsByUser($id);
    if (isset($topics)) {
      foreach ($topics as $value) {

        $idTopic = $value->getId();
        $messagesTopic = $messageModel->findMessagesByTopic($idTopic);
        foreach ($messagesTopic as $value) {
          $idValue = $value->getId();
          $deleteMessageTopic = $messageModel->deleteMessageById($idValue);
        }

        $deleteTopic = $topicModel->deleteTopic($idTopic);
      }
    }
    $userModel->deleteUser($id);
    header("Location: ?ctrl=user&method=UsersList");

    // Ça ne marche pas. Les tables sont liées les uns aux autres par des clés étrangères, qui m'empêchent d'en supprimer.
    // Il faudrait que je supprime et remette les clés étrangères… Un peu chiant…

  }

  public function deleteTopic()
  {
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;
    $topicModel = new TopicManager;
    $messageModel = new MessageManager;
    $messages = $messageModel->findMessagesByTopic($id);
    foreach ($messages as $value) {
      $idValue = $value->getId();
      $deleteMessage = $messageModel->deleteMessageById($idValue);
    }
    $topicModel->deleteTopic($id);
    header("Location: ?ctrl=topic&method=TopicsList");
  }
}
