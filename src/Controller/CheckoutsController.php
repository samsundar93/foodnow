<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/11/2017
 * Time: 11:14 PM
 */
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\Table;
use Cake\Network\Session;
use Cake\Utility\Hash;
use Cake\Http\Client;
class CheckoutsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('default');
        $this->loadModel('Customers');
        $this->loadModel('Carts');
        $this->loadModel('Restaurants');
        $this->loadModel('Addressbooks');
        $this->loadModel('Orders');
        $this->loadModel('Stripecards');
        $this->loadComponent('Common');
        $this->loadComponent('FcmNotification');
        $this->loadComponent('PushNotification');
    }

    public function beforeFilter(Event $event)
    {
        // Before Login , these are the function we can access
        $this->Auth->allow([
            'index'
        ]);
    }

    public function index() {

        //pr($this->request->getData());die();
        if($this->request->session()->read('sessionId') != '') {
            $sessionId =  $this->request->session()->read('sessionId');

        }else {
            return $this->redirect(BASE_URL);
        }
        if($sessionId != '') {

            //Cart Details
            $cartsDetails = $this->Carts->find('all', [
                'conditions' => [
                    'session_id' => $sessionId,
                ],
                'contain' => [
                    'RestaurantMenus'
                ],
                'order' => [
                    'Carts.menu_id' => 'ASC'
                ]
            ])->hydrate(false)->toArray();

            if(empty($cartsDetails)) {
                return $this->redirect(BASE_URL);
            }


            $customerDetails = $this->Customers->find('all', [
                'conditions' => [
                    'id' => $this->Auth->user('user_id')
                ],
                'contain' => [
                    'Addressbooks'
                ]
            ])->hydrate(false)->toArray();

            $saveCardDetails = $this->Stripecards->find('all', [
                'conditions' => [
                    'customer_id' => $this->Auth->user('user_id')
                ]
            ])->hydrate(false)->toArray();



            $singleCart = $this->Carts->find('all', [
                'conditions' => [
                    'session_id' => $sessionId,
                ],
                'order' => [
                    'Carts.menu_id' => 'ASC'
                ]
            ])->hydrate(false)->first();


            $restaurantDetails = $this->Restaurants->find('all', [
                'conditions' => [
                    'id' => $singleCart['restaurant_id']
                ]
            ])->hydrate(false)->first();



            $cartCount = count($cartsDetails);
            $subTotal = 0;
            $taxAmount = 0;
            if(!empty($cartsDetails)) {
                foreach($cartsDetails as $ckey => $cvalue) {
                    $subTotal = $cvalue['price'] + $subTotal;
                }
                if($restaurantDetails['restaurant_tax'] > 0) {
                    $taxAmount = ($subTotal * $restaurantDetails['restaurant_tax'])/100;
                }
            }
            //$deliveryCharge = (isset($final[0]['delivery_charge'])) ? $final[0]['delivery_charge'] : '0.00';

            $totalAmount = $subTotal + $taxAmount;


            //Addressbook Details
            $addressBooks = $this->Addressbooks->find('all', [
                'conditions' => [
                    'customer_id' => $this->Auth->user('user_id'),
                    'delete_status' => 'N',
                    'status' => '1'
                ],
                'order' => [
                    'id' => 'DESC'
                ],
                //'limit' => '2'
            ])->hydrate(false)->toArray();

            //pr($addressBooks);die();
            $addressBookLists = '';
            $outOfDelivery = '';
            if(!empty($addressBooks)) {
                foreach($addressBooks as $key => $value) {

                    $sourcelatitude = $value['latitude'];
                    $sourcelongitude = $value['longitude'];

                    if($sourcelatitude != '' && $sourcelongitude != '') {

                        $final = array();
                        $distance = array();
                        $result = array();

                        $latitudeTo  = $restaurantDetails['latitude'];
                        $longitudeTo = $restaurantDetails['longitude'];
                        $unit='K';
                        $distance = $this->Common->getDistanceValue($sourcelatitude,$sourcelongitude,$latitudeTo,$longitudeTo,
                            $unit);

                        $distance = str_replace(',','',$distance);

                        if (($distance <= $restaurantDetails['delivery_distance']) || (trim($distance) == 0)) {
                            $value['to_distance'] = $distance;
                            $addressBookLists[] = $value;
                        }else {
                            $outOfDelivery[] = $value;
                        }
                    }
                }
            }

            if(!empty($addressBookLists)) {
                $addressBookLists = Hash::sort($addressBookLists, '{n}.to_distance', 'asc');
                $deliveryCharge = (isset($restaurantDetails['delivery_charge'])) ? $restaurantDetails['delivery_charge'] : '0.00';

                $withOutDelivery = $totalAmount;

                $totalAmount = $totalAmount + $deliveryCharge;


            }
            //pr($addressBookLists);die();


            $totalAddress = $this->Addressbooks->find('all', [
                'conditions' => [
                    'customer_id' => $this->Auth->user('user_id'),
                    'delete_status' => 'N',
                    'status' => '1'
                ],
                'order' => [
                    'id' => 'DESC'
                ]
            ])->count();

            //Timing Section
            $array_of_time = array ();

            $nowTime = date('h:i A');
            //$nowTime = '12.35 PM';

            $currentTime = strtotime($nowTime);
            $currentDate = date('Y-m-d');

            $currentDay = strtolower(date('l'));
            //$currentDay = 'monday';

            $firstStartTime = $restaurantDetails[$currentDay.'_firstopen_time'];
            $firstEndTime = $restaurantDetails[$currentDay.'_firstclose_time'];

            $secondStartTime = $restaurantDetails[$currentDay.'_secondopen_time'];
            $secondEndTime = $restaurantDetails[$currentDay.'_secondclose_time'];


            $firstOpenTime = strtotime($restaurantDetails[$currentDay.'_firstopen_time']);
            $firstCloseTime = strtotime($restaurantDetails[$currentDay.'_firstclose_time']);

            $secondOpenTime = strtotime($restaurantDetails[$currentDay.'_secondopen_time']);
            $secondCloseTime = strtotime($restaurantDetails[$currentDay.'_secondclose_time']);


            //In first Timing section
            if($restaurantDetails[$currentDay.'_status'] != 'Closed') {

                if($currentTime < $firstOpenTime) {

                    $restaurantDetails['currentStatus'] = 'Open';
                    $final[] = $restaurantDetails;

                    $nowTime = date("h:i A", strtotime('+45 minutes', $firstOpenTime));

                    $start_time = strtotime($currentDate . ' ' . $nowTime);
                    $end_time = strtotime($currentDate . ' ' . $firstEndTime);

                    $fifteen_mins = 15 * 60;

                    while ($start_time <= $end_time) {
                        $array_of_time[] = date("Y-m-d h:i A", $start_time);
                        $start_time += $fifteen_mins;
                    }

                }

                if ($currentTime > $firstOpenTime && $currentTime <= $firstCloseTime) {
                    $restaurantDetails['currentStatus'] = 'Open';
                    $final[] = $restaurantDetails;

                    $nowTime = date("h:i A", strtotime('+45 minutes', $currentTime));

                    $start_time = strtotime($currentDate . ' ' . $nowTime);
                    $end_time = strtotime($currentDate . ' ' . $firstEndTime);

                    $fifteen_mins = 15 * 60;

                    while ($start_time <= $end_time) {
                        $array_of_time[] = date("Y-m-d h:i A", $start_time);
                        $start_time += $fifteen_mins;
                    }

                    //print_r ($array_of_time);die();

                }

                if (empty($array_of_time)) {

                    if ($currentTime > $firstCloseTime && $currentTime <= $secondOpenTime) {
                        $restaurantDetails['currentStatus'] = 'PreOrder';
                        $final[] = $restaurantDetails;

                        $secondStartTime = date("h:i A", strtotime('+45 minutes', $secondOpenTime));

                        $start_time = strtotime($currentDate . ' ' . $secondStartTime);
                        $end_time = strtotime($currentDate . ' ' . $secondEndTime);

                        $fifteen_mins = 15 * 60;

                        while ($start_time <= $end_time) {
                            $array_of_time[] = date("Y-m-d h:i A", $start_time);
                            $start_time += $fifteen_mins;
                        }

                        //print_r ($array_of_time);
                    }
                } else {
                    if ($currentTime < $secondOpenTime) {
                        //$secondStartTime = 45 * 60;
                        $secondStartTime = date("h:i A", strtotime('+45 minutes', $secondOpenTime));
                        $start_time = strtotime($currentDate . ' ' . $secondStartTime);
                        $end_time = strtotime($currentDate . ' ' . $secondEndTime);

                        $fifteen_mins = 15 * 60;

                        while ($start_time <= $end_time) {
                            $array_of_time[] = date("Y-m-d h:i A", $start_time);
                            $start_time += $fifteen_mins;
                        }
                    }
                }

                if ($currentTime > $secondOpenTime && $currentTime <= $secondCloseTime) {
                    $restaurantDetails['currentStatus'] = 'Open';
                    $final[] = $restaurantDetails;

                    $nowTime = date("h:i A", strtotime('+45 minutes', $currentTime));

                    $start_time = strtotime($currentDate . ' ' . $nowTime);
                    $end_time = strtotime($currentDate . ' ' . $secondEndTime);

                    $fifteen_mins = 15 * 60;

                    while ($start_time <= $end_time) {
                        $array_of_time[] = date("Y-m-d h:i A", $start_time);
                        $start_time += $fifteen_mins;
                    }

                    //print_r ($array_of_time);
                }
            }

            $this->set(compact('restaurantDetails','cuisinesList','cartsDetails','cartCount','taxAmount','subTotal','totalAmount','deliveryCharge','final','customerDetails','addressBooks','totalAddress','outOfDelivery','addressBookLists','saveCardDetails','withOutDelivery','array_of_time'));
        }
        //pr($customerDetails);die();
    }

    public function ajaxaction() {
        if($this->request->getData('action') == 'selectAddress') {
            if($this->request->getData('addressId') != '') {

                $addressBooks = $this->Addressbooks->find('all', [
                    'conditions' => [
                        'customer_id' => $this->Auth->user('user_id'),
                        'id' => $this->request->getData('addressId'),
                        'delete_status' => 'N',
                        'status' => '1'
                    ],
                    'order' => [
                        'id' => 'DESC'
                    ],
                    //'limit' => '2'
                ])->hydrate(false)->first();
                $action = $this->request->getData('action');
                $this->set(compact('addressBooks','action'));
            }
        }

        if($this->request->getData('action') == 'addAddress') {

            $conditions = [
                'title' => $this->request->getData('title'),
                'customer_id' => $this->Auth->user('user_id')
            ];

            $addressCount = $this->Addressbooks->find('all', [
                'conditions' => $conditions
            ])->count();

            if($addressCount != 0) {
                echo '1';die();
            }

            $restaurantDetails = $this->Restaurants->find('all', [
                'conditions' => [
                    'id' => $this->request->getData('resId')
                ]
            ])->hydrate(false)->first();

            $prepAddr = str_replace(' ','+',$this->request->getData('address'));


            /*$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.
                '&sensor=false');

            $output= json_decode($geocode);*/

            $url = "https://maps.google.com/maps/api/geocode/json?address=$prepAddr&key=AIzaSyA_PDTRdxnfHvK3V6-pApjZQgY8F8E5zOM&sensor=false&region=India";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $response = curl_exec($ch);
            curl_close($ch);
            $response_a = json_decode($response);

            /*$sourcelatitude = $output->results[0]->geometry->location->lat;
            $sourcelongitude = $output->results[0]->geometry->location->lng;*/

            $sourcelatitude = $response_a->results[0]->geometry->location->lat;
            $sourcelongitude = $response_a->results[0]->geometry->location->lng;

            if($sourcelatitude != '' && $sourcelongitude != '') {

                $final = array();
                $distance = array();
                $result = array();

                $latitudeTo  = $restaurantDetails['latitude'];
                $longitudeTo = $restaurantDetails['longitude'];
                $unit='K';
                $distance = $this->Common->getDistanceValue($sourcelatitude,$sourcelongitude,$latitudeTo,$longitudeTo,
                    $unit);

                $distance = str_replace(',','',$distance);

                if (($distance <= $restaurantDetails['delivery_distance']) || (trim($distance) == 0)) {

                    $addressEntity = $this->Addressbooks->newEntity();
                    $addressPatch = $this->Addressbooks->patchEntity($addressEntity,$this->request->getData());
                    $addressPatch->latitude = $sourcelatitude;
                    $addressPatch->longitude = $sourcelongitude;
                    $addressPatch->customer_id = $this->Auth->user('user_id');
                    $addressSave = $this->Addressbooks->save($addressPatch);

                    $addressBooks = $this->Addressbooks->find('all', [
                        'conditions' => [
                            'customer_id' => $this->Auth->user('user_id'),
                            'id' => $addressSave->id,
                            'delete_status' => 'N',
                            'status' => '1'
                        ],
                        'order' => [
                            'id' => 'DESC'
                        ],
                        //'limit' => '2'
                    ])->hydrate(false)->first();
                    $action = 'selectAddress';
                    $this->set(compact('addressBooks','action'));

                }else {
                    echo 'error';die();
                }
            }
        }

        if($this->request->getData('action') == 'selectAllAddress') {

            $addressBooks = $this->Addressbooks->find('all', [
                'conditions' => [
                    'customer_id' => $this->Auth->user('user_id'),
                    'delete_status' => 'N',
                    'status' => '1'
                ],
                'order' => [
                    'id' => 'DESC'
                ],
                //'limit' => '2'
            ])->hydrate(false)->toArray();

            $restaurantDetails = $this->Restaurants->find('all', [
                'conditions' => [
                    'id' => $this->request->getData('resId')
                ]
            ])->hydrate(false)->first();

            //pr($addressBooks);die();
            $addressBookLists = '';
            $outOfDelivery = '';
            if(!empty($addressBooks)) {
                foreach($addressBooks as $key => $value) {

                    $sourcelatitude = $value['latitude'];
                    $sourcelongitude = $value['longitude'];

                    if($sourcelatitude != '' && $sourcelongitude != '') {

                        $final = array();
                        $distance = array();
                        $result = array();

                        $latitudeTo  = $restaurantDetails['latitude'];
                        $longitudeTo = $restaurantDetails['longitude'];
                        $unit='K';
                        $distance = $this->Common->getDistanceValue($sourcelatitude,$sourcelongitude,$latitudeTo,$longitudeTo,
                            $unit);

                        $distance = str_replace(',','',$distance);

                        if (($distance <= $restaurantDetails['delivery_distance']) || (trim($distance) == 0)) {
                            $value['to_distance'] = $distance;
                            $addressBookLists[] = $value;
                        }else {
                            $outOfDelivery[] = $value;
                        }
                    }
                }
            }

            if(!empty($addressBookLists)) {
                $addressBookLists = Hash::sort($addressBookLists, '{n}.to_distance', 'asc');
            }
            $action = $this->request->getData('action');
            $this->set(compact('addressBookLists','action'));
        }

        if($this->request->getData('action') == 'getTiming') {

            if($this->request->getData('date') != '') {

                $restaurantDetails = $this->Restaurants->find('all', [
                    'conditions' => [
                        'id' => $this->request->session()->read('resid')
                    ]
                ])->hydrate(false)->first();


                //Timing Section
                $array_of_time = array ();

                $nowTime = date('h:i A');
                //$nowTime = '12.35 PM';

                $currentTime = strtotime($nowTime);
                $currentDate = $this->request->getData('date');

                $today = date('Y-m-d');

                $currentDay = strtolower(date('l'));
                //$currentDay = 'monday';

                $firstStartTime = $restaurantDetails[$currentDay.'_firstopen_time'];
                $firstEndTime = $restaurantDetails[$currentDay.'_firstclose_time'];

                $secondStartTime = $restaurantDetails[$currentDay.'_secondopen_time'];
                $secondEndTime = $restaurantDetails[$currentDay.'_secondclose_time'];


                $firstOpenTime = strtotime($restaurantDetails[$currentDay.'_firstopen_time']);
                $firstCloseTime = strtotime($restaurantDetails[$currentDay.'_firstclose_time']);

                $secondOpenTime = strtotime($restaurantDetails[$currentDay.'_secondopen_time']);
                $secondCloseTime = strtotime($restaurantDetails[$currentDay.'_secondclose_time']);


                //In first Timing section
                if($restaurantDetails[$currentDay.'_status'] != 'Closed') {

                    $restaurantDetails['currentStatus'] = 'Open';
                    $final[] = $restaurantDetails;

                    if(strtotime($today) != strtotime($currentDate)) {

                        $nowTime = date("h:i A", strtotime('+45 minutes', $firstOpenTime));

                        $start_time = strtotime($currentDate . ' ' . $nowTime);
                        $end_time = strtotime($currentDate . ' ' . $firstEndTime);

                        $fifteen_mins = 15 * 60;

                        while ($start_time <= $end_time) {
                            $array_of_time[] = date("h:i A", $start_time);
                            $start_time += $fifteen_mins;
                        }

                        $secondStartTime = date("h:i A", strtotime('+45 minutes', $secondOpenTime));
                        $start_time = strtotime($currentDate . ' ' . $secondStartTime);
                        $end_time = strtotime($currentDate . ' ' . $secondEndTime);

                        $fifteen_mins = 15 * 60;

                        while ($start_time <= $end_time) {
                            $array_of_time[] = date("h:i A", $start_time);
                            $start_time += $fifteen_mins;
                        }

                    }else {

                        if($currentTime < $firstOpenTime) {

                            $firstOpenTime = date("h:i A", strtotime('+45 minutes', $firstOpenTime));

                            $start_time = strtotime($currentDate . ' ' . $firstOpenTime);
                            $end_time = strtotime($currentDate . ' ' . $firstEndTime);

                            $fifteen_mins = 15 * 60;

                            while ($start_time <= $end_time) {
                                $array_of_time[] = date("h:i A", $start_time);
                                $start_time += $fifteen_mins;
                            }

                            $secondStartTime = date("h:i A", strtotime('+45 minutes', $secondOpenTime));
                            $start_time = strtotime($currentDate . ' ' . $secondStartTime);
                            $end_time = strtotime($currentDate . ' ' . $secondEndTime);

                            $fifteen_mins = 15 * 60;

                            while ($start_time <= $end_time) {
                                $array_of_time[] = date("h:i A", $start_time);
                                $start_time += $fifteen_mins;
                            }

                        }

                        if($currentTime > $firstOpenTime && $currentTime <= $firstCloseTime) {


                            $nowTime = date("h:i A", strtotime('+45 minutes', $currentTime));

                            $start_time = strtotime($currentDate . ' ' . $nowTime);
                            $end_time = strtotime($currentDate . ' ' . $firstEndTime);

                            $fifteen_mins = 15 * 60;

                            while ($start_time <= $end_time) {
                                $array_of_time[] = date("h:i A", $start_time);
                                $start_time += $fifteen_mins;
                            }

                            $secondStartTime = date("h:i A", strtotime('+45 minutes', $secondOpenTime));
                            $start_time1 = strtotime($currentDate . ' ' . $secondStartTime);
                            $end_time1 = strtotime($currentDate . ' ' . $secondEndTime);

                            $fifteen_mins = 15 * 60;

                            while ($start_time1 <= $end_time1) {
                                $array_of_time[] = date("h:i A", $start_time1);
                                $start_time1 += $fifteen_mins;
                            }

                        }

                        if(empty($array_of_time)) {

                            if($currentTime > $firstCloseTime && $currentTime < $secondOpenTime ) {

                                $secondStartTime = date("h:i A", strtotime('+45 minutes', $secondOpenTime));
                                $start_time = strtotime($currentDate . ' ' . $secondStartTime);
                                $end_time = strtotime($currentDate . ' ' . $secondEndTime);

                                $fifteen_mins = 15 * 60;

                                while ($start_time <= $end_time) {
                                    $array_of_time[] = date("h:i A", $start_time);
                                    $start_time += $fifteen_mins;
                                }

                            }
                        }

                        if($currentTime > $secondOpenTime && $currentTime <= $secondCloseTime) {


                            $currentTime = date("h:i A", strtotime('+45 minutes', $currentTime));
                            $start_time = strtotime($currentDate . ' ' . $currentTime);
                            $end_time = strtotime($currentDate . ' ' . $secondEndTime);

                            $fifteen_mins = 15 * 60;

                            while ($start_time <= $end_time) {
                                $array_of_time[] = date("h:i A", $start_time);
                                $start_time += $fifteen_mins;
                            }
                        }
                    }
                }
                $action = $this->request->getData('action');
                $this->set(compact('array_of_time','action'));
            }

        }
    }

    public function placeOrder() {
        //pr($this->request->getData());die();

        if($this->request->getData('order_type') != '' && $this->request->getData('payment_method') != '' && $this->request->getData('resId') != '') {

            if($this->request->session()->read('sessionId') != '') {
                $sessionId =  $this->request->session()->read('sessionId');

            }
            if($sessionId != '') {

                $customerDetails = $this->Customers->find('all', [
                    'conditions' => [
                        'id' => $this->Auth->user('user_id')
                    ]
                ])->hydrate(false)->first();

                //Cart Details
                $cartsDetails = $this->Carts->find('all', [
                    'conditions' => [
                        'session_id' => $sessionId,
                    ]
                ])->hydrate(false)->toArray();


                $restaurantDetails = $this->Restaurants->find('all', [
                    'conditions' => [
                        'id' => $this->request->getData('resId')
                    ]
                ])->hydrate(false)->first();



                $cartCount = count($cartsDetails);
                $subTotal = 0;
                $taxAmount = 0;
                if(!empty($cartsDetails)) {
                    foreach($cartsDetails as $ckey => $cvalue) {
                        $subTotal = $cvalue['price'] + $subTotal;
                    }
                    if($restaurantDetails['restaurant_tax'] > 0) {
                        $taxAmount = ($subTotal * $restaurantDetails['restaurant_tax'])/100;
                    }
                }
                $deliveryCharge = (isset($restaurantDetails['delivery_charge'])) ? $restaurantDetails['delivery_charge'] : '0.00';

                if($this->request->getData('order_type') == 'delivery') {
                    $totalAmount = $subTotal + $taxAmount + $deliveryCharge;
                }else {
                    $totalAmount = $subTotal + $taxAmount;
                }



                //Addressbook Details
                if($this->request->getData('order_type') == 'delivery') {
                    $addressBooks = $this->Addressbooks->find('all', [
                        'conditions' => [
                            'customer_id' => $this->Auth->user('user_id'),
                            'id' => $this->request->getData('checkout_address'),
                            'delete_status' => 'N',
                            'status' => '1'
                        ]
                    ])->hydrate(false)->first();

                    $orderUpdate['delivery_address'] = $addressBooks['address'];
                }


                //Save Order Section
                $orderEntity = $this->Orders->newEntity();
                $orderUpdate['customer_id'] = $this->Auth->user('user_id');
                $orderUpdate['restaurant_id'] = $this->request->getData('resId');
                $orderUpdate['customer_name'] = $customerDetails['name'];
                $orderUpdate['customer_email'] = $customerDetails['username'];
                $orderUpdate['customer_phone'] = $customerDetails['phone_number'];
                $orderUpdate['session_id'] = $sessionId;
                $orderUpdate['payment_mode'] = $this->request->getData('payment_method');
                $orderUpdate['taxamount'] = $taxAmount;
                $orderUpdate['delivery_date'] = $this->request->getData('delivery_date');
                $orderUpdate['delivery_time'] = $this->request->getData('deliveryTime');
                $orderUpdate['delivery_charge'] = ($this->request->getData('order_type') == 'delivery') ?  $deliveryCharge : '';
                $orderUpdate['subtotal'] = $subTotal;
                $orderUpdate['order_type'] = $this->request->getData('order_type');
                $orderUpdate['grand_total'] = $totalAmount;
                $orderUpdate['instruction'] = $this->request->getData('instruction');

                $orderPatch = $this->Orders->patchEntity($orderEntity,$orderUpdate);

                if($this->request->getData('payment_method') == 'cod') {

                    $orderSave = $this->Orders->save($orderPatch);
                    if($orderSave) {

                        $ordergenid = $this->Common->generateId($orderSave->id);
                        $finalorderid = "EAT".$ordergenid;

                        $orderUpdate['order_number']  =  $finalorderid;
                        $orderUpdate['id']                =  $orderSave->id;
                        $leadsupdt = $this->Orders->patchEntity($orderEntity,$orderUpdate);
                        $leadssave = $this->Orders->save($leadsupdt);

                        //Update orderiD to Cart Table
                        foreach($cartsDetails as $key => $value) {
                            $cartEntity = $this->Carts->newEntity();
                            $cartUpdate['order_id'] = $orderSave->id;
                            $cartPatch = $this->Carts->patchEntity($cartEntity,$cartUpdate);
                            $cartPatch->id = $value['id'];
                            $cartSave = $this->Carts->save($cartPatch);
                        }

                        $this->request->session()->write('sessionId','');
                        session_regenerate_id();

                        if($this->request->getData('order_type') == 'delivery') {
                            $action = 'orderupdate';
                            //Send Order to Dispatch
                            $data = [
                                'restaurant_id' => $this->request->getData('resId'),
                                'restaurant_name' => $restaurantDetails['restaurant_name'],
                                'restaurant_phone' => $restaurantDetails['contact_phone'],
                                'customer_name' => $customerDetails['name'],
                                'customer_phone' => $customerDetails['phone_number'],
                                'delivery_address' => $addressBooks['address'],
                                'customer_id' => $this->Auth->user('user_id'),
                                'payment_type' => $this->request->getData('payment_method'),
                                'total' => $totalAmount,
                                'delivery_date' => $this->request->getData('delivery_date'),
                                'delivery_time' => $this->request->getData('deliveryTime'),
                                'order_id' => $finalorderid,
                                'order_instruction' => $this->request->getData('instruction'),
                            ];
                            $data = $this->Common->dispatch($data,$action);

                        }

                        $orderId = base64_encode($orderSave->id);

                        if($_SERVER['HTTP_HOST'] == 'localhost') {

                            $restaurantFCM = $this->Restaurants->find('all', [
                                'fields' => [
                                    'fcm_id'
                                ],
                                'conditions' => [
                                    'id' => $this->request->getData('resId')
                                ]
                            ])->hydrate(false)->first();

                            //$restaurantFCM['fcm_id'] = 'd3l4kS_Hqgw:APA91bEQ2ygXLgrWjp7Q5qEyOL0cyTRB8QQV3TCRxSa9CVOZ212lQ3ZOKkn1V-yKGTYwJQ8oU_5Tv5EU2JFlM0TPul06-bk9MdtzhzUJoxEZtpfplXj7rJC663IiN0g3UAFzuYQNJytx';
                            if($restaurantFCM['fcm_id'] != '') {

                                $message      = 'New order came - '.$finalorderid;

                                $notificationdata['data']['title']          = "Neworder";
                                $notificationdata['data']['message']        = $message;
                                $notificationdata['data']['is_background']  = false;
                                $notificationdata['data']['payload']        = array('OrderDetails' => "",'type'    => "ordercanceled");
                                $notificationdata['data']['timestamp']      = date('Y-m-d G:i:s');

                                $this->FcmNotification->sendNotification($notificationdata, $restaurantFCM['fcm_id']);

                            }
                        }
                        $message = 'New Order Placed';
                        $this->PushNotification->pushNotification($message);


                        $this->Flash->set(__('Your Order Placed Successful'));
                        return $this->redirect(BASE_URL.'myaccount/trackOrder/'.$orderId);
                    }
                }else if($this->request->getData('payment_method') == 'stripe') {

                    require_once(ROOT . DS . 'vendor' . DS . 'stripe' . DS . 'init.php');
                    \Stripe\Stripe::setApiKey(STRIPE_API_KEY);

                    $token  = $this->request->getData('res-sp-token');
                    $payAmt = $totalAmount*100;



                    if($this->request->getData('stripeId') == '') {

                        // Create a Customer:
                        $customer = \Stripe\Customer::create(array(
                            "email" => $customerDetails['username'],
                            "source" => $token,
                        ));

                        // Charge the Customer instead of the card:
                        $charge = \Stripe\Charge::create(array(
                            "amount" => $payAmt,
                            "currency" => "usd",
                            "customer" => $customer->id
                        ));
                        //Save Stripe's Customer Details in Table
                        $cardEntity = $this->Stripecards->newEntity();
                        $cardInsert['customer_id'] = $this->Auth->user('user_id');
                        $cardInsert['stripe_customer_id'] = $customer->id;
                        $cardInsert['card_id'] = $charge['source']['id'];
                        $cardInsert['card_number'] = $charge['source']['last4'];
                        $cardInsert['card_email'] = $charge['source']['name'];
                        $cardPatch = $this->Stripecards->patchEntity($cardEntity,$cardInsert);
                        $saveCard = $this->Stripecards->save($cardPatch);

                        $orderUpdate['stripe_customerid'] = $customer->id;


                    }else {
                        $stripeDetails = $this->Stripecards->find('all', [
                            'conditions' => [
                                'id' => $this->request->getData('stripeId')
                            ]
                        ])->hydrate(false)->first();
                        if(!empty($stripeDetails)) {

                            // YOUR CODE: Save the customer ID and other info in a database for later.

                            // YOUR CODE (LATER): When it's time to charge the customer again, retrieve the customer ID.
                            $charge = \Stripe\Charge::create(array(
                                "amount" => $payAmt, // $15.00 this time
                                "currency" => "usd",
                                "customer" => $stripeDetails['stripe_customer_id']
                            ));
                            $orderUpdate['stripe_customerid'] = $stripeDetails['stripe_customer_id'];
                        }
                    }


                    $orderSave = $this->Orders->save($orderPatch);
                    if($orderSave) {

                        $ordergenid = $this->Common->generateId($orderSave->id);
                        $finalorderid = "EAT".$ordergenid;

                        $orderUpdate['order_number']  =  $finalorderid;
                        $orderUpdate['transaction_id']  =  $charge['balance_transaction'];
                        $orderUpdate['payment_status']  =  'P';

                        $orderUpdate['id']                =  $orderSave->id;
                        $leadsupdt = $this->Orders->patchEntity($orderEntity,$orderUpdate);
                        $leadssave = $this->Orders->save($leadsupdt);

                        //Update orderiD to Cart Table
                        foreach($cartsDetails as $key => $value) {
                            $cartEntity = $this->Carts->newEntity();
                            $cartUpdate['order_id'] = $orderSave->id;
                            $cartPatch = $this->Carts->patchEntity($cartEntity,$cartUpdate);
                            $cartPatch->id = $value['id'];
                            $cartSave = $this->Carts->save($cartPatch);
                        }

                        $this->request->session()->write('sessionId','');
                        session_regenerate_id();

                        $orderId = base64_encode($orderSave->id);
                        $this->Flash->set(__('Your Order Placed Successful'));
                        return $this->redirect(BASE_URL.'myaccount/trackOrder/'.$orderId);
                    }
                }
            }else {
                return $this->redirect(BASE_URL);
            }

        }
        echo 'cmmmmm';die();
    }

    public function getTiming() {

    }
}