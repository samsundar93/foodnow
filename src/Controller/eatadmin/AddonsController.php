<?php
/**
 * Created by PhpStorm.
 * User: Sundar
 * Date: 9/29/2017
 * Time: 10:44 PM
 */
namespace App\Controller\Eatadmin;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\Table;

class AddonsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('backend');

        $this->loadModel('Mainaddons');
        $this->loadModel('Subaddons');
        $this->loadModel('Categories');
        $this->loadModel('Restaurants');
    }

    public function index($process = null) {

        $addonsList = $this->Mainaddons->find('all', [
            'conditions' => [
                'Mainaddons.id IS NOT NULL'
            ],
            'contain' => [
                'Restaurants' => [
                    'fields' => [
                        'restaurant_name'
                    ]
                ],
                'Categories' => [
                    'fields' => [
                        'catname'
                    ]
                ]
            ]
        ])->hydrate(false)->toArray();

        $this->set(compact('addonsList'));

        if($process == 'Addons' ){
            $value = array($addonsList);
            return $value;
        }
    }

    public function addedit($id = null) {

        if($this->request->is('post')) {

            $addons = $this->Mainaddons->newEntity();
            $addonsPatch = $this->Mainaddons->patchEntity($addons,$this->request->getData());
            if($this->request->getData('editedId') != '') {
                $addonsPatch->id = $this->request->getData('editedId');
            }
            $addonsSave = $this->Mainaddons->save($addonsPatch);
            if($addonsSave) {
                $this->Subaddons->deleteAll([
                    'restaurant_id' => $this->request->getData('restaurant_id'),
                    'mainaddons_id' => $addonsSave->id,
                ]);

                foreach($this->request->getData('Subaddon') as $key => $value) {
                    $addons = $this->Subaddons->newEntity();
                    $addonsPatch = $this->Subaddons->patchEntity($addons,$value);
                    $addonsPatch->mainaddons_id = $addonsSave->id;
                    $addonsPatch->restaurant_id = $this->request->getData('restaurant_id');
                    $addonsPatch->category_id = $this->request->getData('category_id');
                    $subaddonsSave = $this->Subaddons->save($addonsPatch);
                }
            }
            if($subaddonsSave) {
                if($id != '') {
                    $this->Flash->success(__('Addons update successfull'));
                }else {
                    $this->Flash->success(__('Addons added successfull'));
                }
                return $this->redirect(ADMIN_BASE_URL.'addons');

            }
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

        $addonsList = $this->Mainaddons->find('all', [
            'conditions' => [
                'Mainaddons.id' => $id
            ],
            'contain' => [
                'Restaurants' => [
                    'fields'=> [
                        'Restaurants.restaurant_name'
                    ]
                ],
                'Subaddons'
            ]
        ])->hydrate(false)->first();

        $this->set(compact('restaurantList','categoryList','addonsList','id'));
    }

    public function ajaxaction() {

        if($this->request->is('ajax')){
            if($this->request->data['action'] == 'addonsstatuschange'){

                $category         = $this->Mainaddons->newEntity();
                $category         = $this->Mainaddons->patchEntity($category,$this->request->getData());
                $category->id     = $this->request->data['id'];
                $category->status = $this->request->data['changestaus'];
                $this->Mainaddons->save($category);

                $this->set('id', $this->request->data['id']);
                $this->set('action', 'addonsstatuschange');
                $this->set('field', $this->request->data['field']);
                $this->set('status', (($this->request->data['changestaus'] == 0) ? 'deactive' : 'active'));
            }
        }
    }

    public function checkAddons() {

        if($this->request->getData('id') != '') {
            $conditions = [
                'id != ' => $this->request->getData('id'),
                'category_id' => $this->request->getData('category_id'),
                'restaurant_id' => $this->request->getData('restaurant_id'),
                'mainaddons_name' => $this->request->getData('mainaddons_name'),
            ];
        }else {
            $conditions = [
                'category_id' => $this->request->getData('category_id'),
                'restaurant_id' => $this->request->getData('restaurant_id'),
                'mainaddons_name' => $this->request->getData('mainaddons_name'),
            ];

        }

        $addonsCount = $this->Mainaddons->find('all', [
            'conditions' => $conditions
        ])->count();

        if($addonsCount == 0) {
            echo '0';die();
        }else {
            echo '1';die();
        }
    }

    public function deleteaddons($id = null){

        if($this->request->is('ajax')){
            if($this->request->data['action'] == 'Addons' && $this->request->data['id'] != ''){

                $id       = $this->request->data['id'];

                $entity = $this->Mainaddons->get($id);
                $result = $this->Mainaddons->delete($entity);

                list($addonsList) = $this->index('Addons');
                if($this->request->is('ajax')) {
                    $action         = 'Addons';
                    $this->set(compact('action', 'addonsList'));
                    $this->render('ajaxaction');
                }
            }
        }
    }
}