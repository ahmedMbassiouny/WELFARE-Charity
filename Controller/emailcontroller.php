<?php 

require_once('../../Model/email.php');

 

 function verficationCode_visa($address,$code,$SubCardNo){
       $email = new email();
       $email->setAddress($address);
       $email->setSubject('Payment Verfication Code!');
       $email->setBody("Your Visa Card No. :"."**** **** **** ".$SubCardNo.'<br>'.'<br>'."your payment  verfication code is  ".$code);
       $email->SendEmail();


 }

 function verficationCode_Vcash($address,$code,$phoneno){

    $email = new email();
    $email->setAddress($address);
    $email->setSubject('Payment Verfication Code!');
    $email->setBody("Vodafone Account No. :".$phoneno.'<br>'.'<br>'."your payment  verfication code is  ".$code);
    $email->SendEmail();

 }

 function verify_email($address,$code){
    $email = new email();
    $email->setAddress($address);
    $email->setSubject('Email Verfication Code!');
    $email->setBody("your Email  verfication code is  ".$code);
    $email->SendEmail();
 }


?>