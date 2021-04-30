<h2></h2>
<div class="log">
  <form action="?ctrl=category&method=createCategory" method="post">
    <div class="form-group d-flex flex-column">
      <label for="categorie">catégorie</label>
      <input type="text" name="categorie" id="categorie" placeholder="récit de voyage" required>
    </div>
    <div class="form-group d-flex flex-column">
      <label for="imgPath">imgPath</label>
      <input type="text" name="imgPath" id="categorie" placeholder="recitDeVoyage">
    </div>
    <input name="token" type="hidden" value="<?= $token ?>">
    <button type="submit" class="m-3">
      <label for="submit" class="form-label">Valider</label>
    </button>
  </form>
</div>