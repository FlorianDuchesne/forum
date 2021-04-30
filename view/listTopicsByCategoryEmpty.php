<?php
if (isset($data['category'])) {
  $category = $data['category'];
  foreach ($data['nbTopics'] as $value) {
    $nbTopics = $value;
  }
  // var_dump($nbTopics);
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

?>
<table class="container">
  <thead>
    <th>Sujet</th>
    <th>Création du sujet</th>
    <th>messages</th>
    <th>dernier message</th>
    <th>Catégorie</th>
  </thead>
</table>
<?php
if (App\Session::getUser()) {
  echo "<div class='container m-3'><a href='?ctrl=topic&method=createTopic&idCategory=" . $category->getId() . "'>Créer un nouveau sujet</a></div>";
}
if (App\Session::getAdmin()) {
  echo "<div class='container m-3'><a href='?ctrl=category&method=deleteCategory&id=" . $category->getId() . "'>Supprimer la catégorie</a></div>";
}
