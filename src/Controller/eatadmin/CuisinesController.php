<?php
/**
 * Created by PhpStorm.
 * User: Sundar
 * Date: 9/29/2017
 * Time: 10:46 PM
 */
namespace App\Controller\Eatadmin;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\Table;
use Excel\Controller\ExcelReaderController;

class CuisinesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('backend');

        $this->loadModel('Users');
        $this->loadModel('Sitesettings');
        $this->loadModel('Timezones');
    }

    public function index($process = null) {

        $this->loadModel('Cuisines');
        $cuisineList = $this->Cuisines->find('all', [
            'conditions' => [
                'id IS NOT NULL'
            ]
        ])->hydrate(false)->toArray();

        $this->set(compact('cuisineList'));

        if($process == 'Cuisines') {
            $value = array($cuisineList);
            return $value;
        }

    }

    public function addedit($id = null) {
        $this->loadModel('Cuisines');

        if($this->request->is('post')) {

            if($this->request->data['editedId'] != '') {
                $this->request->data['id'] = $this->request->data['editedId'];
            }

            $cuisine = $this->Cuisines->newEntity();
            $cuisinePatch = $this->Cuisines->patchEntity($cuisine,$this->request->data);
            $saveCuisine = $this->Cuisines->save($cuisinePatch);
            if($saveCuisine) {
                if($this->request->data['editedId'] != '') {
                    $this->Flash->success(__('Cuisine edited successful'));
                }else {
                    $this->Flash->success(__('Cuisine added successful'));
                }
                return $this->redirect(ADMIN_BASE_URL.'cuisines');
            }
        }

        $cuisineList = $this->Cuisines->find('all', [
            'conditions' => [
                'id' => $id
            ]
        ])->hydrate(false)->first();

        $this->set(compact('cuisineList','id'));
    }

    public function ajaxaction(){

        $this->loadModel('Cuisines');

        if($this->request->is('ajax')){
            if($this->request->data['action'] == 'cuisinestatuschange'){

                $category         = $this->Cuisines->newEntity();
                $category         = $this->Cuisines->patchEntity($category,$this->request->data);
                $category->id     = $this->request->data['id'];
                $category->status = $this->request->data['changestaus'];
                $this->Cuisines->save($category);

                $this->set('id', $this->request->data['id']);
                $this->set('action', 'cuisinestatuschange');
                $this->set('field', $this->request->data['field']);
                $this->set('status', (($this->request->data['changestaus'] == 0) ? 'deactive' : 'active'));
            }
        }
    }

    public function checkCuisine() {
        $this->loadModel('Cuisines');
        if($this->request->data['id'] != '') {
            $conditions = [
                'id !=' => $this->request->data['id'],
                'cuisine_name' => $this->request->data['cuisine_name']
            ];

        }else {
            $conditions = [
                'cuisine_name' => $this->request->data['cuisine_name']
            ];
        }

        $cuisineCount = $this->Cuisines->find('all', [
            'conditions' => $conditions
        ])->count();
        if($cuisineCount == 0) {
            echo 'true';die();
        }else {
            echo 'false';die();
        }
        die();
    }

    public function deletecate($id = null){

        $this->loadModel('Cuisines');

        if($this->request->is('ajax')){
            if($this->request->data['action'] == 'Cuisine' && $this->request->data['id'] != ''){

                $id       = $this->request->data['id'];

                $entity = $this->Cuisines->get($id);
                $result = $this->Cuisines->delete($entity);

                list($cuisineList) = $this->index('Cuisines');
                if($this->request->is('ajax')) {
                    $action         = 'Cuisines';
                    $this->set(compact('action', 'cuisineList'));
                    $this->render('ajaxaction');
                }
            }
        }
    }

}