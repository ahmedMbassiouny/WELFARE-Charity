<?php

class field {
  private $id;
  private $name;
  private $no_of_project;


  function set_id($id) {
      $this->id = $id;
  }

  function set_name($name) {
      $this->name = $name;
  }

  function set_no_of_project($no_of_project) {
      $this->name = $no_of_project;
  }

  function get_id() {
      return $this->id;
  }

  function get_name() {
      return $this->name;
  }

  function get_no_of_project() {
      return $this->no_of_project;
  }
}
