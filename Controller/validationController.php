<?php

class validationController{


    public static function validate($val){
        if(isset($val)){
            if(!empty($val)){
                return true;
            }else{
                return false;
            }
        }
    }
}


?>