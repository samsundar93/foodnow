<?php
namespace App\Controller\Component;
use App\Controller\AppController;
use cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Http\Client;

class FcmNotificationComponent extends Component
{

    public function sendNotification($payloadData,$to){
    	$fields = array(
            'to' => $to,
            'data' => $payloadData,
        );
		$url = 'https://fcm.googleapis.com/fcm/send'; 
		$headers = array(
		    'Authorization: Key=AAAA6rLb_EI:APA91bGzUbUPhSAmgzdG6hfUt7hdBjv4v5Ucl7YZhjF32O1K8N9TFLrM0dLagydr6zC7YK-WPcpcew-fAGSjOnDMq-5oO0Qr5Q0Y3tAdteSKZ4RrYdHAJGgHDUOhb9ZTo4Yd7NXYl6a0',
		    'Content-Type: application/json'
		);
    	// Open connection
		$ch = curl_init();

		// Set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Disabling SSL Certificate support temporarly
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

		// Execute post
		$result = curl_exec($ch);
		if ($result === FALSE) {
		    die('Curl failed: ' . curl_error($ch));
		}
		//echo "<pre>";print_r(json_encode($fields));die();
		// Close connection
		curl_close($ch);
		return $result;

    }
}
?>