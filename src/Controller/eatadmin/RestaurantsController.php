<?php
/**
 * Created by PhpStorm.
 * User: Sundar
 * Date: 9/29/2017
 * Time: 10:37 PM
 */
namespace App\Controller\Eatadmin;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\Table;
use Excel\Controller\ExcelReaderController;

class RestaurantsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('backend');

        $this->loadModel('Users');
        $this->loadModel('Restaurants');
        $this->loadModel('RestaurantMenus');
        $this->loadModel('MenuDetails');
        $this->loadModel('MenuAddons');
        $this->loadModel('Sitesettings');
        $this->loadModel('Timezones');
        $this->loadModel('Categories');
        $this->loadComponent('Googlemap');
        $this->loadComponent('Common');
    }

    public function index($process = null) {

        $restaurantList = $this->Restaurants->find('all', [
            'conditions' => [
                'delete_status' => 'N'
            ],
            'order' => [
                'id' => 'DESC'
            ]
        ])->hydrate(false)->toArray();

        $this->set(compact('restaurantList'));

        if($process == 'Restaurants' ){
            $value = array($restaurantList);
            return $value;
        }

    }

    public function addedit($id = null) {

        $this->loadModel('Cuisines');

        if($this->request->is('post')) {
            if($this->request->data['restaurantId'] != '') {

                $restaurantDetails = $this->Restaurants->find('all', [
                    'conditions' => [
                        'id' => $this->request->getData('restaurantId')
                    ]
                ])->hydrate(false)->first();


                $users = $this->Users->find('all', [
                    'conditions' =>[
                        'user_id' => $this->request->data['restaurantId']
                    ]
                ])->hydrate(false)->first();
                $this->request->data['id'] = $this->request->data['restaurantId'];

                $conditions = [
                    'id !=' => $this->request->data['restaurantId'],
                    'contact_email' => $this->request->data['contact_email']
                ];

            }else {
                $userDetails['password'] = '1234';
                $conditions = [
                    'contact_email' => $this->request->data['contact_email']
                ];
            }

            $userCount = $this->Restaurants->find('all', [
                'conditions' => $conditions
            ])->count();

            if(!empty($this->request->getData('restaurant_cuisine'))) {
                $restaurantCuisine = implode(',',$this->request->getData('restaurant_cuisine'));
            }else {
                $restaurantCuisine = '';
            }

            $prepAddr = str_replace(' ','+',$this->request->getData('contact_address'));


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

            //Restaurant Logo

            if(isset($this->request->getData('restaurantlogo')['name']) && !empty($this->request->getData('restaurantlogo')['name'])
            ){
                require_once(ROOT . DS . 'vendor' . DS . 'Cloudinary' . DS . 'Cloudinary.php');
                require_once(ROOT . DS . 'vendor' . DS . 'Cloudinary' . DS . 'Uploader.php');
                require_once(ROOT . DS . 'vendor' . DS . 'Cloudinary' . DS . 'Api.php');

                /*$valid     = getimagesize($_FILES['restaurantlogo']['tmp_name']);
                $filePart  = pathinfo($this->request->getData('restaurantlogo')['name']);
                $logo      = ['jpg','jpeg','gif','png'];

                if( $this->request->getData('restaurantlogo')['error'] == 0 &&
                    ($this->request->getData('restaurantlogo')['size'] > 0 ) &&
                    in_array(strtolower($filePart['extension']),$logo) && !empty($valid) ) {

                    $img_path       = RESTAURANT_LOGO_PATH;
                    if(isset($restaurantDetails['restaurant_logo']) && !empty($restaurantDetails['restaurant_logo'])
                        && file_exists(RESTAURANT_LOGO_PATH.'/'.$restaurantDetails['restaurant_logo']))
                        $this->Common->unlinkFile($restaurantDetails['restaurant_logo'], $img_path);
                    $image_detail   = $this->Common->UploadFile($this->request->getData('restaurantlogo'), $img_path);
                    $restaurant_logo  = $image_detail['refName'];

                }*/
                $restaurantName = $this->seoUrl($this->request->getData('restaurant_name'));

                \Cloudinary::config(array(
                    "cloud_name" => "dntzmscli",
                    "api_key" => "213258421718748",
                    "api_secret" => "vTrAbTdKHswpiOQZcHvCv9LqZ3M"
                ));

                $data = \Cloudinary\Uploader::upload($_FILES["restaurantlogo"]["tmp_name"],
                    array(
                        "public_id" => $restaurantName,
                        //"crop" => "limit", "width" => "2000", "height" => "2000",
                        "eager" => array(
                            array( "width" => 269, "height" => 134,
                                "crop" => "fit", "format" => "jpg" )
                        ),
                        "tags" => array( "special", "for_homepage" )
                    ));
                #echo $data['eager'][0]['secure_url'];
                #print_r($data);die();
                $restaurant_logo = $data['eager'][0]['secure_url'];
            }
            else
                $restaurant_logo      = $restaurantDetails['restaurant_logo'];


            $restaurants = $this->Restaurants->newEntity();
            $restaurantPatch = $this->Restaurants->patchEntity($restaurants, $this->request->data);
            $restaurantPatch->restaurant_cuisine = $restaurantCuisine;
            $restaurantPatch['latitude'] = $sourcelatitude;
            $restaurantPatch['longitude'] = $sourcelongitude;
            $restaurantPatch['restaurant_logo'] = $restaurant_logo;
            $saveRestaurant = $this->Restaurants->save($restaurantPatch);

            if($saveRestaurant) {
                $user = $this->Users->newEntity();
                $userDetails['id'] = (isset($users['id'])) ? $users['id'] : '';
                $userDetails['username'] = $this->request->data['contact_email'];
                $userDetails['user_id'] = $saveRestaurant->id;
                $userDetails['role_id'] = '2';
                $usersPatch = $this->Users->patchEntity($user, $userDetails);
                $saveuser = $this->Users->save($usersPatch);
                if($this->request->data['restaurantId'] != '') {
                    $this->Flash->success(__('Restaurant edit successful'));
                }else {
                    $this->Flash->success(__('Restaurant add successful '));
                }
                return $this->redirect(ADMIN_BASE_URL.'restaurants');
            }


        }

        $cuisinesList = $this->Cuisines->find('list', [
            'keyField' => 'id',
            'valueField' => 'cuisine_name',
            'conditions' => [
                'id IS NOT NULL',
                'status' => '1'
            ]
        ])->hydrate(false)->toArray();
        ///echo "<pre>";print_r($cuisinesList);die();

        $restaurantList = $this->Restaurants->find('all', [
            'conditions' => [
                'id' => $id,
                'delete_status' => 'N'
            ]
        ])->hydrate(false)->first();

        if($restaurantList['restaurant_cuisine'] != '') {
            $selectedCuisine = explode(',',$restaurantList['restaurant_cuisine']);
        }else {
            $selectedCuisine = '';
        }


        $timingAm = [
            '12:00 AM',
            '01:00 AM',
            '02:00 AM',
            '03:00 AM',
            '04:00 AM',
            '05:00 AM',
            '06:00 AM',
            '07:00 AM',
            '08:00 AM',
            '09:00 AM',
            '10:00 AM',
            '11:00 AM',
            '12:00 PM',
            '01:00 PM',
            '02:00 PM',
            '03:00 PM',
            '04:00 PM',
            '05:00 PM',
            '06:00 PM',
            '07:00 PM',
            '08:00 PM',
            '09:00 PM',
            '10:00 PM',
            '11:00 PM',
        ];

        $this->set(compact('timingAm','restaurantList','cuisinesList','selectedCuisine'));

    }

    public function checkEmail() {
        if($this->request->data['contact_email'] != '') {
            if($this->request->data['id'] != '') {
                $conditions = [
                    'id !=' => $this->request->data['id'],
                    'contact_email' => $this->request->data['contact_email'],
                    'delete_status' => 'N'
                ];
            }else {
                $conditions = [
                    'contact_email' => $this->request->data['contact_email'],
                    'delete_status' => 'N'
                ];

            }
            $userCount = $this->Restaurants->find('all', [
                'conditions' => $conditions
            ])->count();
            if($userCount == 0) {
                echo 'true';die();
            }else {
                echo 'false';exit;
            }
        }
        die();
    }

    public function ajaxaction() {

        if($this->request->data['action'] == 'getMap') {
            $service_area       = (!empty($this->request->data['service_area']) ? $this->request->data['service_area'] : '');
            $service_miles      = (!empty($this->request->data['service_miles']) ? $this->request->data['service_miles'] : 0);

            $mapDetails         = $this->Googlemap->getLatitudeLongitude($service_area);
            $map['address']     = $service_area;
            $map['latitude']    = $mapDetails['lat'];
            $map['longitude']   = $mapDetails['long'];
            $map['position']    = 1;
            $map['id']          = 1;
            $map['color']       = $this->Googlemap->getCircleColors('1');
            $map['miles']       = (!empty($service_miles))
                ? $this->Common->distanceCal($service_miles, 'Km')
                : 0;

            $map['map_id']      = 'map_canvas';
            $action             = 'showMap';
            // echo '/'.$panel.'/Serviceproviders/ajaxaction';
            $this->set(compact('action', 'showMap', 'map'));
        }

        if($this->request->getData('action') == 'restaurantStatus') {
            $category         = $this->Restaurants->newEntity();
            $category         = $this->Restaurants->patchEntity($category,$this->request->getData());
            $category->id     = $this->request->getData('id');
            $category->status = $this->request->getData('changestaus');
            $this->Restaurants->save($category);

            $this->set('id', $this->request->getData('id'));
            $this->set('action', 'restaurantStatus');
            $this->set('field', $this->request->getData('field'));
            $this->set('status', (($this->request->getData('changestaus') == 0) ? 'deactive' : 'active'));
        }

        if($this->request->getData('action') == 'restaurantMenuStatus') {
            $category         = $this->RestaurantMenus->newEntity();
            $category         = $this->RestaurantMenus->patchEntity($category,$this->request->getData());
            $category->id     = $this->request->getData('id');
            $category->status = $this->request->getData('changestaus');
            $this->RestaurantMenus->save($category);

            $this->set('id', $this->request->getData('id'));
            $this->set('action', 'restaurantMenuStatus');
            $this->set('field', $this->request->getData('field'));
            $this->set('status', (($this->request->getData('changestaus') == 0) ? 'deactive' : 'active'));
        }

        if($this->request->getData('action') == 'getCategory') {

            $conditions = [
                'restaurant_id' => $this->request->getData('id'),
                'delete_status' => 'N',
                'status' => '1'
            ];

            $categoryList = $this->Categories->find('list', [
                'keyField'   => 'id',
                'valueField' => 'catname',
                'conditions' => $conditions
            ])->hydrate(false)->toArray();

            $this->set('action', 'getCategory');
            $this->set('categoryList', $categoryList);

        }

        if($this->request->getData('action') == 'getAddons') {
            $this->loadModel('Mainaddons');
            $this->loadModel('Subaddons');
            $this->loadModel('MenuAddons');
            $addonsList = $this->Mainaddons->find('all', [
                'conditions' => [
                    'Mainaddons.restaurant_id' => $this->request->getData('restaurant_id'),
                    'Mainaddons.category_id' => $this->request->getData('category_id'),
                    'Mainaddons.status' => '1'
                ],
                'contain' => [
                    'Subaddons' => [
                        'conditions' => [
                            'Subaddons.restaurant_id' => $this->Auth->user('user_id')
                        ]
                    ]
                ]
            ])->hydrate(false)->toArray();

            $selectedAddons[] = '';

            if(isset($addonsList[0]['subaddons'])) {
                foreach($addonsList[0]['subaddons'] as $key => $value) {
                    $editAddonList = $this->MenuAddons->find('all', [
                        'conditions' => [
                            'menu_id' => $this->request->getData('menuId'),
                            'restaurant_id' => $this->request->getData('restaurant_id'),
                            'category_id' => $this->request->getData('category_id'),
                            'subaddons_id' => $value['id']
                        ]

                    ])->hydrate(false)->toArray();
                    if (!empty($editAddonList)) {
                        foreach ($editAddonList as $skey => $sval) {
                            $selectedAddons[] = $sval['subaddons_id'];
                        }
                    }
                    $addonsList[0]['subaddons'][$key]['menuAddons'] = $editAddonList;

                }
            }

            //echo "<pre>";print_r($addonsList);die();

            $action = $this->request->getData('action');
            $priceOption = $this->request->getData('price_option');
            $menuID = $this->request->getData('menuId');
            $menuLength = $this->request->data['menuLength'];
            $this->set(compact('addonsList','action','selectedAddons','priceOption','menuLength','editAddonList','menuID'));

        }
    }

    public function deleteRestaurant($id = null){
        if($this->request->is('ajax')){
            if($this->request->data['action'] == 'Restaurants'){

                $outlet         = $this->Restaurants->newEntity();
                $outlet         = $this->Restaurants->patchEntity($outlet,$this->request->data);
                $outlet->id            = $this->request->data['id'];
                $outlet->delete_status = 'Y';
                $this->Restaurants->save($outlet);
            }
            list($outletList) = $this->index('Restaurants');
            if($this->request->is('ajax')) {
                $action         = 'Restaurants';
                $this->set(compact('action', 'outletList'));
                $this->render('ajaxaction');
            }
        }
    }

    public function menu() {

        $menuDetails = $this->RestaurantMenus->find('all', [
            'conditions' => [
                'RestaurantMenus.delete_status' => 'N',
                'RestaurantMenus.id IS NOT NULL'
            ],
            'contain' => [
                'Categories' => [
                    'fields' => [
                        'Categories.catname'
                    ]
                ]
            ]
        ])->hydrate(false)->toArray();
        //echo "<pre>";print_r($menuDetails);die();

        $this->set(compact('menuDetails'));
    }

    public function menuaddedit($id = null) {

        if($this->request->is('post')) {
            echo "<pre>";print_r($this->request->getData());die();
        }

        $menuDetails = $this->RestaurantMenus->find('all', [
            'conditions' => [
                'RestaurantMenus.id' => $id
            ],
            'contain' => [
                'Restaurants' => [
                    'fields' => [
                        'Restaurants.restaurant_name'
                    ]
                ]
            ]
        ])->hydrate(false)->first();

        $restaurantList = $this->Restaurants->find('list',[
            'keyField'   => 'id',
            'valueField' => 'restaurant_name',
            'conditions' => [
                'delete_status' => 'N',
                'status' => '1'
            ]
        ])->hydrate(false)->toArray();

        if(!empty($menuDetails)) {
            $conditions = [
                'restaurant_id' => $menuDetails['restaurant_id'],
                'delete_status' => 'N',
                'status' => '1'
            ];
        }else {
            $conditions = [
                'delete_status' => 'N',
                'status' => '1'
            ];
        }

        $categoryList = $this->Categories->find('list', [
            'keyField'   => 'id',
            'valueField' => 'catname',
            'conditions' => $conditions
        ])->hydrate(false)->toArray();


        $this->set(compact('menuDetails','restaurantList','categoryList','id'));

    }

    public function checkMenu() {
        if($this->request->getData('id') != '') {
            $conditions = [
                'id !=' => $this->request->getData('id'),
                'restaurant_id' => $this->request->getData('restaurant_id'),
                'category_id' => $this->request->getData('category_id'),
                'menu_name' => $this->request->getData('menu_name'),
            ];
        }else {
            $conditions = [
                'restaurant_id' => $this->request->getData('restaurant_id'),
                'category_id' => $this->request->getData('category_id'),
                'menu_name' => $this->request->getData('menu_name'),
            ];
        }

        $menuCount = $this->RestaurantMenus->find('all', [
            'conditions' => $conditions
        ])->count();
        if($menuCount == 0){
            echo '0';die();

        }else{
            echo '1';die();
        }

    }

    public function menuadd() {

        if($this->request->is('post')) {
            //echo "<pre>";print_r($this->request->getData());die();
            //Menu Add Section
            $menuAdd = $this->RestaurantMenus->newEntity();
            $menuPatch = $this->RestaurantMenus->patchEntity($menuAdd,$this->request->getData('Menu'));
            $menuPatch['restaurant_id'] = $this->request->getData('restaurant_id');
            $menuPatch['category_id'] = $this->request->getData('category_id');
            $menuPatch['menu_type'] = $this->request->getData('menu_type');
            $menuPatch['price_option'] = $this->request->getData('price_option');
            $menuSave = $this->RestaurantMenus->save($menuPatch);

            if($this->request->getData('price_option') == "single") {
                $menuDetailsAdd = $this->MenuDetails->newEntity();
                $menuDetails['menu_id'] =  $menuSave->id;
                $menuDetails['sub_name'] =  ($this->request->getData('data')['MenuDetail'][0]['sub_name'] != '') ? $this->request->getData('data')['MenuDetail'][0]['sub_name'] : $this->request->getData('Menu')['menu_name'];
                $menuDetails['orginal_price'] = $this->request->getData('MenuDetail')['orginal_price'];
                $menuDetailsPatch = $this->MenuDetails->patchEntity($menuDetailsAdd,$menuDetails);
                $menuDetailSave = $this->MenuDetails->save($menuDetailsPatch);

            }else {
                $menuDetails = $this->request->getData('data')['MenuDetail'];
                foreach($menuDetails as $key => $value) {
                    $menuDetailsAdd = $this->MenuDetails->newEntity();
                    $menuDetailsPatch = $this->MenuDetails->patchEntity($menuDetailsAdd,$value);
                    $menuDetailsPatch['menu_id'] =  $menuSave->id;
                    $menuDetailSave = $this->MenuDetails->save($menuDetailsPatch);
                    $menuDetailArray[] = $menuDetailSave->id;
                    $menuDetailSave->id = '';
                }

            }

            if ($this->request->getData('Menu')['menuaddons'] == "Yes") {

                $menuAddons = $this->request->getData('data')['MenuAddon'];
                $category_id = $this->request->getData('category_id');
                $j = '';
                foreach ($menuAddons as $mkey => $mvalue) {
                    foreach ($mvalue['Subaddon'] as $skey => $svalue) {
                        if (!empty($svalue) && isset($svalue['subaddons_id'])) {
                            if ($this->request->getData('price_option') == "single") {
                                $menuAddonsAdd = $this->MenuAddons->newEntity();

                                $menuAddonDetails['menu_id'] = $menuSave->id;
                                $menuAddonDetails['restaurant_id'] = $this->request->getData('restaurant_id');
                                $menuAddonDetails['category_id'] = $category_id;
                                $menuAddonDetails['mainaddons_id'] = $mvalue['mainaddons_id'];
                                $menuAddonDetails['price_option'] = $this->request->getData('price_option');
                                $menuAddonDetails['subaddons_id'] = $svalue['subaddons_id'];
                                $menuAddonDetails['menudetails_id'] = $menuDetailSave->id;
                                $menuAddonDetails['subaddons_price'] = ($svalue['subaddons_price'] != '') ? $svalue['subaddons_price'] : '';

                                $menuAddonsPatch = $this->MenuAddons->patchEntity($menuAddonsAdd, $menuAddonDetails);
                                $menuAddonsSave = $this->MenuAddons->save($menuAddonsPatch);
                                //$menuAddonsSave->id = '';
                            } else {

                                $i = ($j == 0) ? count($menuDetailArray) : $j;
                                foreach ($svalue['subaddons_price'] as $subPriceKey => $subPriceVal) {
                                    $menuAddonsAdd = $this->MenuAddons->newEntity();
                                    $k = count($menuDetailArray) - $i;
                                    $j = $i - 1;
                                    $i = ($j == 0) ? count($menuDetailArray) : $j;

                                    $subPrice['menu_id'] = $menuSave->id;
                                    $subPrice['restaurant_id'] = $this->request->getData('restaurant_id');
                                    $subPrice['category_id'] = $category_id;
                                    $subPrice['mainaddons_id'] = $mvalue['mainaddons_id'];
                                    $subPrice['subaddons_id'] = $svalue['subaddons_id'];
                                    $subPrice['price_option'] = $this->request->getData('price_option');
                                    $subPrice['menudetails_id'] = $menuDetailArray[$k];
                                    $subPrice['subaddons_price'] = ($subPriceVal != '') ? $subPriceVal : '0.00';

                                    $menuAddonsPatch = $this->MenuAddons->patchEntity($menuAddonsAdd, $subPrice);
                                    $menuAddonsSave = $this->MenuAddons->save($menuAddonsPatch);
                                    //$menuAddonsSave->id = '';
                                }

                            }
                        }
                    }
                }
            }

            //Menu Image Upload Section
            $invalid = '0';
            if(isset($this->request->getData('menuImage')['name']) && !empty($this->request->getData('menuImage')['name'])
            ){
                $menuAdd = $this->RestaurantMenus->newEntity();


                $valid     = getimagesize($_FILES['menuImage']['tmp_name']);
                $filePart  = pathinfo($this->request->getData('menuImage')['name']);
                $logo      = ['jpg','jpeg','gif','png'];

                if( $this->request->getData('menuImage')['error'] == 0 &&
                    ($this->request->getData('menuImage')['size'] > 0 ) &&
                    in_array(strtolower($filePart['extension']),$logo) && !empty($valid) ) {

                    //Image Upload Start
                    $file = MENU_LOGO_PATH.'/'. $menuSave->id;
                    if (!file_exists($file))
                        mkdir($file, 0777, true);

                    $img_path       = $file;
                    $image_detail   = $this->Common->UploadFile($this->request->getData('menuImage'), $img_path);
                    $menuImage['menu_image']  = $image_detail['refName'];
                    $menuImage['id']  = $menuSave->id;

                    $menuPatch = $this->RestaurantMenus->patchEntity($menuAdd,$menuImage);
                    $menuSave = $this->RestaurantMenus->save($menuPatch);
                }
            }
            $this->Flash->success(__('Menu Added successful'));
            return $this->redirect(ADMIN_BASE_URL.'restaurants/menu');

        }

        $restaurantList = $this->Restaurants->find('list',[
            'keyField'   => 'id',
            'valueField' => 'restaurant_name',
            'conditions' => [
                'delete_status' => 'N',
                'status' => '1'
            ]
        ])->hydrate(false)->toArray();

        $conditions = [
            'delete_status' => 'N',
            'status' => '1'
        ];

        $categoryList = $this->Categories->find('list', [
            'keyField'   => 'id',
            'valueField' => 'catname',
            'conditions' => $conditions
        ])->hydrate(false)->toArray();


        $this->set(compact('restaurantList','categoryList'));

    }

    public function menuedit($id = null) {
        $this->loadModel('Mainaddons');
        $this->loadModel('Subaddons');

        if($this->request->is('post')) {
            //echo "<pre>";print_r($this->request->getData());die();
            //Menu Add Section
            $menuAdd = $this->RestaurantMenus->newEntity();
            $menuPatch = $this->RestaurantMenus->patchEntity($menuAdd,$this->request->getData('Menu'));
            $menuPatch['restaurant_id'] = $this->request->getData('restaurant_id');
            $menuPatch['category_id'] = $this->request->getData('category_id');
            $menuPatch['menu_type'] = $this->request->getData('menu_type');
            $menuPatch['price_option'] = $this->request->getData('price_option');
            $menuPatch['popular_dish'] = $this->request->getData('popular_dish');
            $menuPatch['spicy_dish'] = $this->request->getData('spicy_dish');
            $menuPatch['id'] = $this->request->getData('editedId');
            $menuSave = $this->RestaurantMenus->save($menuPatch);

            //Delete Menu Detail
            $this->MenuDetails->deleteAll([
                'menu_id' => $this->request->getData('editedId')
            ]);
            if($this->request->getData('price_option') == "single") {

                $menuDetailsAdd = $this->MenuDetails->newEntity();
                $menuDetails['menu_id'] =  $this->request->getData('editedId');
                $menuDetails['sub_name'] =  ($this->request->getData('data')['MenuDetail'][0]['sub_name'] != '') ? $this->request->getData('data')['MenuDetail'][0]['sub_name'] : $this->request->getData('Menu')['menu_name'];
                $menuDetails['orginal_price'] = $this->request->getData('MenuDetail')['orginal_price'];
                $menuDetailsPatch = $this->MenuDetails->patchEntity($menuDetailsAdd,$menuDetails);
                $menuDetailSave = $this->MenuDetails->save($menuDetailsPatch);

            }else {
                $menuDetails = $this->request->getData('data')['MenuDetail'];
                foreach($menuDetails as $key => $value) {
                    $menuDetailsAdd = $this->MenuDetails->newEntity();
                    $menuDetailsPatch = $this->MenuDetails->patchEntity($menuDetailsAdd,$value);
                    $menuDetailsPatch['menu_id'] =  $this->request->getData('editedId');
                    $menuDetailSave = $this->MenuDetails->save($menuDetailsPatch);
                    $menuDetailArray[] = $menuDetailSave->id;
                    $menuDetailSave->id = '';
                }

            }

            if ($this->request->getData('menuaddons') == "Yes") {
                //Delete MenuAddons Detail
                $this->MenuAddons->deleteAll([
                    'menu_id' => $this->request->getData('editedId')
                ]);

                $menuAddons = $this->request->getData('data')['MenuAddon'];
                $category_id = $this->request->getData('category_id');
                $j = '';
                foreach ($menuAddons as $mkey => $mvalue) {
                    foreach ($mvalue['Subaddon'] as $skey => $svalue) {
                        if (!empty($svalue) && isset($svalue['subaddons_id'])) {
                            if ($this->request->getData('price_option') == "single") {
                                $menuAddonsAdd = $this->MenuAddons->newEntity();

                                $menuAddonDetails['menu_id'] = $this->request->getData('editedId');
                                $menuAddonDetails['restaurant_id'] = $this->request->getData('restaurant_id');
                                $menuAddonDetails['category_id'] = $category_id;
                                $menuAddonDetails['mainaddons_id'] = $mvalue['mainaddons_id'];
                                $menuAddonDetails['price_option'] = $this->request->getData('price_option');
                                $menuAddonDetails['menudetails_id'] = $menuDetailSave->id;
                                $menuAddonDetails['subaddons_id'] = $svalue['subaddons_id'];
                                $menuAddonDetails['subaddons_price'] = ($svalue['subaddons_price'][0] != '') ? $svalue['subaddons_price'][0] : '0.00';

                                $menuAddonsPatch = $this->MenuAddons->patchEntity($menuAddonsAdd, $menuAddonDetails);
                                $menuAddonsSave = $this->MenuAddons->save($menuAddonsPatch);
                                //$menuAddonsSave->id = '';
                            } else {

                                $i = ($j == 0) ? count($menuDetailArray) : $j;
                                foreach ($svalue['subaddons_price'] as $subPriceKey => $subPriceVal) {
                                    $menuAddonsAdd = $this->MenuAddons->newEntity();
                                    $k = count($menuDetailArray) - $i;
                                    $j = $i - 1;
                                    $i = ($j == 0) ? count($menuDetailArray) : $j;

                                    $subPrice['menu_id'] = $this->request->getData('editedId');
                                    $subPrice['restaurant_id'] = $this->request->getData('restaurant_id');
                                    $subPrice['category_id'] = $category_id;
                                    $subPrice['mainaddons_id'] = $mvalue['mainaddons_id'];
                                    $subPrice['subaddons_id'] = $svalue['subaddons_id'];
                                    $subPrice['price_option'] = $this->request->getData('price_option');
                                    $subPrice['menudetails_id'] = $menuDetailArray[$k];
                                    $subPrice['subaddons_price'] = ($subPriceVal != '') ? $subPriceVal : '0.00';

                                    $menuAddonsPatch = $this->MenuAddons->patchEntity($menuAddonsAdd, $subPrice);
                                    $menuAddonsSave = $this->MenuAddons->save($menuAddonsPatch);
                                    //$menuAddonsSave->id = '';
                                }

                            }
                        }
                    }
                }
            }

            //Menu Image Upload Section
            $invalid = '0';
            if(isset($this->request->getData('menuImage')['name']) && !empty($this->request->getData('menuImage')['name'])
            ){
                $menuAdd = $this->RestaurantMenus->newEntity();


                $valid     = getimagesize($_FILES['menuImage']['tmp_name']);
                $filePart  = pathinfo($this->request->getData('menuImage')['name']);
                $logo      = ['jpg','jpeg','gif','png'];

                if( $this->request->getData('menuImage')['error'] == 0 &&
                    ($this->request->getData('menuImage')['size'] > 0 ) &&
                    in_array(strtolower($filePart['extension']),$logo) && !empty($valid) ) {

                    //Image Upload Start
                    $file = MENU_LOGO_PATH.'/'. $this->request->getData('editedId');
                    if (!file_exists($file))
                        mkdir($file, 0777, true);

                    $img_path       = $file;
                    $image_detail   = $this->Common->UploadFile($this->request->getData('menuImage'), $img_path);
                    $menuImage['menu_image']  = $image_detail['refName'];
                    $menuImage['id']  = $this->request->getData('editedId');

                    $menuPatch = $this->RestaurantMenus->patchEntity($menuAdd,$menuImage);
                    $menuSave = $this->RestaurantMenus->save($menuPatch);
                }
            }
            $this->Flash->success(__('Menu Added successful'));
            return $this->redirect(ADMIN_BASE_URL.'restaurants/menu');

        }

        $menuDetails = $this->RestaurantMenus->find('all', [
            'conditions' => [
                'RestaurantMenus.id' => $id
            ],
            'contain' => [
                'Restaurants' => [
                    'fields' => [
                        'Restaurants.restaurant_name'
                    ]
                ],
                'MenuDetails',
                'MenuAddons',
            ]
        ])->hydrate(false)->first();
        //pr($menuDetails);die();

        foreach($menuDetails['menu_addons'] as $key => $value) {
            $mainAddons = $this->Mainaddons->find('all', [
                'fields' => [
                    'mainaddons_name'
                ],
                'conditions' => [
                    'id' => $value['mainaddons_id']
                ]
            ])->hydrate(false)->first();
            $menuDetails['menu_addons'][$key]['mainAddons'] = $mainAddons['mainaddons_name'];

            $subAddons = $this->Subaddons->find('all', [
                'fields' => [
                    'subaddons_name'
                ],
                'conditions' => [
                    'id' => $value['subaddons_id']
                ]
            ])->hydrate(false)->first();
            $menuDetails['menu_addons'][$key]['subAddons'] = $subAddons['subaddons_name'];
        }

        $restaurantList = $this->Restaurants->find('list',[
            'keyField'   => 'id',
            'valueField' => 'restaurant_name',
            'conditions' => [
                'delete_status' => 'N',
                'status' => '1'
            ]
        ])->hydrate(false)->toArray();

        if(!empty($menuDetails)) {
            $conditions = [
                'restaurant_id' => $menuDetails['restaurant_id'],
                'delete_status' => 'N',
                'status' => '1'
            ];
        }else {
            $conditions = [
                'delete_status' => 'N',
                'status' => '1'
            ];
        }

        $categoryList = $this->Categories->find('list', [
            'keyField'   => 'id',
            'valueField' => 'catname',
            'conditions' => $conditions
        ])->hydrate(false)->toArray();




        $this->set(compact('restaurantList','categoryList','menuDetails','id'));

    }

    public function getSubAddonsMultiplePrice($productId, $subaddonId, $priceOption) {
        $addonPriceList = $this->MenuAddons->find('all', [
            'conditions' => [
                'product_id' => $productId,
                'subaddons_id' => $subaddonId,
                'price_option' => $priceOption,
                'NOT' => [
                    'productdetails_id' => 0
                ]
            ]

        ])->hydrate(false)->toArray();

        return $addonPriceList;
        die();
    }

    public function seoUrl($string)
    {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $string);

        // trim
        $text = trim($text, '-');

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if(strlen($text) > 70) {
            $text = substr($text, 0, 70);
        }

        if (empty($text))
        {
            //return 'n-a';
            return time();
        }

        return $text;
    }

}