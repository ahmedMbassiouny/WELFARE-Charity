<?php


class feedback
{
  private $id;
  private $user_id;
  private $discription;
  private $email;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getUserId()
  {
    return $this->user_id;
  }

  public function setUserId($user_id)
  {
    $this->user_id = $user_id;
  }

  public function getDescription()
  {
    return $this->discription;
  }

  public function setDiscription($discription)
  {
    $this->discription = $discription;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

}