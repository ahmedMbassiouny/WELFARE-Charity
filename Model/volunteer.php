<?php

require_once "../../Model/user.php";

class volunteer extends user
{
  private $no_of_events;


  public function getNoOfEvent()
  {
    return $this->no_of_events;
  }

  public function setNoOfEvent($no_of_events)
  {
    $this->no_of_events = $no_of_events;
  }
}





// class volunteer{
// 
//     private $id;
//     private $no_of_event;
//     private $phone_no;
//     private $email;
//     private $user_id;
// 
// 
//   function get_user_id()
//   {
//     return $this->user_id;
//   }
// 
//   function set_id($id)
//   {
//     $this->id = $id;
//   }
// 
// 
// 
// 
// 
//     protected function getId(){
//         return $this->id;
//     }
// 
//     protected function setId($id){
//         $this->id=$id;
//     }
// 
//   protected function getEmail()
//   {
//     return $this->email;
//   }
// 
// 
//   protected function setEmail($email)
//   {
//     $this->email = $email;
//   }
// 
// 
//   protected function getNo_of_event()
//   {
//     return $this->no_of_event;
//   }
// 
// 
//   protected function setNo_of_event($no_of_event)
//   {
//     $this->no_of_event = $no_of_event;
//   }
// 
// 
//   protected function getPhone_no()
//   {
//     return $this->phone_no;
//   }
// 
// 
//   protected function setPhone_no($phone_no)
//   {
//     $this->phone_no = $phone_no;
//   }
// 
//   
// }
