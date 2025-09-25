
<?php include_once "SendMail.php"; ?>

<?php 

	$subjectContent = 'Contact us form (www.Finq.com/en/partners)';
	$allParameters = '<span style="font-size: 22px; color: #004d8e;">'.$subjectContent.'</span><br /><br />';

	$allParameters .= "<b>Name</b>: ". $_POST['full_name'];
	$allParameters .= "<br /><b>Company</b>: ".  $_POST['company'];
	$allParameters .= "<br /><b>Country</b>: ".  $_POST['country'];
	$allParameters .= "<br /><b>Phone</b>: ".  $_POST['phone'];
	$allParameters .= "<br /><b>Business type</b>: ".  $_POST['businesstype'];
	$allParameters .= "<br /><b>Skype</b>: ".  $_POST['skype'];
	$allParameters .= "<br /><b>Partnership</b>: ". $_POST['partnership'];
	$allParameters .= "<br /><b>Details</b>: ".  $_POST['details'];
	$allParameters .= "<br /><b>Email</b>: ".  $_POST['email'];


	error_log("\n date and time: ".date('D M d, Y G:i')." content: ".$allParameters, 3, "partners_contact_us.log");

	try 
	{		
		//SendMail('leadcapitalmarketsl@pipedrivemail.com', $subjectContent, $allParameters);
		//SendMail('partners@trade.com', $subjectContent, $allParameters);
//		SendMail('chrish@leadcapitalmarkets.com', $subjectContent, $allParameters);
		// SendMail('george.t@leadcapitalmarkets.com', $subjectContent, $allParameters);
		SendMail('loizos.h@Leadcapitalmarkets.com', $subjectContent, $allParameters);
	}
	catch(Exception $e) 
	{
	  error_log("\n date and time: ".date('D M d, Y G:i')." content: ".$e->getMessage(), 3, "partners_contact_us.log");
	}

?>