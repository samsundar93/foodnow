<?php
/**
 * Created by PhpStorm.
 * User: Sundar
 * Date: 10/15/2017
 * Time: 7:57 PM
 */
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\Table;
use Cake\Network\Session;
use Mailgun\Mailgun;

require_once(ROOT . DS . 'vendor' . DS . 'Mailgun'. DS . 'Mailgun.php');

class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('default');
    }

    public function beforeFilter(Event $event)
    {
        // Before Login , these are the function we can access
        $this->Auth->allow([
            'index',
            'checkCustomer',
            'customerLogin',
            'search',
            'getLocation',
            'sendMessage',
            'terms',
            'refund',
            'privacy',
            'aboutus',
            'career',
            'help'
        ]);
    }

    public function index() {



        # First, instantiate the SDK with your API credentials
        $mg = Mailgun::create('key-d446caa439f4436a87de9ec76f801694');

        # Now, compose and send your message.
        # $mg->messages()->send($domain, $params);
        /*$mg->messages()->send('fooddp.com', [
            'from'    => 'fooddp.com@fooddp.com',
            'to'      => 'agsgroup93@gmail.com',
            'subject' => 'The PHP SDK is awesome!',
            'text'    => 'It is so simple to send a message.',
            'html'    => $html
        ]);
        die();*/


        if($this->request->session()->read('searchLocation') != '') {
            return $this->redirect(BASE_URL.'restaurants');
        }
    }

    //Check Customer Already Exists Or Not
    public function checkCustomer() {

        $this->loadModel('Customers');
        $this->loadModel('Users');

        $conditions = [
            'OR' => [
                'username' => $this->request->getData('username'),
                'phone_number' => $this->request->getData('phone_number')
            ]
        ];

        $userCount = $this->Customers->find('all', [
            'conditions' => $conditions
        ])->count();

        if($userCount == 0) {
            $customers = $this->Customers->newEntity();
            $customerPatch = $this->Customers->patchEntity($customers, $this->request->getData());
            $saveCustomer = $this->Customers->save($customerPatch);

            if($saveCustomer) {
                $user = $this->Users->newEntity();
                $userDetails['username'] = $this->request->getData('phone_number');
                $userDetails['password'] = $this->request->getData('password');
                $userDetails['user_id'] = $saveCustomer->id;
                $userDetails['role_id'] = '3';
                $usersPatch = $this->Users->patchEntity($user, $userDetails);
                $saveuser = $this->Users->save($usersPatch);
                $this->Flash->success(__('Registered successful '));

                //Email Section
                $mg = Mailgun::create('key-d446caa439f4436a87de9ec76f801694');

                $html = '<!DOCTYPE html>
                            <html>
                               <head>
                                  <title></title>
                                  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                  <meta name="viewport" content="width=device-width, initial-scale=1">
                                  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                               <body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">
                                  <table border="0" cellpadding="0" cellspacing="0" width="60%" style="margin:0px auto;padding:50px 0px;">
                                     <tr>
                                        <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
                                           <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                              <tr>
                                                 <td align="center" valign="top" style="font-size:0; padding:20px 35px;" bgcolor="#252525">
                                                    <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
                                                       <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                                          <tr>
                                                             <td align="left" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;" >
                                                                <img src="'.BASE_URL.'images/logo.png" width="150">
                                                             </td>
                                                          </tr>
                                                       </table>
                                                    </div>
                                                    <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;" class="mobile-hide">
                                                       <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                                          <tr>
                                                             <td align="right" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 25px;">
                                                                <table cellspacing="0" cellpadding="0" border="0" align="right">
                                                                   <tr>
                                                                      <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400;">
                                                                         <p style="font-size: 18px; font-weight: 400; margin: 0; color: #ffffff;"><a style="color: #ffffff; text-decoration: none;">Date : 12/19/2017</a></p>
                                                                         <div style="font-size: 15px; font-weight: 400; margin: 0; color: #ffffff;">Time : '. date("h:i A").'</div>
                                                                      </td>
                                                                   </tr>
                                                                </table>
                                                             </td>
                                                          </tr>
                                                       </table>
                                                    </div>
                                                 </td>
                                              </tr>
                                              <tr>
                                                 <td align="center" style="padding:20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                                                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                                       <tr>
                                                          <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                                                             Dear '.$this->request->getData('name').'!
                                                          </td>                              
                                                       </tr>
                                                       <tr>
                                                          <td align="left" style="font-family: sans-serif, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                                                             Welcome to Fooddp! Thanks so much for joining with us. Enjoy your favorite food and drinks ordered in and avail these awesome offers from top restaurants. Don’t miss out, order now! 
                                                          </td>
                                                       </tr>
                                                       
                                                       <!--<tr align="left" style="font-family: sans-serif, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 50px; padding-top: 25px;">
                                                          <td>
                                                             Please <a target="_blank" href="https://fooddp.com/users/activate">Click Here</a> to activate your account: 
                                                          </td>
                                                       </tr>-->
                                                       
                                                    </table>
                                                 </td>
                                              </tr>
                                              
                                              <tr>
                                                 <td align="center" style=" padding:15px 35px; background-color: #f5861f;" bgcolor="#f5861f">
                                                    <div style="color:#fff;font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400;">All Rights Reserved by fooddp.com</div>
                                                 </td>
                                              </tr>
                                           </table>
                                        </td>
                                     </tr>
                                  </table>
                               </body>
                            </html>';

                # Now, compose and send your message.
                # $mg->messages()->send($domain, $params);
                $mg->messages()->send('fooddp.com', [
                    'from'    => 'fooddp.com@fooddp.com',
                    'to'      => $this->request->getData('username'),
                    'subject' => 'Welcome To FoodDp',
                    'html'    => $html
                ]);
                echo 'true';die();
            }
        }else {
            echo 'false';exit;
        }
    }

    public function customerLogin() {
        $this->loadModel('Users');
        $this->loadModel('Customers');

        if($this->request->getData('username') != '' && $this->request->getData('password') != '') {
            $user           = $this->Auth->identify();

            if(count($user) != 0) {
                $sp_status      = $this->Customers->find('all', [
                    'fields' => [
                        'status'
                    ],
                    'conditions' => [
                        'id ='=> $user['user_id'],
                        'delete_status' => 'No'
                    ]
                ])->hydrate(false)->toArray();

                if(count($sp_status) != 0 && !empty($sp_status[0]['status']) && $sp_status[0]['status'] == '1' &&
                    $user['role_id'] == '3'){

                    $this->Auth->setUser($user);

                    $username   = $this->Customers->find('all',[
                        'fields' => [
                            'name','id'
                        ],
                        'conditions' => [
                            'id ='=> $user['user_id']
                        ]
                    ])->hydrate(false)->first();
                    $this->request->session()->write('customername',$username['name']);
                    $this->Flash->success(__('Login successful.'));
                    echo 1;exit();
                }
                else if(count($sp_status) != 0 && $sp_status[0]['status'] == 0 && $user['role_id'] == '3'){
                    echo 2;exit();
                }
                else{
                    echo 0;exit();
                }
            }else {
                echo 0;exit();
            }

        }else {
            echo 3;die();
        }
    }

    public function logout() {

        $this->request->session()->write('customername','');
        $this->Auth->logout();
        $this->Flash->success(__('Logout successful.'));
        return $this->redirect(BASE_URL);
    }

    public function search() {
        if($this->request->getData('searchLocation') != '') {
            $this->request->session()->write('searchLocation', $this->request->getData('searchLocation'));
            die();
        }
    }

    public function getLocation() {

        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];
        $result  = array('country'=>'', 'city'=>'');
        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }else{
            $ip = $remote;
        }

        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
        if($ip_data && $ip_data->geoplugin_countryName != null){
            $result['country'] = $ip_data->geoplugin_countryCode;
            $result['city'] = $ip_data->geoplugin_city;
        }
        if(!empty($result)) {
            echo $result['country'];die();
        }else {
            die();
        }

    }

    public function login() {
        $this->Flash->error('Your session expired');
        return $this->redirect(BASE_URL);
    }

    public function sendMessage() {

        $content = array(
            "en" => 'Testing Message'
        );

        $fields = array(
            'app_id' => "7279c079-7d7f-4053-a115-3c4dddb99e02",
            'included_segments' => array('All'),
            'data' => array("foo" => "bar"),
            'large_icon' =>"ic_launcher_round.png",
            'contents' => $content
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic OTliNzA2MjEtMjVkNC00ZmYxLTk2NWMtMjAxZDE5MWFlZTM3'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        pr($response);die();

    }

    public function terms() {

    }

    public function refund() {

    }

    public function privacy() {

    }

    public function aboutus() {

    }

    public function career() {

    }

    public function help() {

    }

}