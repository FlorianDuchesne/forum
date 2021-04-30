<?php

namespace Model\Entity;

use App\AbstractEntity;

class Message extends AbstractEntity
{
  private $id;
  private $content;
  private $dateCreation;
  private $topic;
  private $user;

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
   * Get the value of content
   */
  public function getContent()
  {
    return $this->content;
  }

  /**
   * Set the value of content
   *
   * @return  self
   */
  public function setContent($content)
  {
    $this->content = $content;

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
   * Get the value of topic
   */
  public function getTopic()
  {
    return $this->topic;
  }

  /**
   * Set the value of topic
   *
   * @return  self
   */
  public function setTopic($topic)
  {
    $this->topic = $topic;

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
}
