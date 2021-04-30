<?php
// var_dump($data);
?>

<div class='container log'>
  <div id="edit">
    <form class='d-flex flex-column justify-content-center align-items-center' action='?ctrl=user&method=editMessage' method='post'>
      <label for='message'>Message :</label>
      <textarea name='message' id='message' required><?= $data['message']->getContent() ?></textarea>
      <input type='hidden' name='idMessage' value=<?= $data['message']->getId() ?>>
      <button type='submit' class='m-3'>Valider</button>
    </form>
  </div>