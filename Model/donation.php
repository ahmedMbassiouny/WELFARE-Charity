<?php
class donation
{

  private $name;
  private $phone;
  private $email;
  private $amount;
  private $address;
  private $paymentmethod;
  private $paymentplan;
  private $project_id;
  private $user_id;
  private $org_id;


  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function getPhone()
  {
    return $this->phone;
  }

  public function setPhone($phone)
  {
    $this->phone = $phone;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getAmount()
  {
    return $this->amount;
  }

  public function setAmount($amount)
  {
    $this->amount = $amount;
  }

  public function getAddress()
  {
    return $this->address;
  }

  public function setAddress($add)
  {
    $this->address = $add;
  }

  public function getPaymentmethod()
  {
    return $this->paymentmethod;
  }

  public function setPaymentmethod($paymentmethod)
  {
    $this->paymentmethod = $paymentmethod;
  }

  public function getPaymentplan()
  {
    return $this->paymentplan;
  }

  public function setPaymentplan($paymentplan)
  {
    $this->paymentplan = $paymentplan;
  }

  public function getProject_id()
  {
    return $this->project_id;
  }

  public function setProject_id($project_id)
  {
    $this->project_id = $project_id;
  }

  public  function getUser_id()
  {
    return $this->user_id;
  }

  public function setUser_id($user_id)
  {
    $this->user_id = $user_id;
  }


  public function getOrgId()
  {
    return $this->org_id;
  }

  public function setOrgId($org_id)
  {
    $this->org_id = $org_id;
  }
}






?>