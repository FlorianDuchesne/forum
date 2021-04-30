<?php

namespace Controller;

// use Model\Manager\HomeManager;
use Model\Manager\CategoryManager;
use Model\Manager\UserManager;
use Model\Manager\MessageManager;
use Model\Manager\TopicManager;

class HomeController
{

  // Afficher la page d'accueil
  // fonction par défaut

  public function index()
  {

    $categoryModel = new CategoryManager;
    $topicModel = new TopicManager;
    $messageModel = new MessageManager;
    $categories = $categoryModel->home();
    $topics = $topicModel->findThree();
    foreach ($topics as $value) {
      $idTopic = $value->getId();
      $lastMessages[] = $messageModel->dernierMessage($idTopic);
      $nbAnswers[] = $topicModel->countAnswers($idTopic);
    }

    return [
      "view" => "home.php",
      'data' => [
        "categories" => $categories,
        "topics" => $topics,
        "lastMessages" => $lastMessages,
        "nbAnswers" => $nbAnswers
      ],
      "titrePage" => "Forum | Accueil"
    ];
  }

  public function search()
  {
    if (!empty($_GET))
      $search = filter_input(INPUT_POST, "search", FILTER_SANITIZE_STRING);

    $topicModel = new TopicManager;
    $messageModel = new MessageManager;
    $userModel = new UserManager;

    $resultsTopics = $topicModel->searchTopic($search);
    if (empty($resultsTopics)) {
      $resultsTopics = $topicModel->searchTopic(ucfirst($search));
      if (empty($resultsTopics)) {
        $resultsTopics = $topicModel->searchTopic(lcfirst($search));
      }
    }
    $resultsMessages = $messageModel->searchMessage($search);
    if (empty($resultsMessages)) {
      $resultsMessages = $messageModel->searchMessage(ucfirst($search));
      if (empty($resultsMessages)) {
        $resultsMessages = $messageModel->searchMessage(lcfirst($search));
      }
    }
    $resultUser = $userModel->searchUser($search);
    if (empty($resultUser)) {
      $resultUser = $userModel->searchUser(ucfirst($search));
      if (empty($resultsMessages)) {
        $resultUser = $userModel->searchUser(lcfirst($search));
      }
    }
    if (empty($resultsTopics) && empty($resultsMessages) && empty($resultUser)) {
      $empty = "Désolé, cette recherche n'a fourni aucun résultat.";
    }

    return [

      "view" => 'search.php',
      "data" => [
        "search" => $search,
        "resultsTopics" => $resultsTopics,
        "resultsMessages" => $resultsMessages,
        "resultUser" => $resultUser,
        "empty" => (isset($empty)) ? $empty : null
        // $empty = (isset($data['empty'])) ? $data['empty'] : null;
      ]
    ];
  }
}
