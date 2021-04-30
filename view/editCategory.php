<?php
var_dump($data);
?>

<h2></h2>
<div class="log">
  <form action="?ctrl=category&method=editCategory&id=<?= $data['category']->getId() ?>" method="post">
    <div class="form-group d-flex flex-column">
      <label for="categorie">catégorie</label>
      <!-- <input type="hidden" name="id" value=""> -->
      <input type="text" name="categorie" id="categorie" value="<?= $data['category']->getName() ?>" required>
    </div>
    <div class="form-group d-flex flex-column">
      <label for="imgPath">imgPath</label>
      <input type="text" name="imgPath" id="categorie" value="<?= $data['category']->getImg() ?>">
    </div>
    <button type="submit" class="m-3">
      <label for="submit" class="form-label">Modifier</label>
    </button>
  </form>
</div>