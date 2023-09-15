<?php

class organzation {
    private $id;
    private $address;
    private $user_id;
    private $account_num;


    function set_id($id) {
        $this->id = $id;
    }

    function set_address($address) {
        $this->address = $address;
    }

    function set_user_id($user_id) {
        $this->user_id = $user_id;
    }

    function set_account_num($account_num) {
        $this->account_num = $account_num;
    }

    function get_id() {
        return $this->id;
    }

    function get_address() {
        return $this->address;
    }

    function get_user_id() {
        return $this->user_id;
    }

    function get_account_num() {
        return $this->account_num;
    }

}

?>