<?php
/**
 * Created by PhpStorm.
 * User: roamadmin
 * Date: 03-11-2017
 * Time: 15:33
 */
namespace App\Controller\Partners;
use Cake\Event\Event;
use App\Controller\AppController;


class RestaurantsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('partner');

        $this->loadModel('Mainaddons');
        $this->loadModel('Subaddons');
        $this->loadModel('Categories');
        $this->loadModel('Restaurants');
        $this->loadModel('Users');


    }

    public function index() {

        if($this->request->is('post')) {


            $this->loadComponent('Common');


            $restaurantDetails = $this->Restaurants->find('all', [
                'conditions' => [
                    'id' => $this->Auth->user('user_id')
                ]
            ])->hydrate(false)->first();


            $users = $this->Users->find('all', [
                'conditions' =>[
                    'user_id' => $this->Auth->user('user_id')
                ]
            ])->hydrate(false)->first();


            $conditions = [
                'id !=' => $this->Auth->user('user_id'),
                'contact_email' => $this->request->getData('contact_email')
            ];

            $userCount = $this->Restaurants->find('all', [
                'conditions' => $conditions
            ])->count();

            if(!empty($this->request->getData('restaurant_cuisine'))) {
                $restaurantCuisine = implode(',',$this->request->getData('restaurant_cuisine'));
            }else {
                $restaurantCuisine = '';
            }

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
            $restaurantPatch->restaurant_cuisine = $restaurantCuisine;
            $restaurantPatch['latitude'] = $sourcelatitude;
            $restaurantPatch['longitude'] = $sourcelongitude;
            $restaurantPatch['restaurant_logo'] = $restaurant_logo;
            $restaurantPatch['id'] = $this->Auth->user('user_id');

            //Monday Status
            $restaurantPatch['monday_status'] = ($this->request->getData('monday_status') != '') ? $this->request->getData('monday_status'): '';

            //Monday Status
            $restaurantPatch['tuesday_status'] = ($this->request->getData('tuesday_status') != '') ? $this->request->getData('tuesday_status'): '';
            //Monday Status
            $restaurantPatch['wednesday_status'] = ($this->request->getData('wednesday_status') != '') ? $this->request->getData('wednesday_status'): '';
            //Monday Status
            $restaurantPatch['thursday_status'] = ($this->request->getData('thursday_status') != '') ? $this->request->getData('thursday_status'): '';
            //Monday Status
            $restaurantPatch['friday_status'] = ($this->request->getData('friday_status') != '') ? $this->request->getData('friday_status'): '';
            //Monday Status
            $restaurantPatch['saturday_status'] = ($this->request->getData('saturday_status') != '') ? $this->request->getData('saturday_status'): '';
            //Monday Status
            $restaurantPatch['sunday_status'] = ($this->request->getData('sunday_status') != '') ? $this->request->getData('sunday_status'): '';

            $saveRestaurant = $this->Restaurants->save($restaurantPatch);

            if($saveRestaurant) {
                $user = $this->Users->newEntity();
                $userDetails['id'] = (isset($users['id'])) ? $users['id'] : '';
                $userDetails['username'] = $this->request->getData('contact_email');
                $usersPatch = $this->Users->patchEntity($user, $userDetails);
                $saveuser = $this->Users->save($usersPatch);

                $this->Flash->success(__('Restaurant edit successful'));
                return $this->redirect(PARTNER_BASE_URL.'restaurants');
            }

        }

        $this->loadModel('Cuisines');

        $timelist = ['12:00 AM'=>'12:00 AM','01:00 AM'=>'01:00 AM','02:00 AM'=>'02:00 AM','03:00 AM'=>'3:000 AM','04:00 AM'=>'04:00 AM','05:00 AM'=>'05:00 AM','06:00 AM'=>'06:00 AM','07:00 AM'=>'07:00 AM','08:00 AM'=>'08:00 AM','9:00 AM'=>'09:00 AM','10:00 AM'=>'10:00 AM','11:00 AM'=>'11:00 AM','12:00 PM'=>'12:00 PM','01:00 PM'=>'01:00 PM','02:00 PM'=>'02:00 PM','03:00 PM'=>'03:00 PM','04:00 PM'=>'04:00 PM','05:00 PM'=>'05:00 PM','06:00 PM'=>'06:00 PM','07:00 PM'=>'07:00 PM','08:00 PM'=>'08:00 PM','09:00 PM'=>'09:00 PM','10:00 PM'=>'10:00 PM','11:00 PM'=>'11:00 PM'];

        $cuisinesList = $this->Cuisines->find('list', [
            'keyField' => 'id',
            'valueField' => 'cuisine_name',
            'conditions' => [
                'id IS NOT NULL',
                'status' => '1'
            ]
        ])->hydrate(false)->toArray();
        //pr($cuisinesList);die();

        $restaurantDetails = $this->Restaurants->find('all', [
            'conditions' => [
                'id' => $this->Auth->user('user_id')
            ]

        ])->hydrate(false)->first();

        $selectedCuisines = explode(',',$restaurantDetails['restaurant_cuisine']);

        $this->set(compact('timelist','cuisinesList','restaurantDetails','selectedCuisines'));

    }

    public function ajaxaction() {

        if($this->request->data['action'] == 'getMap') {

            $this->loadComponent('Googlemap');
            $this->loadComponent('Common');

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
    }

    public function checkEmail() {
        if($this->request->data['contact_email'] != '') {

            $conditions = [
                'id !=' => $this->Auth->user('user_id'),
                'contact_email' => $this->request->data['contact_email'],
                'delete_status' => 'N'
            ];

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


}