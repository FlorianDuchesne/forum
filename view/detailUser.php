<?php
// var_dump($data);
$user = $data['user']
// $user = $user->getPseudo();

?>



<h1>Messages de <?= $user->getPseudo() ?> (<?= $data['countMessages']['nbMessages'] ?> )</h1>
<ul class="container">
  <?php
  foreach ($data['messages'] as $message) {
    // var_dump($message);
    echo "<li>" . $message->getContent() . " <a href='?ctrl=topic&method=detailTopicById&id=" . $message->getTopic()->getId() . "'><i class='fas fa-external-link-alt'></i></a></li>";
  }
  ?>
</ul>

<h1>Sujets créés par <?= $user->getPseudo() ?></h1>
<ul class="container">
  <?php
  foreach ($data['topics'] as $topic) {
    echo "<li>" . $topic->getTitle() . " <a href='?ctrl=topic&method=detailTopicById&id=" . $topic->getId() . "'><i class='fas fa-external-link-alt'></i></a></li>";
  }
  ?>
</ul>
<?php
if (App\Session::getAdmin()) {
  echo "<div class='container'><a href='?ctrl=admin&method=deleteUser&id=" . $user->getId() . "'>Supprimer ce compte user</a></div>";
  echo "<br>";
  echo "<div class='container'><a href='?ctrl=admin&method=login'>Panneau admin</a></div>";
}
?>
<br>
<div class="container">
  <a href="?ctrl=security&method=logout">Se déconnecter</a>
</div>