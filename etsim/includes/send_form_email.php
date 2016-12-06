<?php
/*
* Created by : bryan.maisano@gmail.com
* All primary function
* date * 7-11-2015
*/
include_once 'psl-config.php';
require_once 'swiftmailer/lib/swift_required.php';

if (isset($_POST['contactform']) && $_POST['contactform'] == 'contactform') {
	if(isset($_POST['contactform'])) {
		function died($error) {
			echo "We are very sorry, but there were error(s) found with the form you submitted. ";
			echo "These errors appear below.<br /><br />";
			echo $error."<br /><br />";
			echo "Please go back and fix these errors.<br /><br />";
			die();
		}

		if(!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['message']) || !isset($_POST['captcha']) ) {
			died('We are sorry, but there appears to be a problem with the form you submitted.');       
		}
	 
		$name = $_POST['name']; // required
		$email = $_POST['email']; // required
		$message = $_POST['message']; // required
        $captcha = $_POST['captcha']; // required

		$email_subject = "ETSIM Serious Game - Contact form by $name with mail $email";
		$headers = "From: $email";
		$error_message = "";
		$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	 
		if(!preg_match($email_exp,$email)) {
			$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
		}
		 
		if(strlen($message) < 2) {
			$error_message .= 'The Comments you entered do not appear to be valid.<br />';
		}
		 
		if(strlen($error_message) < 0) {
			died($error_message);
		}
        
        /*if($captcha != $_SESSION['captcha']['code']){
            died("The captcha code is not correct!");
        }*/
        try {
            // Envoi du mail de contact avec Swiftmailer       
            $transport = Swift_SmtpTransport::newInstance(GMAIL_SMTP, 465, GMAIL_ENCRYPTION)
                ->setUsername(GMAIL_ADMIN)
                ->setPassword(GMAIL_PWD);

            $mailer = Swift_Mailer::newInstance($transport);

            $messageSwift = Swift_Message::newInstance($email_subject)
              ->setFrom(array($email => $name))
              ->setTo(array(GMAIL_ADMIN))
              ->setBody($message."\n\nMail sender : ".$email);

            $result = $mailer->send($messageSwift);
            echo 'Send mail successful!<br/>';
        } catch (Exception $e){
            echo 'Problem while sending the mail (Exception : '.$e->getMessage().')<br/>';
        }
	}
}
?>