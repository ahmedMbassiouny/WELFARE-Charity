<?php 

class event_req {
    private $request_id;
    private $event_name;
    private $information;
    private $state;
    private $org_id;
    private $location;
    private $time;
    private $img_url;

    function set_request_id($request_id) {
        $this->request_id = $request_id;
    }

    function set_event_name($event_name) {
        $this->event_name = $event_name;
    }

    function set_information($information) {
        $this->information = $information;
    }

    function set_state($state) {
        $this->state = $state;
    }

    function set_org_id($org_id) {
        $this->org_id = $org_id;
    }

    function set_location($location) {
        $this->location = $location;
    }
    

    function set_img_url($img_url) {
        $this->img_url = $img_url;
    }

    function set_time($time) {
        $this->time = $time;
    }
    

    function get_request_id() {
        return $this->request_id;
    }

    function get_event_name() {
        return $this->event_name;
    }
    
    function get_information() {
        return $this->information;
    }

    function get_org_id() {
        return $this->org_id;
    }

    function get_state() {
        return $this->state;
    }

    function get_location() {
        return $this->location;
    }

    function get_img_url() {
        return $this->img_url;
    }

    function get_time() {
        return $this->time;
    }
}

?>