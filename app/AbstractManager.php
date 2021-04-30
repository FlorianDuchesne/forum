<?php
// Le contenu suivant sera rangé dans "App".
namespace App;

// Dès qu'une classe possède au moins une méthode abstraite, il faut déclarer la classe comme abstraite.
// Une classe abstraite ne peut pas être instanciée.
// Une méthode abstraite est déclarée, mais ne s'implémente pas dans le code.
// En fait, elle est destinée à être héritée par d'autres classes qui l'emploieront comme cadre.
abstract class AbstractManager
{
    // Une méthode statique n'a pas besoin d'être instanciée pour être utilisée. 
    // On peut l'appeler avec un opérateur de résolution de portée (::)
    private static $connection;
    // Une méthode protégée est accessible depuis des éléments de sa classe ou qui en héritent.
    protected static function connect()
    {
        self::$connection = DAO::getConnection();
    }

    protected static function getOneOrNullResult($row, $class)
    {
        // Si row n'est pas null, on retournera une instanciation de la classe paramétrée, avec row en paramètre. 
        if ($row != null) {
            return new $class($row);
        }
        return null;
    }
    protected static function getOneOrNullResultInt($row)
    {

        if ($row != null) {
            return $row;
        }
        return null;
    }

    protected static function getResults($rows, $class)
    {

        $results = [];
        // Si row n'est pas null, on produira une boucle qui retournera pour chaque row une instanciation de la classe paramétrée, avec row en paramètre. 
        if ($rows != null) {
            foreach ($rows as $row) {
                $results[] = new $class($row);
            }
        }
        return $results;
    }

    protected static function select($sql, $params = null, $multiple = true)
    {
        $stmt = self::$connection->prepare($sql);
        $stmt->execute($params);

        if ($multiple) {
            return $stmt->fetchAll();
        }
        return $stmt->fetch();
    }

    protected static function create($sql, $params)
    {
        $stmt = self::$connection->prepare($sql);

        return $stmt->execute($params);
    }

    protected static function update($sql, $params)
    {
        $stmt = self::$connection->prepare($sql);

        return $stmt->execute($params);
    }

    protected static function delete($sql, $params)
    {
        $stmt = self::$connection->prepare($sql);

        return $stmt->execute($params);
    }
}
