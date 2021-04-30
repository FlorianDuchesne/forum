<div id="bienvenue" class="container">

  <?php
  $user = App\Session::getUser();
  if ($user) {
    echo "<h2>Bienvenue " . App\Session::getUser()->getPseudo() . "</h2>";
  }
  ?>

  <figure class="container position-relative">
    <img src="http://localhost/forum/public/css/img/accueil.jpg" class="container">
    <figcaption class="position-absolute">
      <h2>BIENVENUE</h2>
      <a href="#">Cliquez ici pour vous inscrire !</a>
    </figcaption>
  </figure>

</div>

<h1>Catégories</h1>
<div id="galerie">

  <?php
  // var_dump($data['nbAnswers']);
  foreach ($data['categories'] as $category) {
  ?>
    <a href="?ctrl=category&method=listTopicsByCategory&id=<?= $category->getId() ?> ">
      <figure>
        <img src=" <?= $category->getImg() ?>">
        <figcaption><?= $category->getName() ?></figcaption>
      </figure>
    </a>
  <?php
  }
  ?>
  <a href="?ctrl=category&method=categoriesList" class="voirLien">Voir toutes les catégories</a>
</div>

<div id="sujets">
  <h1>Derniers sujets</h1>
  <table class="container">
    <thead>
      <th>Sujet</th>
      <th>Catégorie</th>
      <th>Messages</th>
      <th>Vues</th>
      <th>Dernier message</th>
    </thead>
    <tbody>
      <?php
      $i = 0;
      // var_dump($data['lastMessages']);
      foreach ($data['topics'] as $topic) {
      ?>
        <tr>
          <td><a href="?ctrl=topic&method=detailTopicById&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a></td>
          <td><a href="?ctrl=category&method=listTopicsByCategory&id=<?= $topic->getCategory()->getId() ?> "><?= $topic->getCategory()->getName() ?></a></td>
          <td><?= $data['nbAnswers'][$i]['nbMessages'] ?></td>
          <td>…</td>
          <td> <?php
                if (isset($data['lastMessages'][$i])) {
                  // echo $data['lastMessages'][$i]->getContent() . "
                  echo "<small>par " . $data['lastMessages'][$i]->getUser()->getPseudo() . " le " . $data['lastMessages'][$i]->getDateCreation() . " </small><a href='?ctrl=topic&method=detailTopicById&id=" . $data['lastMessages'][$i]->getTopic()->getId() . "'><i class='fas fa-external-link-alt'></i></a></td>";
                }
                ?>
        </tr>
      <?php
        $i++;
      }
      ?>
      <!-- <tr>
        <td>Culture japonaise</td>
        <td>Japon</td>
        <td>24</td>
        <td>92</td>
        <td>par Bouboulou le 13 avril 2021</td>
      </tr>
      <tr>
        <td>travailler là-bas</td>
        <td>Canada</td>
        <td>32</td>
        <td>78</td>
        <td>par Bouboulou le 13 avril 2021</td>
      </tr> -->
    </tbody>
  </table>
  <a href="?ctrl=topic&method=topicsList" class="voirLien">Voir tous les sujets</a>
</div>