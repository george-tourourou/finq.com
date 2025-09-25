<?php

function SendMail($to, $subject, $allParameters) {
	$message = GetMailTemplate($allParameters);
	$headers = 'From: partnersform@mg.leadcapitalmarkets.com' . "\r\n" .
		'Reply-To: partnersform@mg.leadcapitalmarkets.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";	

	mail($to, $subject, $message, $headers);
}	

function GetMailTemplate($content) {
	$msg = '';
	
	$msg .='<table width="720" class="w100 BGWhite" align="center" cellpadding="0" cellspacing="0" style="background-color:#efefef; z-index:-1; margin:0 auto; font-family: Arial !important;">';
	$msg .='<tr height="40" ><td></td></tr>';
	$msg .='<tr>';
	$msg .='<td>';
		$msg .='<table width="600" align="center" cellpadding="0" cellspacing="0" style="background-color: #ffffff; color:#333; margin:0 auto; font-family: Arial !important;">';
			$msg .='<tr>';
				$msg .='<td width="600" valign="top" align="left">';
					$msg .='<table width="600" cellpadding="0" cellspacing="0" align="center" style="background-color: #ffffff !important;">';
						$msg .='<tr style="background-color:#ffffff;">';
							$msg .='<td colspan="3" align="center" style="border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
								$msg .='<a width="600" class="w100" href="http://www.finq.com" target="_blank">';
									$msg .='<img class="w100" src="https://www.finq.com/files/mail/Common/header-new-finq.jpg" alt="FINQ.com" style="display: block;border-collapse: collapse;mso-table-lspace:0pt; mso-table-rspace:0pt;" width="600" />';
								$msg .='</a>';
							$msg .='</td>';
						$msg .='</tr>';
					$msg .='</table>';
				$msg .='</td>';
			$msg .='</tr>';
			$msg .='<tr height="40"><td></td></tr>';
			$msg .='<tr>';
				$msg .='<td width="600" valign="top" align="center">';
					$msg .='<table width="600" cellpadding="0" cellspacing="0">';
						$msg .='<tr align="left">';
							$msg .='<td width="100" class="sp2"></td>';
							$msg .='<td width="400">';
								$msg .='<span style="color: #333333; font-weight: normal; font-size: 16px; text-align: justify; line-height: 1.3;">';
								$msg .= $content;
								$msg .='</span>';
							$msg .='</td>';
							$msg .='<td width="100" class="sp2"></td>';
						$msg .='</tr>';
					$msg .='</table>';
				$msg .='</td>';
			$msg .='</tr>';
			$msg .='<tr height="40"><td></td></tr>';
		$msg .='</table>';
	$msg .='</td>';
	$msg .='</tr>';
	$msg .='<tr height="40" ><td></td></tr>';
	$msg .='</table>';
	
	return $msg;
}

?> 











