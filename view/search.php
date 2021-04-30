<h1>Résultats de la recherche : <?= $data['search'] ?></h1>

<?php
// var_dump($data);

$empty = (isset($data['empty'])) ? $data['empty'] : null;

if (isset($empty)) {
  echo $empty;
}

if (!empty($data['resultsTopics'])) {
  echo "<div class='container'><h4> Sujets correspondants à la recherche : </h4>";

  echo "<table class='container'>
  <thead>
    <th>Sujet</th>
    <th>Création du sujet</th>
    <th>Catégorie</th>
  </thead>
  <tbody>";
  $i = 0;
  foreach ($data['resultsTopics'] as $value) {
    // echo $value->getTitle();
    echo "<tr><td><a href='?ctrl=topic&method=detailTopicById&id=" . $value->getId() . "'>" . $value->getTitle() . "</a></td>
        <td><small>" . $value->getDateCreation() . " par <a href='?ctrl=user&method=detailUser&id=" . $value->getUser()->getId() . "'>" . $value->getUser()->getPseudo() . "</a></small></td>
        <td>" . $value->getCategory()->getName() . "</td></tr>";
    $i++;
  }
  echo  "</tbody></table></div>";
}

if (!empty($data['resultsMessages'])) {
  foreach ($data['resultsMessages'] as $message) {
    echo "<div class='container'><h4> Message(s) correspondant à la recherche : </h4>";

    echo "<div class='m-3 container detailTopic'>
    <table class='m-auto'>
      <thead>
        <th>
          <small>" . $message->getDateCreation() . " par <a href='?ctrl=user&method=detailUser&id=" . $message->getUser()->getId() . "'>" . $message->getUser()->getPseudo() . "</a></small>
        </th>
      </thead>
      <tbody>
        <tr>
          <td>
            " . $message->getContent() . "
          </td>
        </tr>
      </tbody>
    </table></div>";
    echo "<a href='?ctrl=topic&method=detailTopicById&id=" . $message->getTopic()->getId() . "'>Aller au sujet du message <i class='fas fa-external-link-alt'></i></a></div>";
  }
}

if (!empty($data['resultUser'])) {
  foreach ($data['resultUser'] as $value) {

    echo "<div class='container'><h1>" . $value->getPseudo() . "</h1>";
    echo "<a href='?ctrl=user&method=detailUser&id=" . $value->getId() . "'>Voir l'activité de l'utilisateur</a></div>";
  }
}
