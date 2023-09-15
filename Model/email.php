<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;




require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';



class email{

    private $subject;
    private $body;
    private $address;

    public function getSubject(){
		return $this->subject;
	}

	public function setSubject($subject){
		$this->subject = $subject;
	}

	public function getBody(){
		return $this->body;
	}

	public function setBody($body){
		$this->body = $body;
	}

	public function getAddress(){
		return $this->address;
	}

	public function setAddress($address){
		$this->address = $address;
	}

    function SendEmail(){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->SMTPAuth=true;
        $mail->Username='hopek4293@gmail.com';
        $mail->Password='vycbjsbnoowrwewr';
        $mail->SMTPSecure='ssl';
        $mail->Port=465;
        $mail->setFrom('hopek4293@gmail.com');
        $mail->isHTML(true);
        $mail->Subject=$this->getSubject();
        $mail->Body=$this->getBody();
        $mail->addAddress($this->getAddress());
        $mail->send();

    }

}

?>