<?php
if (isset($data['category'])) {
  $category = $data['category'];
  foreach ($data['nbTopics'] as $value) {
    $nbTopics = $value;
  }
?>
  <div class="container mt-5">
    <figure id="visuelCategory">
      <img src=<?= $category->getImg() ?> class="container">
      <figcaption>
        <h1><?= $category->getName() ?></h1>
      </figcaption>
    </figure>
    <h6>Nombre de sujets dans la catégorie : <?= $nbTopics ?></h6>
  </div>
<?php

}
// var_dump($data['lastMessages']);

?>
<table class="container">
  <thead>
    <th>Sujet</th>
    <th>Création du sujet</th>
    <th>messages</th>
    <th>dernier message</th>
    <th>Catégorie</th>
  </thead>
  <tbody>

    <?php
    $i = 0;
    // var_dump($data['nbAnswers']);
    foreach ($data['topics'] as $topic) {
    ?>
      <tr>
        <td><a href="?ctrl=topic&method=detailTopicById&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a></td>
        <td><small> <?= $topic->getDateCreation() ?> par <a href='?ctrl=user&method=detailUser&id= <?= $topic->getUser()->getId() ?>'> <?= $topic->getUser()->getPseudo() ?> </a> </small></td>
        <td>
          <?php
          if (isset($data['nbAnswers'])) {
            echo $data['nbAnswers'][$i]['nbMessages'] . "</td>";
          }
          ?>
        <td>
          <?php
          if (isset($data['lastMessages'][$i])) {
            // echo $data['lastMessages'][$i]->getContent() . "
            echo "<small>par " . $data['lastMessages'][$i]->getUser()->getPseudo() . " le " . $data['lastMessages'][$i]->getDateCreation() . " </small><a href='?ctrl=topic&method=detailTopicById&id=" . $topic->getId() . "'><i class='fas fa-external-link-alt'></i></a></td>";
          }
          ?>
        <td><?= $topic->getCategory()->getName() ?></td>

      </tr>
    <?php
      $i++;
    }
    ?>
  </tbody>
</table>
<?php
if (App\Session::getUser()) {
  if (isset($category)) {
    echo "<div class='container m-3'><a href='?ctrl=topic&method=createTopic&idCategory=" . $category->getId() . "'>Créer un nouveau sujet</a></div>";
    if (App\Session::getAdmin()) {
      echo "<div class='container'><a href='?ctrl=category&method=deleteCategory&id=" . $category->getId() . "'>Supprimer la catégorie</a><br><a href='?ctrl=category&method=editCategory&id=" . $category->getId() . "'>Modifier la catégorie</a></div>";
    }
  } else {
    echo "<div class='container m-3'><a href='?ctrl=topic&method=createTopic&idCategory='>Créer un nouveau sujet</a></div>";
  }
}
