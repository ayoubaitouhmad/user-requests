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
		public static function init($to, $subject, $bodyContent, $isHTML = true)
		{
			
			$mail = new PHPMailer();
			try {
				$mail->isSMTP();
				$mail->Host = $_ENV['HOST'];
				$mail->SMTPAuth = true;
				$mail->Username = $_ENV['EMAIL'];
				$mail->Password = 'USINGC.PARSE(@#@#)ODE!INT';
				$mail->SMTPSecure = 'tls';
				$mail->Port = 587;
				$mail->addAddress($to);
				$mail->setFrom($_ENV['EMAIL'], $_ENV['TEAM']);
				$mail->addReplyTo($_ENV['EMAIL'], $_ENV['TEAM']);
				$mail->isHTML($isHTML);
				$mail->Subject = $subject;
				$mail->Body = $bodyContent;
				if (!$mail->send()) {
					return 'send';
				} else {
					return 'failed';
				}
			} catch (Exception $exception) {
				echo $exception->getMessage();
				
				return false;
			}
			
			
		}
		
		
		
		public  static  function registrationMail($to_email , $to_name, $code)
		{
			$message = "
			<p style='color: rgb(15,15,15)'>
			Hello $to_name,
			To activate your UserRequests account, you must confirm your email address. <br><br>
			Please Copy  code below and back to site to get your account activated <br><br>
			Code : <span style='color:#1F74FF;'>$code</span><br><br>
			Ayoub ait,<br><br>
			Mororcco<br>
			userRequest
			</p>";
			
			self::init($to_email , '(USR) Registration Confirmation' , $message );
		}
		public  static  function resetPassword($to_email , $to_name, $code)
		{
			$message = "
			<p style='color: rgb(15,15,15)'>
			Hello $to_name,
			You are receiving this email because a request was made to reset your userRequest password. You can reset your password
			 by copy the code below and go back to our site to get your password reseted.<br><br>
			Code : <span style='color:#1F74FF;'>$code</span><br><br>
			Ayoub ait,<br><br>
			Mororcco<br>
			userRequest
			</p>";
			
			self::init($to_email , '(USR) Password Reset Request' , $message );
		}
		
		
	}