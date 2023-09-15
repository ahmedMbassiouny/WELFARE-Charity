<?php

class payment_method
{
  private $id;
  private $name;




  function get_id()
  {
    return $this->id;
  }

  function set_id($id)
  {
    $this->id = $id;
  }



  function get_name()
  {
    return $this->name;
  }

  function set_name($name)
  {
    $this->name = $name;
  }

}
