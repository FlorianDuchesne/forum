<?php

namespace Model\Manager;

use App\AbstractManager;

class CategoryManager extends AbstractManager
{

  private static $classname = "Model\Entity\Category"; // fully qualified classname

  public function __construct()
  {
    self::connect(self::$classname);
  }


  public function findAll()
  {

    $sql = "SELECT * FROM category";

    return self::getResults(
      self::select($sql, null, true),
      self::$classname
    );
  }

  public function findOneById($id)
  {
    $sql = "SELECT * FROM category WHERE id_category = :id";

    return self::getOneOrNullResult(
      self::select($sql, ["id" => $id], false),
      self::$classname
    );
  }

  public function home()
  {
    $sql = "SELECT * FROM category LIMIT 3";

    return self::getResults(
      self::select($sql, null, true),
      self::$classname
    );
  }

  public function findOneByName($name)
  {
    $name = ucfirst($name);

    $sql = "SELECT `name` FROM `category` WHERE `name` = :name ";

    return self::getOneOrNullResult(
      self::select($sql, ["name" => $name], false),
      self::$classname
    );
  }

  public function addCategory($name, $img)
  {
    $name = ucfirst($name);

    $sql = "INSERT INTO `category`(`id_category`, `name`, `img`) VALUES (Null, :name, :img)";

    return self::create($sql, ["name" => $name, "img" => $img]);
  }

  public function deleteCategory($id)
  {

    $sql = "DELETE FROM Category WHERE id_category = :id";

    return self::delete($sql, ["id" => $id]);
  }

  public function editCategory($id, $categorie, $imgPath)
  {

    $sql = "UPDATE Category SET name = :categorie, img = :imgPath WHERE id_category = :id";

    return self::update($sql, ["id" => $id, "categorie" => $categorie, "imgPath" => $imgPath]);
  }
}
