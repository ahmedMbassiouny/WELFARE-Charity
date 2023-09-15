<?php 

class project_req {
    private $request_id;
    private $project_name;
    private $description;
    private $state;
    private $org_id;
    private $target_amount;
    private $field_id;
    private $img_url;

    function set_request_id($request_id) {
        $this->request_id = $request_id;
    }

    function set_project_name($project_name) {
        $this->project_name = $project_name;
    }

    function set_description($description) {
        $this->description = $description;
    }

    function set_state($state) {
        $this->state = $state;
    }

    function set_org_id($org_id) {
        $this->org_id = $org_id;
    }

    function set_target_amount($target_amount) {
        $this->target_amount = $target_amount;
    }

    function set_field_id($field_id) {
        $this->field_id = $field_id;
    }
    

    function set_img_url($img_url) {
        $this->img_url = $img_url;
    }
    

    function get_request_id() {
        return $this->request_id;
    }

    function get_project_name() {
        return $this->project_name;
    }
    
    function get_description() {
        return $this->description;
    }

    function get_target_amount() {
        return $this->target_amount;
    }

    function get_org_id() {
        return $this->org_id;
    }

    function get_state() {
        return $this->state;
    }

    function get_field_id() {
        return $this->field_id;
    }

    function get_img_url() {
        return $this->img_url;
    }
}

?>