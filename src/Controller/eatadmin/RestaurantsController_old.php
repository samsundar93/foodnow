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

        if($this->request->is('post')) {

            if($this->request->getData('restaurantId') != '') {
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

            $prepAddr = str_replace(' ','+',$this->request->getData('contact_address'));


            $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.
                '&sensor=false');

            $output= json_decode($geocode);

            $sourcelatitude = $output->results[0]->geometry->location->lat;
            $sourcelongitude = $output->results[0]->geometry->location->lng;

            //Restaurant Logo

            if(isset($this->request->getData('restaurantlogo')['name']) && !empty($this->request->getData('restaurantlogo')['name'])
            ){
                $valid     = getimagesize($_FILES['restaurantlogo']['tmp_name']);
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

                }
            }
            else
                $restaurant_logo      = $restaurantDetails['restaurant_logo'];

            $restaurants = $this->Restaurants->newEntity();
            $restaurantPatch = $this->Restaurants->patchEntity($restaurants, $this->request->getData());
            $restaurantPatch['latitude'] = $sourcelatitude;
            $restaurantPatch['longitude'] = $sourcelongitude;
            $restaurantPatch['restaurant_logo'] = $restaurant_logo;
            $saveRestaurant = $this->Restaurants->save($restaurantPatch);

            if($saveRestaurant) {
                $user = $this->Users->newEntity();
                $userDetails['id'] = (isset($users['id'])) ? $users['id'] : '';
                $userDetails['username'] = $this->request->getData('contact_email');
                $userDetails['user_id'] = $saveRestaurant->id;
                $userDetails['role_id'] = '2';
                $usersPatch = $this->Users->patchEntity($user, $userDetails);
                $saveuser = $this->Users->save($usersPatch);
                if($this->request->data['restaurantId'] != '') {
                    $this->Flash->success(__('Restaurant edit successful'));
                }else {
                    $this->Flash->success(__('Restaurant add successful '));
                }
                return $this->redirect(BASE_URL.'restaurants');
            }
        }
        $restaurantList = $this->Restaurants->find('all', [
            'conditions' => [
                'id' => $id,
                'delete_status' => 'N'
            ]
        ])->hydrate(false)->first();


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
        $this->set(compact('timingAm','restaurantList'));
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

        if($this->request->data['action'] == 'restaurantStatus') {
            $category         = $this->Restaurants->newEntity();
            $category         = $this->Restaurants->patchEntity($category,$this->request->data);
            $category->id     = $this->request->data['id'];
            $category->status = $this->request->data['changestaus'];
            $this->Restaurants->save($category);

            $this->set('id', $this->request->data['id']);
            $this->set('action', 'restaurantStatus');
            $this->set('field', $this->request->data['field']);
            $this->set('status', (($this->request->data['changestaus'] == 0) ? 'deactive' : 'active'));
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

        if($this->request->getData('action') == 'restaurantMenuStatus') {

            $restaurantMenu   = $this->RestaurantMenus->newEntity();
            $restaurantMenu         = $this->RestaurantMenus->patchEntity($restaurantMenu,$this->request->getData());
            $restaurantMenu->id     = $this->request->getData('id');
            $restaurantMenu->status = $this->request->getData('changestaus');
            $this->RestaurantMenus->save($restaurantMenu);

            $this->set('id', $this->request->getData('id'));
            $this->set('action', 'restaurantMenuStatus');
            $this->set('field', $this->request->getData('field'));
            $this->set('status', (($this->request->getData('changestaus') == 0) ? 'deactive' : 'active'));

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

    public function deleteRestaurantMenu($id = null){
        if($this->request->is('ajax')){
            if($this->request->getData('action') == 'RestaurantMenu'){

                $outlet         = $this->RestaurantMenus->newEntity();
                $outlet         = $this->RestaurantMenus->patchEntity($outlet,$this->request->getData());
                $outlet->id            = $this->request->getData('id');
                $outlet->delete_status = 'Y';
                $this->RestaurantMenus->save($outlet);
            }
            list($menuDetails) = $this->menu('RestaurantMenu');
            if($this->request->is('ajax')) {
                $action         = 'RestaurantMenu';
                $this->set(compact('action', 'menuDetails'));
                $this->render('ajaxaction');
            }
        }
    }

    public function menu($process = null) {

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

        if($process == 'RestaurantMenu') {
            $value = array($menuDetails);
            return $value;
        }
    }

    public function menuaddedit($id = null) {

        if($this->request->is('post')) {

            //echo "<pre>";print_r($this->request->getData());die();

            $restaurants = $this->RestaurantMenus->newEntity();
            $restaurants = $this->RestaurantMenus->patchEntity($restaurants,$this->request->getData());
            $restaurants->id = $id;

            if($id != '') {
                $restaurantMenuEdit  = $this->RestaurantMenus->get($id);
            }else {
                $restaurantMenuEdit  = '';
            }



            //Site Logo ------------------------------------------------------------
            $invalid = '0';
            if(isset($this->request->getData('menuImage')['name']) && !empty($this->request->getData('menuImage')['name'])
            ){
                $valid     = getimagesize($_FILES['menuImage']['tmp_name']);
                $filePart  = pathinfo($this->request->getData('menuImage')['name']);
                $logo      = ['jpg','jpeg','gif','png'];

                if( $this->request->getData('menuImage')['error'] == 0 &&
                    ($this->request->getData('menuImage')['size'] > 0 ) &&
                    in_array(strtolower($filePart['extension']),$logo) && !empty($valid) ) {

                    $img_path       = RESTAURANTMENU_IMAGE_PATH;
                    if(isset($restaurantMenuEdit['menu_image']) && !empty($restaurantMenuEdit['menu_image'])
                        && file_exists(RESTAURANTMENU_IMAGE_PATH.'/'.$restaurantMenuEdit['menu_image']))
                        $this->Common->unlinkFile($restaurantMenuEdit['menu_image'], $img_path);
                    $image_detail   = $this->Common->UploadFile($this->request->getData('menuImage'), $img_path);
                    $restaurants->menu_image  = $image_detail['refName'];

                } else{

                    $invalid = '1';
                    $this->set(compact('id'));
                    $this->Flash->error(_("Menu Image should be valid image type"));
                }

            }
            else
                $restaurants->menu_image      = $restaurantMenuEdit['menu_image'];



            $restaurantMenu = $this->RestaurantMenus->save($restaurants);
            if($restaurantMenu) {
                if($id == '') {
                    $this->Flash->success(_("Menu added successful"));
                }else {
                    $this->Flash->success(_("Menu update successful"));
                }
                return $this->redirect(BASE_URL.'restaurants/menu');

            }
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
}