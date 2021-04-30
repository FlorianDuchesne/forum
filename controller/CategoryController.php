<?php

namespace Controller;

use Model\Manager\CategoryManager;
use Model\Manager\MessageManager;
use Model\Manager\TopicManager;

class CategoryController
{

  public function CategoriesList()
  {

    $categorymodel = new CategoryManager;
    $categories = $categorymodel->findAll();

    return [
      'view' => "listCategories.php",
      'data' => [
        "categories" => $categories
      ]
    ];
  }

  public function listTopicsByCategory()
  {

    $id = (isset($_GET['id'])) ? $_GET['id'] : null;

    $messageModel = new MessageManager;
    $categoryModel = new CategoryManager;
    $topicModel = new TopicManager;
    $category = $categoryModel->findOneById($id);
    $topics = $topicModel->findTopicsByCategory($id);
    foreach ($topics as $value) {
      $idTopic = $value->getId();
      $lastMessages[] = $messageModel->dernierMessage($idTopic);
      $nbAnswers[] = $topicModel->countAnswers($idTopic);
    }

    $nbTopics = $topicModel->countTopicsByCategory($id);
    if (empty($lastMessages)) {
      return [
        "view" => "listTopicsByCategoryEmpty.php",
        "data" => [
          "category" => $category,
          "topics" => $topics,
          "nbTopics" => $nbTopics
        ]
      ];
    } else {
      return [
        "view" => "listTopicsByCategory.php",
        "data" => [
          "category" => $category,
          "topics" => $topics,
          "nbTopics" => $nbTopics,
          "lastMessages" => $lastMessages,
          "nbAnswers" => $nbAnswers
        ]
      ];
    }
  }

  public function createCategory()
  {

    // Si le formulaire n'est pas vide
    // On va se prémunir des failles XSS, en passant par les filter input ou htmlentities
    // on va vérifier sur le nom de la catégorie n'existe pas déjà en base de données
    // Si c'est bon, on ajoute la nouvelle catégorie
    // et on redirige vers la liste des catégories par exemple
    // Sinon on lui dit que la catégorie existe déjà

    // Sinon on revient au formulaire

    if (!empty($_POST['categorie'])) {

      $category = filter_input(INPUT_POST, "categorie", FILTER_SANITIZE_STRING);
      $img = filter_input(INPUT_POST, "imgPath", FILTER_SANITIZE_STRING);
      $img = "http://localhost/forum/public/css/img/" . $img . ".jpg";

      $model = new CategoryManager();
      if (!$model->findOneByName($category)) {
        $model->addCategory($category, $img);

        header("Location: ?ctrl=category&method=CategoriesList");
      } else {
        var_dump("la catégorie existe déjà");
      }
    }

    return [

      "view" => 'createCategory.php',
      "data" => null
    ];
  }

  public function deleteCategory()
  {

    $id = (isset($_GET['id'])) ? $_GET['id'] : null;
    $model = new CategoryManager();

    $model->deleteCategory($id);

    header("Location: ?ctrl=category&method=CategoriesList");
  }

  public function editCategory()
  {
    $model = new CategoryManager();
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;
    $category = $model->findOneById($id);
    $idCategory = $category->getId();

    if (!($_POST)) {
      return [

        "view" => 'editCategory.php',
        "data" => ["category" => $category]
      ];
    } else {
      $categorie = filter_input(INPUT_POST, "categorie", FILTER_SANITIZE_STRING);
      $imgPath = filter_input(INPUT_POST, "imgPath", FILTER_SANITIZE_STRING);

      $model->editCategory($idCategory, $categorie, $imgPath);
      // var_dump($id);
      // var_dump($categorie);
      // var_dump($imgPath);



      header("Location: ?ctrl=category&method=CategoriesList");
    }
  }
}
