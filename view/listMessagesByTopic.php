<?php
// var_dump($data['messages']);
$topic = $data['topic'];
$lock = $topic->getLock();
// $nbMessages = $data['nbMessages']
foreach ($data['nbMessages'] as $value) {
  $nbMessages = $value;
}
// var_dump($nbMessages);
// $nbMessages = $data['nbMessages'];
?>
<div class="container detailTopic">
  <h1>Messages de <?= $topic->getTitle() ?></h1>
  <h6> Nombre de messages : <?= $nbMessages ?> </h6>
  <div class="m-3">
    <?php
    foreach ($data['messages'] as $message) {
      $user = $message->getUser();
      // echo "USER :";
      // var_dump($email);
      // echo "SESSION USER :";
      // var_dump(App\Session::getUser()->getEmail());
      // echo $user->getId();
    ?>
      <div class="m-auto">
        <table class="m-auto">
          <thead>
            <th>
              <small> <?= $message->getDateCreation() ?> par <a href="?ctrl=user&method=detailUser&id=<?= $user->getId() ?> "> <?= $user->getPseudo() ?></a></small>
            </th>
          </thead>
          <tbody>
            <tr>
              <td>
                <?= $message->getContent() ?>
              </td>
            </tr>
          </tbody>
        </table>
        <?php
        if (App\Session::getUser()) {
          if ($lock === "0") {
            echo "<a href='?ctrl=topic&method=replyMessage&idMessage=" . $message->getId() . "'><i class='fas fa-reply'></i></a>";
            if ($user->getPseudo() === App\Session::getUser()->getPseudo() || (App\Session::getAdmin())) {
              echo  "<a href='?ctrl=user&method=editMessage&id=" . $message->getId() . "'><i class='fas fa-edit'></i></a><a href='?ctrl=user&method=deleteMessage&id=" . $message->getId() . "'><i class='fas fa-trash-alt'></i></a>";
            }
          }
        }
        ?>
        <!-- <a href=" #"><i class="fas fa-edit"></i></a><a href="#"><i class="fas fa-trash-alt"></i></a><a href="#"><i class="fas fa-reply"></i></a> -->
      </div>
    <?php
    }
    ?>
  </div>
</div>
<?php
// var_dump($lock);
if (App\Session::getUser()) {
  if ($lock === "0") {
    echo  "<div class='container log'><p><button id='collapse'>Nouveau message</button></p>";
    echo "<div id='newMessage'>
    <form class='d-flex flex-column justify-content-center align-items-center' action='?ctrl=topic&method=createmessage' method='post'>
      <label for='message'>Message :</label>
      <textarea name='message' id='message' required></textarea>
    <input type='hidden' name='user' value=" . App\Session::getUser()->getId() . "'>
    <input type='hidden' name='topic' value=" . $topic->getId() . "'>
    <button type='submit' class='m-3'>Valider</button>
    </form>
  </div>";
    if (App\Session::getAdmin()) {
      echo "<p><a href='?ctrl=admin&method=lock&id=" . $topic->getId() . "'>Fermer le sujet</a></p>";
      echo "<p><a href='?ctrl=admin&method=deleteTopic&id=" . $topic->getId() . "'>Supprimer le topic</a></p></div>";
    }
  } else {
    echo "<div class='container'><p>Le sujet a été fermé</p></div>";
  }
}
