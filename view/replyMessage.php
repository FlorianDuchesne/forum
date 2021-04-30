<?php

// var_dump($data);
// echo $data['message']->getContent();
// echo $data['user']->getPseudo();
?>
<div class='container log'>
  <div id="edit">
    <form class='d-flex flex-column justify-content-center align-items-center' action='?ctrl=topic&method=replyMessage' method='post'>
      <figure>
        <blockquote><?= $data['message']->getContent() ?></blockquote>
        <figcaption><?= $data['message']->getUser()->getPseudo() ?></figcaption>
      </figure>

      <!-- <label for "messageOriginal"><?= $data['message']->getContent() ?> <small><?= $data['message']->getUser()->getPseudo() ?> </small> </label> -->
      <input type="hidden" name="messageOriginal" value="<?= $data['message']->getId() ?>">
      <br>
      <label for='message'>Réponse :</label>
      <textarea name='message' id='message' required></textarea>
      <button type='submit' class='m-3'>Valider</button>
    </form>
  </div>