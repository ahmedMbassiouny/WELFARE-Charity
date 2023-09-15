<?php

class role {
    private $id;
    private $name;


    function setid($id) {
        $this->id = $id;
    }

    function setname($name) {
        $this->name = $name;
    }

    function getid() {
        return $this->id;
    }

    function getname() {
        return $this->name;
    }
}
