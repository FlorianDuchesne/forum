<?php

// Le contenu suivant sera rangé dans "App".
namespace App;

// Dès qu'une classe possède au moins une méthode abstraite, il faut déclarer la classe comme abstraite.
// Une classe abstraite ne peut pas être instanciée.
// Une méthode abstraite est déclarée, mais ne s'implémente pas dans le code.
// En fait, elle est destinée à être héritée par d'autres classes qui l'emploieront comme cadre.

abstract class AbstractEntity
{
    // Création d'un hydratateur récursif : faire comprendre que la clé étrangère récupère un objet ! 
    // On accède à ses données avec son entité

    // Une méthode statique n'a pas besoin d'être instanciée pour être utilisée. 
    // On peut l'appeler avec un opérateur de résolution de portée (::)
    // Une méthode protégée est accessible depuis des éléments de sa classe ou qui en héritent.

    protected static function hydrate($data, $object)
    {

        // Pour chaque data…
        foreach ($data as $field => $value) {
            // On explode la data s'il y a un underscore, au niveau de l'underscore
            //ex : user_id => ["user", "id"]
            $fieldArray = explode("_", $field); // ['grade', 'id']
            $field = $fieldArray[0]; //devient grade

            // Si l'index n° 1 de $fieldArray est déclaré et non nul ET s'il équivaut à "id"… 
            // Cas d'une clé étrangère (ex : user_id)
            if (isset($fieldArray[1]) && $fieldArray[1] == "id") {
                // fieldArray[0] = user fieldArray[1]= id_user
                // $classename = Model\ -nom de l'index n°0 de fieldArray, avec une maj-Manager
                $classname = ucfirst($fieldArray[0]) . "Manager";
                // Model\Manager\TopicManager
                $FKCName = "Model\\Manager" . "\\" . $classname;
                $manager = new $FKCName();
                $field = $fieldArray[0]; //devient grade
                $value = $manager->findOneById($value); //devient un objet Grade
            }
            // On lie les objets aux setters de la classe

            $method = "set" . ucfirst($field);
            if (method_exists($object, $method)) {
                $object->$method($value);
            }
        }
    }
}
