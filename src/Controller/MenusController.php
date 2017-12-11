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

class MenusController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('default');
        $this->loadModel('RestaurantMenus');
        $this->loadModel('Categories');
        $this->loadModel('Restaurants');
        $this->loadModel('Cuisines');
        $this->loadModel('Carts');
        $this->loadComponent('Common');
    }

    public function beforeFilter(Event $event)
    {
        // Before Login , these are the function we can access
        $this->Auth->allow([
            'lists',
            'index',
            'ajaxaction',
        ]);
    }

    public function lists($resid = null) {

        if($resid != '') {



            if($this->request->session()->read('sessionId') != '') {
                $sessionId =  $this->request->session()->read('sessionId');

            }else {
                $sessionId = session_id();
                $this->request->session()->write('sessionId',$sessionId);
                $this->request->session()->write('resid',$resid);
            }


            $restaurantDetails = $this->Restaurants->find('all', [
                'conditions' => [
                    'id' => $resid
                ]
            ])->hydrate(false)->first();

            if($this->request->session()->read('searchLocation') != '') {

                $prepAddr = str_replace(' ','+',$this->request->session()->read('searchLocation'));


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
                        $restaurantDetails['to_distance'] = $distance;
                    }
                }
            }

            $currentTime = strtotime(date('h:i A'));
            $currentDay = strtolower(date('l'));

            $firstOpenTime = strtotime($restaurantDetails[$currentDay.'_firstopen_time']);
            $firstCloseTime = strtotime($restaurantDetails[$currentDay.'_firstclose_time']);

            $secondOpenTime = strtotime($restaurantDetails[$currentDay.'_secondopen_time']);
            $secondCloseTime = strtotime($restaurantDetails[$currentDay.'_secondclose_time']);
            if($restaurantDetails[$currentDay.'_status'] != 'Closed') {
                if($currentTime > $firstOpenTime && $currentTime <= $firstCloseTime) {
                    $restaurantDetails['currentStatus'] = 'Open';
                    $final[] = $restaurantDetails;
                }else if($currentTime > $secondOpenTime && $currentTime <= $secondCloseTime) {
                    $restaurantDetails['currentStatus'] = 'Open';
                    $final[] = $restaurantDetails;
                }else if($currentTime > $firstCloseTime && $currentTime <= $secondOpenTime) {
                    $restaurantDetails['currentStatus'] = 'PreOrder';
                    $final[] = $restaurantDetails;
                }else {
                    $restaurantDetails['currentStatus'] = 'Closed';
                    $final[] = $restaurantDetails;
                }
            }else {
                $restaurantDetails['currentStatus'] = 'Closed';
                $final[] = $restaurantDetails;
            }

            $menuDetails = $this->Categories->find('all', [
                'conditions' => [
                    'Categories.status' => '1',
                    'Categories.delete_status' => 'N',
                    'Categories.restaurant_id' => $resid
                ],
                'contain' => [
                    'RestaurantMenus.MenuDetails'
                ],
                'order' => [
                    'Categories.id' => 'ASC'
                ]


            ])->hydrate(false)->toArray();



            $restaurantCuisine = explode(',',$restaurantDetails['restaurant_cuisine']);


            if(!empty($restaurantCuisine)) {
                foreach ($restaurantCuisine as $key => $value) {
                    $cuisines = $this->Cuisines->find('all', [
                        'conditions' => [
                            'id' => $value
                        ]
                    ])->hydrate(false)->first();
                    if(!empty($cuisines)) {
                        $cuisineList[] = $cuisines['cuisine_name'];
                    }
                }

            }
            $cuisinesList = implode(',',$cuisineList);


            $cartsDetails = $this->Carts->find('all', [
                'sum(Carts.price) AS ctotal',
                'conditions' => [
                    'session_id' => $sessionId,
                ],
                'contain' => [
                    'RestaurantMenus' => [
                        'conditions' => [
                            'RestaurantMenus.delete_status' => 'N'
                        ]
                    ]
                ],
                'order' => [
                    'Carts.menu_id' => 'ASC'
                ]
            ])->hydrate(false)->toArray();

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
            $deliveryCharge = (isset($final[0]['delivery_charge'])) ? $final[0]['delivery_charge'] : '0.00';

            $totalAmount = $subTotal + $taxAmount + $deliveryCharge;

            $minimumOrder = $final[0]['minimum_order'];

            if($subTotal >= $minimumOrder ) {
                $minimumOrder = '1';
            }else {
                $minimumOrder = '0';
            }
            $minimumOrderAmount = $final[0]['minimum_order'];


            $this->set(compact('menuDetails','restaurantDetails','cuisinesList','cartsDetails','cartCount','taxAmount','subTotal','totalAmount','deliveryCharge','final','minimumOrder','minimumOrderAmount'));
        }else {
            return $this->redirect(BASE_URL);
        }


    }

    public function index() {

    }

    public function ajaxaction() {
        if($this->request->getData('action') == 'cartUpdate') {

            $menuDetails = $this->RestaurantMenus->find('all', [
                'conditions' => [
                    'RestaurantMenus.id' => $this->request->getData('menuid')
                ],
                'contain' => [
                    'MenuDetails'
                ]
            ])->hydrate(false)->first();

            if($menuDetails['restaurant_id'] != $this->request->session()->read('resid')) {
                session_regenerate_id();
                $this->request->session()->write('sessionId','');
            }

            if($this->request->session()->read('sessionId') != '') {
                $sessionId =  $this->request->session()->read('sessionId');

            }else {
                $sessionId = session_id();
                $this->request->session()->write('sessionId',$sessionId);
                $this->request->session()->write('resid',$menuDetails['restaurant_id']);
            }
            $cartDetails = $this->Carts->find('all', [
                'fields' => [
                    'id',
                    'quantity'
                ],
                'conditions' => [
                    'menu_id' => $this->request->getData('menuid'),
                    'session_id' => $sessionId,
                    'restaurant_id' => $this->request->session()->read('resid'),
                ]
            ])->hydrate(false)->first();



            if(!empty($cartDetails)) {
                if($this->request->getData('type') == 'add') {
                    $cartUpdate['quantity'] = $cartDetails['quantity'] +1;
                }else {
                    $cartUpdate['quantity'] = $cartDetails['quantity'] -1;
                }

                $cartUpdate['price'] = $menuDetails['menu_details'][0]['orginal_price'] * $cartUpdate['quantity'];

                $cartEntity = $this->Carts->newEntity();
                $cartPatch = $this->Carts->patchEntity($cartEntity,$cartUpdate);
                $cartPatch->id = $cartDetails['id'];
                $cartSave = $this->Carts->save($cartPatch);

                if($cartUpdate['quantity'] == 0) {

                    $entity = $this->Carts->get($cartDetails['id']);
                    $result = $this->Carts->delete($entity);
                }
            }else {
                $cartUpdate['quantity'] = 1;
                $cartUpdate['session_id'] = session_id();
                $cartUpdate['menu_id'] = $this->request->getData('menuid');
                $cartUpdate['restaurant_id'] = $menuDetails['restaurant_id'];
                $cartUpdate['category_id'] = $menuDetails['category_id'];
                $cartUpdate['price'] = $menuDetails['menu_details'][0]['orginal_price'] * $cartUpdate['quantity'];

                $cartEntity = $this->Carts->newEntity();
                $cartPatch = $this->Carts->patchEntity($cartEntity,$cartUpdate);
                $cartSave = $this->Carts->save($cartPatch);
            }

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

            $restaurantDetails = $this->Restaurants->find('all', [
                'conditions' => [
                    'id' => $menuDetails['restaurant_id']
                ]
            ])->hydrate(false)->first();

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
            $deliveryCharge = $restaurantDetails['delivery_charge'];

            $totalAmount = $subTotal + $taxAmount + $deliveryCharge;

            $minimumOrder = $restaurantDetails['minimum_order'];

            if($subTotal >= $minimumOrder ) {
                $minimumOrder = '1';
            }else {
                $minimumOrder = '0';
            }

            //pr($cartsDetails);die();
            $action = $this->request->getData('action');
            $this->set(compact('action','cartsDetails','taxAmount','subTotal','totalAmount','deliveryCharge','minimumOrder'));

        }
    }
}