<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/3/2017
 * Time: 10:32 PM
 */
namespace App\Controller\Component;
use App\Controller\AppController;
use cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Http\Client;

class PushNotificationComponent extends Component
{

    public function pushNotification($message) {

        require_once (ROOT . DS . 'vendor'. DS  . 'pusher' . DS . 'pusher-php-server'. DS . 'src' . DS . 'Pusher.php');
        //$pusher = new Pusher('8694af1d082e8c1da2fd', '2b8911e771da4a8e8313', '161814');

        $options = array(
            'cluster' => 'ap2',
            'encrypted' => true
        );
        $pusher = new \Pusher\Pusher(
            '7f51f4507b4bb821abc5',
            '3606d52162001e99ac4c',
            '439730',
            $options
        );

        $data['message'] = $message;
        $pusher->trigger('my-channel', 'my-event', $data);


    }

}