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

$result = Router::handleRequest($_GET);

ob_start();

if (is_array($result) && array_key_exists('view', $result)) {
  $data = isset($result['data']) ? $result['data'] : null;
  include VIEW_PATH . $result['view'];
} else
  include VIEW_PATH . '404.html';
$page = ob_get_contents();
ob_end_clean();

include VIEW_PATH . "layout.php";
