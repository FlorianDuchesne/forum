<?php
// Le contenu suivant sera rangé dans "App".
namespace App;
// Dès qu'une classe possède au moins une méthode abstraite, il faut déclarer la classe comme abstraite.
// Une classe abstraite ne peut pas être instanciée.
// Une méthode abstraite est déclarée, mais ne s'implémente pas dans le code.
// En fait, elle est destinée à être héritée par d'autres classes qui l'emploieront comme cadre.
abstract class Router
{
    // Une méthode statique n'a pas besoin d'être instanciée pour être utilisée. 
    // On peut l'appeler avec un opérateur de résolution de portée (::)
    public static function handleRequest($get)
    {
        $ctrlname = "Controller\HomeController";
        $method = "index";
        // Si la requête GET contient 'ctrl'…
        if (isset($get['ctrl'])) {
            $ctrlname = "Controller\\" . ucfirst($get['ctrl']) . "Controller";
            //dans le cas par exemple de "user" : $ctrlname = "Controller\UserController"
        }

        $ctrl = new $ctrlname();
        // $ctrl = new UserController

        // Si la requête GET contient 'methode' et que la méthode indiquée existe dans le controller en question
        if (isset($get['method']) && method_exists($ctrl, $get['method'])) {
            // $method est défini comme la valeur du tableau method dans la requête Get (ce qui suit method=)
            $method = $get['method'];
        }
        // On retourne la méthode du controlleur en question
        return $ctrl->$method();
    }

    public static function redirectTo($ctrl = null, $method = null)
    {

        header("Location:?ctrl=" . $ctrl . "&method=" . $method);
        die();
    }

    public static function CSRFProtection($token)
    {
        // Si mon formulaire n'est pas vide,
        if (!empty($_POST)) {
            // Je vérifie que le champ hidden 'token' de mon formulaire n'est pas vide,
            if (isset($_POST['token'])) {
                $form_crsf = $_POST['token'];
                if (hash_equals($form_crsf, $token)) {

                    return true;
                }
            }
            return false;
        }
        return true;
    }
}
