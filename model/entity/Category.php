<?php

namespace Model\Entity;
// On appelle AbstractEntity rangé dans App
use App\AbstractEntity;

// On crée une classe héritée de AbstractEntity
class Category extends AbstractEntity
{
  private $id;
  private $name;
  private $dateCreation;
  private $img;

  public function __construct($data)
  {
    // On utlise la fonction hydrate du parent, AbstractEntity
    parent::hydrate($data, $this);
  }

  /**
   * Get the value of id
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of name
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set the value of name
   *
   * @return  self
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get the value of dateCreation
   */
  public function getDateCreation()
  {
    return $this->dateCreation;
  }

  /**
   * Set the value of dateCreation
   *
   * @return  self
   */
  public function setDateCreation($dateCreation)
  {
    $this->dateCreation = $dateCreation;

    return $this;
  }

  /**
   * Get the value of img
   */
  public function getImg()
  {
    return $this->img;
  }

  /**
   * Set the value of img
   *
   * @return  self
   */
  public function setImg($img)
  {
    $this->img = $img;

    return $this;
  }
}
