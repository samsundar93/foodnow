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

class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('default');
    }

    public function beforeFilter(Event $event)
    {
        // Before Login , these are the function we can access
        $this->Auth->allow([
            'index',
            'checkCustomer',
            'customerLogin',
            'search'
        ]);
    }

    public function index() {

    }

    //Check Customer Already Exists Or Not
    public function checkCustomer() {

        $this->loadModel('Customers');
        $this->loadModel('Users');

        $conditions = [
            'OR' => [
                'username' => $this->request->getData('username'),
                'phone_number' => $this->request->getData('phone_number')
            ]
        ];

        $userCount = $this->Customers->find('all', [
            'conditions' => $conditions
        ])->count();

        if($userCount == 0) {
            $customers = $this->Customers->newEntity();
            $customerPatch = $this->Customers->patchEntity($customers, $this->request->getData());
            $saveCustomer = $this->Customers->save($customerPatch);

            if($saveCustomer) {
                $user = $this->Users->newEntity();
                $userDetails['username'] = $this->request->getData('phone_number');
                $userDetails['password'] = $this->request->getData('password');
                $userDetails['user_id'] = $saveCustomer->id;
                $userDetails['role_id'] = '3';
                $usersPatch = $this->Users->patchEntity($user, $userDetails);
                $saveuser = $this->Users->save($usersPatch);
                $this->Flash->success(__('Registered successful '));
                echo 'true';die();
            }
        }else {
            echo 'false';exit;
        }
    }

    public function customerLogin() {
        $this->loadModel('Users');
        $this->loadModel('Customers');

        if($this->request->getData('username') != '' && $this->request->getData('password') != '') {
            $user           = $this->Auth->identify();

            if(count($user) != 0) {
                $sp_status      = $this->Customers->find('all', [
                    'fields' => [
                        'status'
                    ],
                    'conditions' => [
                        'id ='=> $user['user_id'],
                        'delete_status' => 'No'
                    ]
                ])->hydrate(false)->toArray();

                if(count($sp_status) != 0 && !empty($sp_status[0]['status']) && $sp_status[0]['status'] == '1' &&
                    $user['role_id'] == '3'){

                    $this->Auth->setUser($user);

                    $username   = $this->Customers->find('all',[
                        'fields' => [
                            'name','id'
                        ],
                        'conditions' => [
                            'id ='=> $user['user_id']
                        ]
                    ])->hydrate(false)->first();
                    $this->request->session()->write('customername',$username['name']);
                    $this->Flash->success(__('Login successful.'));
                    echo 1;exit();
                }
                else if(count($sp_status) != 0 && $sp_status[0]['status'] == 0 && $user['role_id'] == '3'){
                    echo 2;exit();
                }
                else{
                    echo 0;exit();
                }
            }else {
                echo 0;exit();
            }

        }else {
            echo 3;die();
        }
    }

    public function logout() {
        $this->request->session()->write('customername','');
        $this->Auth->logout();
        $this->Flash->success(__('Logout successful.'));
        return $this->redirect(BASE_URL);
    }

    public function search() {
        if($this->request->getData('searchLocation') != '') {
            $this->request->session()->write('searchLocation', $this->request->getData('searchLocation'));
            die();
        }
    }
}