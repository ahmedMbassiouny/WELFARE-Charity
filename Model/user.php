<?php

class user{

    private $id;
    private $name;
    private $password;
    private $roleid;
    private $email;
    private $img_url;


  function set_id($id)
  {
    $this->id = $id;
  }

  function set_name($name)
  {
    $this->name = $name;
  }

  function set_email($email)
  {
    $this->email = $email;
  }

  function set_password($password)
  {
    $this->password = $password;
  }

  function set_roleid($roleid)
  {
    $this->roleid = $roleid;
  }

  function set_image($img_url)
  {
    $this->img_url = $img_url;
  }

  function get_id()
  {
    return $this->id;
  }

  function get_name()
  {
    return $this->name;
  }

  function get_email()
  {
    return $this->email;
  }

  function get_password()
  {
    return $this->password;
  }

  function getroleid()
  {
    return $this->roleid;
  }

  function get_image()
  {
    return $this->img_url;
  }

}

?>