<?php
	
	namespace App\classes;
	
	
	
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\PHPMailer;
	
	/**
	 *
	 */
	class Mailer
	{
		
		
		/**
		 * send email
		 * @return string
		 */
		public static function init($to ,$subject , $bodyContent , $isHTML = true){
			$mail = new PHPMailer();
			try {
				$mail->isSMTP();
				$mail->Host = $_ENV['HOST'];
				$mail->SMTPAuth = true;
				$mail->Username   = $_ENV['EMAIL'];
				$mail->Password   = 'USINGC.PARSE(@#@#)ODE!INT';
				$mail->SMTPSecure = 'tls';
				$mail->Port = 587;
				$mail->addAddress($to);
				$mail->setFrom( $_ENV['EMAIL'], $_ENV['TEAM']);
				$mail->addReplyTo( $_ENV['EMAIL'], $_ENV['TEAM']);
				$mail->isHTML($isHTML);
				$mail->Subject = $subject;
				$mail->Body   = $bodyContent;
				if(!$mail->send()) {
					return 'send';
				} else {
					return 'failed';
				}
			}
			catch (Exception $exception){
				echo $exception->getMessage();
				return  false;
			}
			
			
		}
	}