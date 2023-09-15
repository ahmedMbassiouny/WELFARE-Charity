<?php

class project {
    private $id;
    private $req_id;


    function set_id($id) {
        $this->id = $id;
    }

    function set_req_id($req_id) {
        $this->req_id = $req_id;
    }

    function get_id() {
        return $this->id;
    }

    function get_req_id() {
        return $this->req_id;
    }

}
