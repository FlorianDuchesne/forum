<div class="log">
  <h1>Inscription</h1>

  <form class="col-4" method="POST" action="?ctrl=security&method=register">
    <div class="mb-3">
      <label for="mail" class="form-label">addresse mail</label>
      <input name="email" type="email" class="form-control" id="mail" placeholder="bouboulou@gmail.com">
    </div>
    <div class="mb-3">
      <label for="pseudo" class="form-label">pseudonyme</label>
      <input name="pseudo" type="text" class="form-control" id="pseudo" placeholder="bouboulou">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">mot de passe</label>
      <input name="password" type="password" class="form-control" id="password" placeholder="bouboulou">
    </div>
    <div class="mb-3">
      <label for="confirmPassword" class="form-label">Confirmez le mot de passe</label>
      <input name="confirmPassword" type="password" class="form-control" id="confirmPassword" placeholder="bouboulou">
    </div>
    <input name="token" type="hidden" value="<?= $token ?>">
    <button class="mb-3" type="submit">
      <label for="submit" class="form-label">Valider</label>
    </button>