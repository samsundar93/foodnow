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
use Cake\Utility\Hash;

class CustomersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Restaurants');
        $this->loadModel('Cuisines');
        $this->loadComponent('Common');
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

        if (!empty($action))
        {
            switch ($action)
            {

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
                        $response['address'] = $response_a['results']['0']['formatted_address'];
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

                case 'RestaurantLists':


                    $sourcelatitude = $this->request->getData('latitude');
                    $sourcelongitude = $this->request->getData('longitude');

                    $currentTime = strtotime(date('h:i A'));
                    $currentDay = strtolower(date('l'));

                    if($sourcelatitude != '' && $sourcelongitude != '') {
                        $restaurantList = $this->Restaurants->find('all', [
                            'fields' => [
                                'restaurant_name',
                                'restaurant_phone',
                                'restaurant_logo',
                                'contact_email',
                                'restaurant_cuisine',
                                'estimate_time',
                                'minimum_order',
                                'delivery_charge',
                                'delivery_distance',
                                'latitude',
                                'longitude',
                                $currentDay.'_firstopen_time',
                                $currentDay.'_firstclose_time',
                                $currentDay.'_secondopen_time',
                                $currentDay.'_secondclose_time',
                                $currentDay.'_status'
                            ],
                            'conditions' => [
                                'OR' => [
                                    'restaurant_pickup' => 'Yes',
                                    'restaurant_delivery' => 'Yes'
                                ],
                                'id IS NOT NULL',
                                'status' => '1',
                                'delete_status' => 'N'
                            ]
                        ])->hydrate(false)->toArray();

                        $final = array();
                        $distance = array();
                        $result = array();
                        $allCuisinesList = array();

                        $cuisinesLists = '';
                        foreach($restaurantList as $key => $value) {

                            $restaurantCuisine = explode(',',$value['restaurant_cuisine']);
                            $cuisineList = '';

                            if(!empty($restaurantCuisine)) {
                                foreach ($restaurantCuisine as $ckey => $cvalue) {
                                    $cuisines = $this->Cuisines->find('all', [
                                        'conditions' => [
                                            'id' => $cvalue
                                        ]
                                    ])->hydrate(false)->first();
                                    if(!empty($cuisines)) {
                                        $cuisineList[] = $cuisines['cuisine_name'];
                                        if(!in_array($cvalue,$allCuisinesList)) {
                                            $allCuisinesList[] = $cvalue;
                                            $allCuisinesLists[$cvalue] = $cuisines['cuisine_name'];
                                            $cuisinesLists .= $cuisines['cuisine_name'].',';
                                        }
                                    }
                                }
                            }

                            $value['cuisineLists'] = implode(',',$cuisineList);


                            $latitudeTo  = $value['latitude'];
                            $longitudeTo = $value['longitude'];

                            $unit='K';
                            $distance = $this->Common->getDistanceValue($sourcelatitude,$sourcelongitude,$latitudeTo,$longitudeTo,
                                $unit);

                            $distance = str_replace(',','',$distance);

                            if (($distance <= $value['delivery_distance']) || (trim($distance) == 0)) {
                                $value['to_distance'] = $distance;

                                $firstOpenTime = strtotime($value[$currentDay.'_firstopen_time']);
                                $firstCloseTime = strtotime($value[$currentDay.'_firstclose_time']);

                                $secondOpenTime = strtotime($value[$currentDay.'_secondopen_time']);
                                $secondCloseTime = strtotime($value[$currentDay.'_secondclose_time']);
                                if($value[$currentDay.'_status'] != 'Closed') {
                                    if($currentTime > $firstOpenTime && $currentTime <= $firstCloseTime) {
                                        $final[] = $value;
                                    }else if($currentTime > $secondOpenTime && $currentTime <= $secondCloseTime) {
                                        $final[] = $value;
                                    }else {
                                        $value['currentStatus'] = 'Open';
                                        $final[] = $value;
                                    }
                                }else {
                                    $value['currentStatus'] = 'Closed';
                                    $final[] = $value;
                                }
                            }
                        }
                        if(!empty($final)) {
                            $result = Hash::sort($final, '{n}.to_distance', 'asc');
                        }

                        if(!empty($result)) {
                            $response['success'] = 1;
                            $response['restaurantLists'] = $result;
                            $response['cuisinesLists'] = trim($cuisinesLists,',');
                        }else {
                            $response['success'] = 0;
                            $response['message'] = 'There is no restaurants';
                        }

                    }

                    break;

                case 'restuarantDetails':

                    $this->loadModel('RestaurantMenus');
                    $restaurantMenuList = $this->RestaurantMenus->find('all', [
                        'conditions' => [
                            'RestaurantMenus.restaurant_id' => $this->request->getData('id'),
                            'RestaurantMenus.status' => '1',
                            'RestaurantMenus.delete_status' => 'N',
                        ],
                        'contain' => [
                            'Categories' => [
                                'fields' => [
                                    'Categories.catname'
                                ],
                                'conditions' => [
                                    'Categories.status' => '1'
                                ]
                            ]
                        ]

                    ])->hydrate(false)->toArray();
                    /*$restaurantDetails = $this->Restaurants->find('all', [
                        'fields' => [
                            'id'
                        ],
                        'conditions' => [
                            'Restaurants.id' => $this->request->getData('id')
                        ],
                        'contain' => [
                            'RestaurantMenus' => [
                                'conditions' => [
                                    'RestaurantMenus.status' => '1',
                                    'RestaurantMenus.delete_status' => 'N',
                                ],
                                'Categories' => [
                                    'fields' => [
                                        'Categories.catname'
                                    ],
                                    'conditions' => [
                                        'Categories.status' => '1'
                                    ]
                                ]
                            ]
                        ]
                    ])->hydrate(false)->first();*/

                    if(!empty($restaurantMenuList)) {
                        $response['success'] = 1;
                        $response['restaurantMenuList'] = $restaurantMenuList;
                    }else {
                        $response['success'] = 0;
                        $response['message'] = 'There is no menu';
                    }
                    break;


            }
            die(json_encode($response));
        }
    }
}