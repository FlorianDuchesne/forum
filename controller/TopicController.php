<?php

namespace Controller;

use Model\Manager\CategoryManager;
use Model\Manager\TopicManager;
use Model\Manager\MessageManager;
use Model\Manager\UserManager;
use App\Session;
// use Model\Manager\UserManager;

class TopicController
{

  public function createMessage()
  {
    $topicModel = new TopicManager;
    $messageModel = new MessageManager;
    // $userModel = new UserManager;

    if (!empty($_POST)) {
      // $category = filter_input(INPUT_POST, "categorie", FILTER_SANITIZE_NUMBER_INT);
      $topic = filter_input(INPUT_POST, "topic", FILTER_SANITIZE_NUMBER_INT);
      $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);
      // $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_NUMBER_INT);
      $user = Session::getUser()->getId();
      if ($topic && $message && $user) {

        $messageModel->createMessage($message, $topic, $user);
      } else {
        var_dump("veuillez rédiger un message !");
      }
    }

    $topic = $topicModel->findOneById($topic);
    $messages = $messageModel->findMessagesByTopic($topic->getId());
    $nbMessages = $messageModel->countMessagesByTopic($topic->getId());

    return [
      "view" => "listMessagesByTopic.php",
      "data" => [
        "topic" => $topic,
        "messages" => $messages,
        "nbMessages" => $nbMessages
      ],
      "titrePage" => "liste des messages du topic"
    ];
  }

  public function createTopic()
  {
    if (!empty($_POST)) {
      $category = filter_input(INPUT_POST, "categorie", FILTER_SANITIZE_NUMBER_INT);
      $topic = filter_input(INPUT_POST, "topic", FILTER_SANITIZE_STRING);
      $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);
      // $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_NUMBER_INT);
      $user = Session::getUser()->getId();

      if ($category && $topic && $message && $user) {
        $categoryModel = new CategoryManager;
        $topicModel = new TopicManager;
        $messageModel = new MessageManager;
        // $userModel = new UserManager;

        // $categoryModel->findOneById($category);
        // $userModel->findOneById($user);
        if (!$topicModel->findByName($topic)) {
          $topicModel->createTopic($topic, $category, $user);
          $topicId = $topicModel->findByName($topic);
          $topicId = $topicId->getId();
          $messageModel->createMessage($message, $topicId, $user);
          header("Location: ?ctrl=topic&method=TopicsList");
        } else {
          var_dump("le topic existe déjà !");
        }
      } else {
        var_dump("tous les champs n'ont pas été remplis !");
      }

      // var_dump($_POST);
      // Optionnel : vérifier si l'utilisateur a le droit de créer un topic

      // Si mon formulaire n'est pas vide et que tous mes champs sont remplis,
      // je filtre mes inputs
      // on cherche la catégorie par son id
      // je vérifie si le titre du topic n'existe pas déjà en bdd
      // j'ajoute le topic(en injectant l'id de la catégorie)
      // je pense à permettre la création du premier message du topic

    } else {
      $idCategory = (isset($_GET['idCategory'])) ? $_GET['idCategory'] : null;
      // $idUser = (isset($_GET['idUser'])) ? $_GET['idUser'] : null;
      $idUser = Session::getUser()->getId();

      $categoryModel = new CategoryManager;
      $categories = $categoryModel->findAll();
      // $idCategory = $categoryModel->findOneById($idCategory);
      // $userModel = new UserManager;
      // $idUser = $userModel->findOneById($idUser);

      return [
        'view' => "createNewTopic.php",
        'data' => [
          "categories" => $categories,
          "idCategory" => $idCategory,
          "idUser" => $idUser
        ]
      ];
    }
  }

  public function Topicslist()
  {
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;


    $topicModel = new TopicManager;
    $messageModel = new MessageManager;
    // $userModel = new UserManager;
    $categoryModel = new CategoryManager;
    $topics = $topicModel->findAll();
    // $author = $userModel->findOneById($id);
    $category = $categoryModel->findOneById($id);
    foreach ($topics as $value) {
      $idTopic = $value->getId();
      $lastMessages[] = $messageModel->dernierMessage($idTopic);
      $nbAnswers[] = $topicModel->countAnswers($idTopic);
    }

    return [
      'view' => "listTopicsByCategory.php",
      'data' => [
        "topics" => $topics,
        "category" => $category,
        "lastMessages" => $lastMessages,
        "nbAnswers" => $nbAnswers
      ]
    ];
  }

  public function DetailTopicById()
  {
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;

    $topicModel = new TopicManager;
    $messageModel = new MessageManager;
    $topic = $topicModel->findOneById($id);
    $messages = $messageModel->findMessagesByTopic($id);
    $nbMessages = $messageModel->countMessagesByTopic($id);

    return [
      "view" => "listMessagesByTopic.php",
      "data" => [
        "topic" => $topic,
        "messages" => $messages,
        "nbMessages" => $nbMessages
      ],
      "titrePage" => "liste des messages du topic"
    ];
  }

  public function replyMessage()
  {

    $messageModel = new MessageManager;
    $userModel = new UserManager;
    $idUser = Session::getUser()->getId();

    if (!empty($_POST)) {
      $messageOriginal = filter_input(INPUT_POST, "messageOriginal", FILTER_SANITIZE_NUMBER_INT);
      $reply = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);
      $messageOriginal = $messageModel->findOneById($messageOriginal);
      $topic = $messageOriginal->getTopic()->getId();
      $messageOriginal = "<figure><blockquote>" . $messageOriginal->getContent() . "</blockquote><figcaption><small> Par " . $messageOriginal->getUser()->getPseudo() . " le " . $messageOriginal->getDateCreation() . "</small></figcaption></figure>";
      $reply = $messageOriginal . "<p>" . $reply . "</p>";
      $messageModel->createMessage($reply, $topic, $idUser);
      header("Location: ?ctrl=topic&method=DetailTopicById&id=" . $topic);
    }

    $idMessage = (isset($_GET['idMessage'])) ? $_GET['idMessage'] : null;
    // $idUser = (isset($_GET['idUser'])) ? $_GET['idUser'] : null;

    $message = $messageModel->findOneById($idMessage);
    $user = $userModel->findOneById($idUser);

    return [
      'view' => "replyMessage.php",
      'data' => [
        "user" => $user,
        "message" => $message,
      ]
    ];
  }
}
