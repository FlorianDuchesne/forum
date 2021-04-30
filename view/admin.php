<!-- Si je me suis connecté et que mon compte est administrateur, faire en sorte d'arriver sur cette view -->

<h1> Bienvenue sur le panneau admin</h1>
<div class="container">
  <p>Il y a sur le site <?= $data["countTopics"]["nbeTopics"] ?> sujets et <?= $data["countMessages"]["nbMessages"] ?> messages</p>
  <?php
  // var_dump(App\Session::getAdmin());
  // var_dump($data);
  ?>
  <a href="?ctrl=user&method=userslist">Voir les users</a>

</div>