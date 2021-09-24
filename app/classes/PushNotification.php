<?php
	
	namespace App\classes;
	
	use GuzzleHttp\Exception\GuzzleException;
	use Pusher\ApiErrorException;
	use Pusher\Pusher;
	use Pusher\PusherException;
	
	/**
	 *
	 */
	class PushNotification
	{
		public const adduser = 'add-user';
		public const handleRequests = 'handle-requests';
		public const NEW_REQUEST = 'NEW_REQUEST';
		public const SECURITY_NOTIFICATION = 'Security_Notification';
		
		
		
		/**
		 * @throws GuzzleException
		 * @throws ApiErrorException
		 * @throws PusherException
		 */
		public static function send($channel , $data){
			$options = [
				'cluster' => 'eu',
				'useTLS' => true
			];
			$pusher = new Pusher(
				'7dbc219cc0dd3d0e07b0',
				'140cfd7ee55a3bc9a67c',
				'1265262',
				$options
			);
			
			$pusher->trigger($channel, 'my-event', $data);
		}
	}