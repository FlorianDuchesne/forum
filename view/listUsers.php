<h1>Liste</h1>

<ul>
  <?php
  foreach ($data['users'] as $user) {
    echo " <li>" . $user->getEmail() . "(" . $user->getPseudo() . ")</li>";
    echo  "<a href='#'><i class='fas fa-edit'></i></a><a href='#'><i class='fas fa-trash-alt'></i></a><a href='#'><i class='fas fa-reply'></i></a>";

    echo "<p><a href='?ctrl=user&method=detailUser&id=" . $user->getId() . "'>Voir l'activité de l'utilisateur</a></p>";
    // Listes des messages écrits par $user->getPseudo() :
    // Listes des topics créés par $user->getPseudo() :

  }
  ?>
</ul>