<?php

namespace Controller;

use Model\Manager\MessageManager;
use Model\Manager\UserManager;
use Model\Manager\TopicManager;

class UserController
{


  public function UsersList()
  {

    $usermodel = new UserManager;
    $users = $usermodel->findAll();

    return [
      'view' => "listUsers.php",
      'data' => [
        "users" => $users,
      ]
    ];
  }

  public function detailUser()
  {
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;

    $userModel = new UserManager;
    $topicModel = new TopicManager;
    $messageModel = new MessageManager;
    $user = $userModel->findOneById($id);
    $messages = $messageModel->findMessagesByUser($id);
    $topics = $topicModel->findTopicsByUser($id);
    $countMessages = $userModel->countMessagesById($id);
    return [
      'view' => "detailUser.php",
      'data' => [
        "user" => $user,
        "messages" => $messages,
        "topics" => $topics,
        "countMessages" => $countMessages
      ]
    ];
  }

  public function deleteMessage()
  {
    $idMessage = (isset($_GET['id'])) ? $_GET['id'] : null;
    $messageModel = new MessageManager;
    $topicModel = new TopicManager;
    $message = $messageModel->findOneById($idMessage);
    $idTopic = $message->getTopic()->getId();
    $message = $messageModel->deleteMessageById($idMessage);
    header("Location: ?ctrl=topic&method=DetailTopicById&id=$idTopic");
  }

  public function editMessage()
  {
    $messageModel = new MessageManager;

    if (!empty($_POST)) {
      var_dump($_POST);
      $contentMessage = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);
      $idMessage = filter_input(INPUT_POST, "idMessage", FILTER_SANITIZE_NUMBER_INT);
      $message = $messageModel->findOneById($idMessage);
      $idTopic = $message->getTopic()->getId();
      $messageModel->editMessage($contentMessage, $idMessage);
      header("Location: ?ctrl=topic&method=DetailTopicById&id=$idTopic");
    } else {
      $idMessage = (isset($_GET['id'])) ? $_GET['id'] : null;
      $message = $messageModel->findOneById($idMessage);
      $user = $message->getUser();
      $topic = $message->getTopic();
      return [
        'view' => "editMessage.php",
        'data' => [
          "user" => $user,
          "message" => $message,
          "topic" => $topic,
        ]
      ];
    }
  }
}
