<h1>Catégories</h1>
<div id="galerie">
  <?php
  // var_dump($data);
  foreach ($data['categories'] as $category) {
  ?>
    <a href="?ctrl=category&method=listTopicsByCategory&id=<?= $category->getId() ?> ">
      <figure>
        <img src=" <?= $category->getImg() ?>" alt="<?= $category->getName() ?>">
        <figcaption><?= $category->getName() ?></figcaption>
      </figure>
    </a>
  <?php
  }
  ?>
</div>
<?php
// var_dump(App\Session::getAdmin());
if (App\Session::getAdmin()) {
  echo "<div class='container'><a href='?ctrl=category&method=createCategory'>Ajouter une catégorie</a></div>";
}
?>
<!-- <div class="container">
  <a href="?ctrl=category&method=createCategory">Ajouter une catégorie(pour l'admin - à l'avenir)</a>
</div> -->