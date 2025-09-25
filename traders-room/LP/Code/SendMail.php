<?php
include('/var/www/leadcapital-partners/mail/class.phpmailer.php');
include('/var/www/leadcapital-partners/mail/class.smtp.php');

function SendMail($to, $Subject, $Body)
{
	
	try {		
		$mail = new PHPMailer();

		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true; // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
		$mail->Host = "smtp.mailgun.org";
		$mail->Port = 465; // or 587
		$mail->Username = "contactus@mg.leadcapitalmarkets.com";
		$mail->Password = "1qaz2WSX!@";
		$mail->From = 'contactus@mg.leadcapitalmarkets.com';
		$mail->FromName = 'Landing Pages';
		$mail->AddAddress($to);

		$mail->WordWrap = 50;
		$mail->IsHTML(true);

		$mail->Subject = $Subject;
		$mail->Body    = $Body;

		if(!$mail->Send())
		{
			return $mail->ErrorInfo;
		}
		else {
			return 'ok';
		}
	}
	catch(Exception $e) {
	  return $e->getMessage();
	}			
	
}
?> 











