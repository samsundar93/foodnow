<?php
/**
 * Created by PhpStorm.
 * User: Sundar
 * Date: 10/15/2017
 * Time: 8:36 PM
 */
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\Table;
use Cake\Utility\Hash;

class RestaurantsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('default');
        $this->loadModel('Cuisines');
        $this->loadModel('Sitesettings');
    }

    public function beforeFilter(Event $event)
    {
        // Before Login , these are the function we can access
        $this->Auth->allow([
            'index'
        ]);
    }

    public function index() {
        $this->loadComponent('Common');
        if($this->request->session()->read('searchLocation') != '') {

            $prepAddr = str_replace(' ','+',$this->request->session()->read('searchLocation'));

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
                $restaurantList = $this->Restaurants->find('all', [
                    'conditions' => [
                        'id IS NOT NULL',
                        'status' => '1',
                        'delete_status' => 'N'
                    ]
                ])->hydrate(false)->toArray();


                $currentTime = strtotime(date('h:i A'));
                $currentDay = strtolower(date('l'));

                $final = array();
                $distance = array();
                $result = array();
                $allCuisinesList = array();

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
                                    //$allCuisinesLists['cuisine'][] = $cuisines['cuisine_name'];
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
                            $value['currentStatus'] = 'Open';
                            $final[] = $value;
                        }
                    }
                }
                if(!empty($final)) {
                    $result = Hash::sort($final, '{n}.to_distance', 'asc');
                }

                $siteSettings = $this->Sitesettings->find('all', [
                    'conditions' => [
                        'id' => '1'
                    ]
                ])->hydrate(false)->first();
                $this->set(compact('result','allCuisinesLists','siteSettings'));

            }

        }else {
            return $this->redirect(BASE_URL);
        }
    }
}