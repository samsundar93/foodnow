<?php
/**
 * Created by PhpStorm.
 * User: Support
 * Date: 21-11-2017
 * Time: 16:39
 */
namespace App\Controller\Mobile;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Utility\Hash;

class RestaurantsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow([
            'index'
        ]);
    }

    public function index()
    {
        $action = $this->request->getData('action');

        if (!empty($action)) {
            switch ($action) {

                case "ownerLogin":
                    if($this->request->getData('username') != '' && $this->request->getData('password') != '') {

                        $user = $this->Auth->identify();
                        if(!empty($user) && ($user['role_id'] == 2)){
                            $this->Auth->setUser($user);
                            $response['success'] = 1;
                            $response['data'] = $user;
                            $response['message'] = 'Login Successful';
                        }else{
                            $response['success'] = 0;
                            $response['message'] = 'Invalid username or password, try again ';
                        }

                    }else {
                        $response['success'] = 0;
                        $response['message'] = 'Something wrong';
                    }
                    break;

                case 'categoryList':
                    if($this->request->getData('ownerId') != '') {

                        $this->loadModel('Categories');
                        $categoryList = $this->Categories->find('all', [
                            'conditions' => [
                                'id IS NOT NULL',
                                'restaurant_id' => $this->request->getData('ownerId')
                            ],
                            'order' => 'sortorder'
                        ])->hydrate(false)->toArray();

                        if(!empty($categoryList)) {
                            $response['success'] = 1;
                            $response['data'] = $categoryList;
                        }else {
                            $response['success'] = 0;
                            $response['message'] = 'Categories Empty';
                        }

                    }else {
                        $response['success'] = 0;
                        $response['message'] = 'Something wrong';
                    }

                    break;

                case 'changeStatus':

                    $this->loadModel('Categories');

                    if($this->request->getData('id') != '' && $this->request->getData('status') != ''){
                        $category         = $this->Categories->newEntity();
                        $category         = $this->Categories->patchEntity($category,$this->request->getData());
                        $category->id     = $this->request->getData('id');
                        $category->status = $this->request->getData('changestaus');
                        $this->Categories->save($category);
                        $response['success'] = 1;
                        $response['message'] = 'Status changed successfuly';
                    }else {
                        $response['success'] = 0;
                        $response['message'] = 'Something wrong';
                    }
                    break;

                case 'pendingList':

                    //Load Model
                    $this->loadModel('Orders');

                    $pendingList = $this->Orders->find('all', [
                        'conditions' => [
                            'restaurant_id' => $this->request->getData('userId'),
                            'status' => 'pending'
                        ]
                    ])->hydrate(false)->toArray();

                    if(!empty($pendingList)) {
                        $response['success'] = 1;
                        $response['pendingList'] = $pendingList;
                    }else {
                        $response['success'] = 0;
                        $response['message'] = 'No Record Found';
                    }

                    break;

                case 'processingList':

                    //Load Model
                    $this->loadModel('Orders');

                    $processingList = $this->Orders->find('all', [
                        'conditions' => [
                            'restaurant_id' => $this->request->getData('userId'),
                            'status' => 'processing'
                        ]
                    ])->hydrate(false)->toArray();

                    if(!empty($pendingList)) {
                        $response['success'] = 1;
                        $response['processingList'] = $processingList;
                    }else {
                        $response['success'] = 0;
                        $response['message'] = 'No Record Found';
                    }

                    break;

                case 'completedList':

                    //Load Model
                    $this->loadModel('Orders');

                    $completedList = $this->Orders->find('all', [
                        'conditions' => [
                            'restaurant_id' => $this->request->getData('userId'),
                            'status' => 'completed'
                        ]
                    ])->hydrate(false)->toArray();

                    if(!empty($pendingList)) {
                        $response['success'] = 1;
                        $response['completedList'] = $completedList;
                    }else {
                        $response['success'] = 0;
                        $response['message'] = 'No Record Found';
                    }

                    break;

                case 'failedList':

                    //Load Model
                    $this->loadModel('Orders');

                    $failedList = $this->Orders->find('all', [
                        'conditions' => [
                            'restaurant_id' => $this->request->getData('userId'),
                            'status' => 'failed'
                        ]
                    ])->hydrate(false)->toArray();

                    if(!empty($pendingList)) {
                        $response['success'] = 1;
                        $response['failedList'] = $failedList;
                    }else {
                        $response['success'] = 0;
                        $response['message'] = 'No Record Found';
                    }

                    break;
            }
            die(json_encode($response));
        }else {
            die();
        }
    }
}