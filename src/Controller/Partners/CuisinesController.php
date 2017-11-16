<?php
/**
 * Created by PhpStorm.
 * User: roamadmin
 * Date: 02-11-2017
 * Time: 17:40
 */
namespace App\Controller\Partners;
use Cake\Event\Event;
use App\Controller\AppController;


class CuisinesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('partner');

        $this->loadModel('Cuisines');
    }

    public function index($process = null) {


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

    public function add() {

        if($this->request->is('post')) {

            $cuisine = $this->Cuisines->newEntity();
            $cuisinePatch = $this->Cuisines->patchEntity($cuisine,$this->request->getData());
            $saveCuisine = $this->Cuisines->save($cuisinePatch);
            if($saveCuisine) {
                $this->Flash->success(__('Cuisine added successful'));
                return $this->redirect(PARTNER_BASE_URL.'cuisines');
            }
        }
    }

    public function edit($id = null) {

        if($this->request->is('post')) {

            $category = $this->Cuisines->newEntity();
            $categoryPatch = $this->Cuisines->patchEntity($category,$this->request->getData());
            $categoryPatch->id = $this->request->getData('editId');
            $saveCategory = $this->Cuisines->save($categoryPatch);
            if($saveCategory) {
                $this->Flash->success(__('Cuisine edited successful'));
                return $this->redirect(PARTNER_BASE_URL.'cuisines');
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

        if($this->request->is('ajax')){
            if($this->request->getData('action') == 'cuisinestatuschange'){

                $category         = $this->Cuisines->newEntity();
                $category         = $this->Cuisines->patchEntity($category,$this->request->getData());
                $category->id     = $this->request->getData('id');
                $category->status = $this->request->getData('changestaus');
                $this->Cuisines->save($category);

                $this->set('id', $this->request->getData('id'));
                $this->set('action', 'cuisinestatuschange');
                $this->set('field', $this->request->getData('field'));
                $this->set('status', (($this->request->getData('changestaus') == 0) ? 'deactive' : 'active'));
            }
        }
    }

    public function checkCuisine() {
        if($this->request->getData('id') != '') {
            $conditions = [
                'id !=' => $this->request->getData('id'),
                'cuisine_name' => $this->request->getData('cuisine_name')
            ];

        }else {
            $conditions = [
                'cuisine_name' => $this->request->getData('cuisine_name')
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
            if($this->request->getData('action') == 'Cuisines' && $this->request->getData('id') != ''){

                $id       = $this->request->getData('id');

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