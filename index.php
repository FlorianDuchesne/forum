<?php

namespace App;

require_once "app/Autoloader.php";

Autoloader::register();

use App\Router;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', '.' . DS);
define('PUBLIC_PATH', ROOT_DIR . 'public' . DS);
define('CSS_PATH', PUBLIC_PATH . 'css' . DS);
define('IMG_PATH', PUBLIC_PATH . 'img' . DS); // = ./public/img/nomdufichier.png
define('VIEW_PATH', ROOT_DIR . 'view' . DS);
define('CTRL_PATH', ROOT_DIR . 'controller' . DS);
define('SERVICE_PATH', ROOT_DIR . 'app' . DS);
// define('MODEL_PATH')
// define('ENTITY_PATH', )

// A chaque requête…
// On demande à la session de générer une clé propre à elle-même.
Session::generateKey();
// On va générer un token pour cette requête http seulement
$token = hash_hmac("sha256", "phrase_secrete", Session::getKey());

// On va vérifier que la protection mise dans le Router renvoie true
if (Router::CSRFProtection($token)) {
  // On va autoriser le contrôleur à traiter la demande
  // On continue la démarche normale
  $result = Router::handleRequest($_GET);
} else {
  Router::redirectTo("security", "logout");
}


ob_start();

if (is_array($result) && array_key_exists('view', $result)) {
  $data = isset($result['data']) ? $result['data'] : null;
  include VIEW_PATH . $result['view'];
} else
  include VIEW_PATH . '404.html';
$page = ob_get_contents();
ob_end_clean();

include VIEW_PATH . "layout.php";
