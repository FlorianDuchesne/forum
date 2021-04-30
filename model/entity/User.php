<?php

namespace Model\Entity;
// On appelle AbstractEntity rangé dans App
use App\AbstractEntity;

// On crée une classe héritée de AbstractEntity
class User extends AbstractEntity
{
  private $id;
  private $pseudo;
  private $email;
  private $password;
  private $dateRegistration;
  private $icon;
  private $description;
  private $statut;


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
   * Get the value of pseudo
   */
  public function getPseudo()
  {
    return $this->pseudo;
  }

  /**
   * Set the value of pseudo
   *
   * @return  self
   */
  public function setPseudo($pseudo)
  {
    $this->pseudo = $pseudo;

    return $this;
  }

  /**
   * Get the value of email
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set the value of email
   *
   * @return  self
   */
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get the value of password
   */
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * Set the value of password
   *
   * @return  self
   */
  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
  }

  /**
   * Get the value of dateRegistration
   */
  public function getDateRegistration()
  {
    return $this->dateRegistration;
  }

  /**
   * Set the value of dateRegistration
   *
   * @return  self
   */
  public function setDateRegistration($dateRegistration)
  {
    $this->dateRegistration = $dateRegistration;

    return $this;
  }

  /**
   * Get the value of icon
   */
  public function getIcon()
  {
    return $this->icon;
  }

  /**
   * Set the value of icon
   *
   * @return  self
   */
  public function setIcon($icon)
  {
    $this->icon = $icon;

    return $this;
  }

  /**
   * Get the value of description
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set the value of description
   *
   * @return  self
   */
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  /**
   * Get the value of statut
   */
  public function getStatut()
  {
    return $this->statut;
  }

  /**
   * Set the value of statut
   *
   * @return  self
   */
  public function setStatut($statut)
  {
    $this->statut = $statut;

    return $this;
  }
}
