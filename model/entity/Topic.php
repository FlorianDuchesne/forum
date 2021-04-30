<?php

namespace Model\Entity;

use App\AbstractEntity;

class Topic extends AbstractEntity
{
  private $id;
  private $title;
  private $dateCreation;
  private $user;
  private $category;
  private $lock;

  public function __construct($data)
  {
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
   * Get the value of title
   */
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * Set the value of title
   *
   * @return  self
   */
  public function setTitle($title)
  {
    $this->title = $title;

    return $this;
  }

  /**
   * Get the value of user
   */
  public function getUser()
  {
    return $this->user;
  }

  /**
   * Set the value of user
   *
   * @return  self
   */
  public function setUser($user)
  {
    $this->user = $user;

    return $this;
  }

  /**
   * Get the value of category
   */
  public function getCategory()
  {
    return $this->category;
  }

  /**
   * Set the value of category
   *
   * @return  self
   */
  public function setCategory($category)
  {
    $this->category = $category;

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
   * Get the value of lock
   */
  public function getLock()
  {
    return $this->lock;
  }

  /**
   * Set the value of lock
   *
   * @return  self
   */
  public function setLock($lock)
  {
    $this->lock = $lock;

    return $this;
  }
}
