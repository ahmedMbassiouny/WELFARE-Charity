<?php

class payment_plan
{
  private $id;
  private $name;
  private $duration;



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



  function set_duration($duration)
  {
    $this->duration = $duration;
  }

  function get_duration()
  {
    return $this->duration;
  }
}
