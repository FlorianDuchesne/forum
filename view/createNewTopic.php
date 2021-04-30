<h2>nouveau sujet</h2>
<div class="log">
  <form action="?ctrl=topic&method=createTopic" method="post">
    <div class="form-group  d-flex flex-column m-3">
      <label for="category">Catégorie</label>
      <select name="categorie" class="form-select" aria-label="Default select example">
        <?php
        foreach ($data['categories'] as $value) {
          echo "<option ";
          if (!empty($data['idCategory'])) {
            if ($value->getId() === $data['idCategory']) {
              echo "selected ";
            }
          }
          echo "value='" . $value->getID() . "'>" . $value->getName() . "</option>";
        }
        ?>
        <!-- <option selected>Open this select menu</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option> -->
      </select>
    </div>
    <div class="form-group  d-flex flex-column m-3">
      <label for="topic">intitulé du sujet</label>
      <input type="text" name="topic" id="topic">
    </div>
    <div class="form-group  d-flex flex-column m-3">
      <label for="message">inaugurer le sujet avec un premier message :</label>
      <textarea name="message" id="message"></textarea>
    </div>
    <input type="hidden" name="user" value="<?= $data['idUser'] ?>">

    <button type="submit">Valider</button>
  </form>
</div>