<?php
/**
 * Created by PhpStorm.
 * User: Support
 * Date: 14-12-2017
 * Time: 11:59
 */
namespace App\Controller\Mobile;

use App\Controller\AppController;
use Cake\Event\Event;

class CustomersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow([
            'index'
        ]);
    }

    public function index()
    {
        $action = $this->request->getData('action');

        if (!empty($action)) {
            switch ($action) {

                case "getAddress":
                    //http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=false'

                    $latitude = $this->request->getData('latitude');
                    $longitude = $this->request->getData('longitude');

                    $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.','.$longitude."&key=AIzaSyA_PDTRdxnfHvK3V6-pApjZQgY8F8E5zOM&sensor=false";


                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    $output = curl_exec($ch);
                    curl_close($ch);
                    $response_a = json_decode($output,true);

                    if($response_a['status'] == 'OK') {
                        $response['success'] = 1;
                        $response['address'] = $response_a['results']['1']['formatted_address'];
                    }else {
                        $response['success'] = 0;
                        $response['address'] = "Can't get current location";
                    }
                    break;

                case 'customerLogin':

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

                                $username   = $this->Customers->find('all',[
                                    'fields' => [
                                        'name',
                                        'id',
                                        'phone_number'
                                    ],
                                    'conditions' => [
                                        'id ='=> $user['user_id']
                                    ]
                                ])->hydrate(false)->first();

                                //Update FCM
                                $updateFCM = $this->Customers->newEntity();
                                $updateFCMPatch = $this->Customers->patchEntity($updateFCM,$this->request->getData());
                                $updateFCMPatch->id = $user['user_id'];
                                $saveCustomerFCM = $this->Customers->save($updateFCMPatch);

                                $response['success'] = 1;
                                $response['message'] = 'Login Successful';
                                $response['name'] = $username['name'];
                                $response['phone_number'] = $username['phone_number'];
                                $response['id'] = $username['id'];
                            }
                            else if(count($sp_status) != 0 && $sp_status[0]['status'] == 0 && $user['role_id'] == '3'){
                                $response['success'] = 0;
                                $response['message'] = 'Your account was deactived';
                            }
                            else{
                                $response['success'] = 0;
                                $response['message'] = 'Your account was deactived';
                            }
                        }else {
                            $response['success'] = 0;
                            $response['message'] = 'Invalid Login';
                        }

                    }else {
                        $response['success'] = 0;
                        $response['message'] = 'Required Fields Missing';
                    }

                    break;
            }
            die(json_encode($response));
        }
    }
}