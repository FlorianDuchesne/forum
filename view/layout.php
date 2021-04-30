<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/e2a8fec256.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
  <link href="http://localhost/forum/public/css/style.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Pangolin&display=swap" rel="stylesheet">
  <title>Document</title>
</head>

<body>
  <header class="w-100 navbar-expand-lg container-fluid">
    <div id="entete" class=" container-fluid d-flex justify-content-between align-items-center">
      <a href="http://localhost/forum" class="col-4">
        <figure id="logo" class="col-12 position-relative mt-2">
          <img src="http://localhost/forum/public/css/img/logo.png" class="col-5" />
          <h1 class="position-absolute">PVT</h1>
        </figure>
      </a>
      <form action="?ctrl=home&method=search" method="post" class="col-6">
        <input type="search" name="search" />
        <button type="submit"><i class="fas fa-search"></i></button>
      </form>
      <?php
      if (App\Session::getUser()) {
        echo "<a href='?ctrl=user&method=detailUser&id=" . App\Session::getUser()->getId() . "'><div id='login' class='d-flex flex-column justify-content-between align-items-center p-2'>
        <i class='fas fa-user m-1'></i>
        <h5>" . App\Session::getUser()->getPseudo() . "</h5>
      </div></a>";
      } else {
        echo "<a href='?ctrl=security&method=login'>
        <div id='login' class='d-flex flex-column justify-content-between align-items-center p-2'>
          <i class='fas fa-user m-1'></i>
          <h5>Mon compte</h5>
        </div>
      </a>";
      }
      ?>
    </div>
  </header>
  <nav class="w-100 navbar-expand-lg container-fluid navbar d-flex justify-content-around align-items-center">
    <a href="http://localhost/forum">Accueil</a>
    <a href="?ctrl=category&method=categoriesList">catégories</a>
    <a href="?ctrl=topic&method=topicslist">Sujets</a>
    <a href="#">À propos</a>
    <a href="?ctrl=security&method=register">Inscription</a>
  </nav>

  <main>
    <div id="page">
      <?= $page ?>
    </div>
  </main>

  <footer>
    <small>&copy;2021 FLORIAN DUCHESNE DL COLMAR ELAN</small>
  </footer>
</body>

</html>
<script src="http://localhost/forum/public/js/script.js"></script>