<?php
class eventRegistration{
    private $id;
    private $event_id;
    private $volunteer_id;
    private $phone_no;
    private $address;  



    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id=$id;
    }
    public function getEventId(){
        return $this->event_id;
    }

    public function setEventId($event_id){
        $this->event_id=$event_id;
    }
    public function getVolunteerId(){
        return $this->volunteer_id;
    }

    public function setVolunteerId($volunteer_id){
        $this->volunteer_id=$volunteer_id;

    }

    public function getPhone(){
        return $this->phone_no;
    }

    public function setPhone($phone_no){
        $this->phone_no=$phone_no;
    }
    public function getAddress(){
        return $this->address;
    }

    public function setAddress($address){
        $this->address=$address;
    }


}
