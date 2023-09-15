<?php


class donor
{
  private $id;
  private $total_amount;
  private $points;
  private $user_id;


  function get_user_id()
  {
    return $this->user_id;
  }

  function set_id($id)
  {
    $this->id = $id;
  }



  public function getId()
  {
    return $this->id;
  }

  public function setId($new_id)
  {
    $this->id = $new_id;
  }

  public function getTotalAmount()
  {
    return $this->total_amount;
  }

  public function setTotalAmount($new_total_amount)
  {
    $this->total_amount = $new_total_amount;
  }

  public function getPoints()
  {
    return $this->points;
  }

  public function setPoints($new_points)
  {
    $this->points = $new_points;
  }



// 
//       function set_id($id) {
//         $this->id = $id;
//     }
// 
//     function set_total_amount($total_amount) {
//         $this->total_amount = $total_amount;
//     }
// 
//     function set_user_id($user_id) {
//         $this->user_id = $user_id;
//     }
// 
//     function set_points($points) {
//         $this->points = $points;
//     }
// 
//     function get_id() {
//         return $this->id;
//     }
// 
//     function get_total_amount() {
//         return $this->total_amount;
//     }
// 
//     function get_user_id() {
//         return $this->user_id;
//     }
// 
//     function get_points() {
//         return $this->points;
//     }

}
