<?php

if (App\Session::getUser()) {
  echo "<h2>Vous êtes déjà connecté avec l'email " . App\Session::getUser()->getEmail() . "</h2>";
}

?>

<div class="log">
  <h1>Connectez-vous</h1>

  <form class="col-3 p-3" method="POST" action="?ctrl=security&method=login">

    <div class="m-3"><input name="email" type="text" placeholder="email" required></div>
    <div class="m-3"><input name="password" type="password" placeholder="mot de passe" required></div>
    <input name="token" type="hidden" value="<?= $token ?>">
    <div class="m-3"><button type="submit">Valider</button></div>
  </form>
</div>