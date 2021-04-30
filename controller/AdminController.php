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
}
