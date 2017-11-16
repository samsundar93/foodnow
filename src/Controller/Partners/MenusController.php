<?php
/**
 * Created by PhpStorm.
 * User: Sundar
 * Date: 11/8/2017
 * Time: 9:46 PM
 */
namespace App\Controller\Partners;
use Cake\Event\Event;
use App\Controller\AppController;


class MenusController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('partner');

        $this->loadModel('Mainaddons');
        $this->loadModel('Subaddons');
        $this->loadModel('Categories');
        $this->loadModel('Restaurants');
        $this->loadModel('RestaurantMenus');
        $this->loadModel('Users');
    }

    public function index() {

        $menuDetails = $this->RestaurantMenus->find('all', [
            'conditions' => [
                'RestaurantMenus.delete_status' => 'N',
                'RestaurantMenus.restaurant_id' => $this->Auth->user('user_id')
            ],
            'contain' => [
                'Categories' => [
                    'fields' => [
                        'Categories.catname'
                    ]
                ]
            ]
        ])->hydrate(false)->toArray();

        $this->set(compact('menuDetails'));
    }

    public function add() {

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

        $conditions = [
            'delete_status' => 'N',
            'status' => '1',
            'restaurant_id' => $this->Auth->user('user_id')
        ];

        $categoryList = $this->Categories->find('list', [
            'keyField'   => 'id',
            'valueField' => 'catname',
            'conditions' => $conditions
        ])->hydrate(false)->toArray();

        $this->set(compact('categoryList'));

    }

    public function ajaxaction() {

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
    }
}