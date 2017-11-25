<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/12/2017
 * Time: 5:01 PM
 */
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\Table;
use Cake\Network\Session;
use Cake\Utility\Hash;

class MyaccountController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('default');
        $this->loadModel('Customers');
        $this->loadModel('Users');
        $this->loadModel('Restaurants');
        $this->loadModel('Addressbooks');
        $this->loadModel('Orders');
        $this->loadComponent('Common');
    }

    public function beforeFilter(Event $event)
    {
        // Before Login , these are the function we can access

    }
    public function index()
    {
        $customerId = $this->Auth->user('user_id');

        $customerDetails = $this->Customers->find('all', [
            'conditions' => [
                'Customers.id' => $customerId
            ],
            'contain' => [
                'Addressbooks',
                'Orders',
                'Stripecards'
            ]
        ])->hydrate(false)->first();
        //pr($customerDetails);die();

        $this->set(compact('customerDetails','customerId'));
    }

    public function profileUpdate() {

        if($this->request->getData('username') != '' && $this->request->getData('name') != '' && $this->request->getData('phone_number') != '') {

                //Valid Email ALready exists or Not
                $emailValidate = $this->Customers->find('all', [
                    'conditions' => [
                        'id !=' => $this->Auth->user('user_id'),
                        'username' => $this->request->getData('username')
                    ]
                ])->count();
                if($emailValidate > 0) {
                    $response['success'] = 0;
                    $response['message'] = 'Email already Registred';
                }

                //Valid Phonenumber ALready exists or Not
                $phoneValidate = $this->Customers->find('all', [
                    'conditions' => [
                        'id !=' => $this->Auth->user('user_id'),
                        'phone_number' => $this->request->getData('phone_number')
                    ]
                ])->count();
                if($phoneValidate > 0) {
                    $response['success'] = 0;
                    $response['message'] = 'Phone number already Registred';
                }

                if($emailValidate == 0 && $phoneValidate == 0) {

                    $customers = $this->Customers->newEntity();
                    $customerPatch = $this->Customers->patchEntity($customers, $this->request->getData());
                    $customerPatch->id = $this->Auth->user('user_id');
                    $saveCustomer = $this->Customers->save($customerPatch);

                    if($saveCustomer) {
                        $user = $this->Users->newEntity();
                        $userDetails['id'] = $this->Auth->user('id');
                        $userDetails['username'] = $this->request->getData('phone_number');
                        $userDetails['password'] = $this->request->getData('password');
                        $usersPatch = $this->Users->patchEntity($user, $userDetails);
                        $saveuser = $this->Users->save($usersPatch);
                        $response['success'] = 1;
                        $response['message'] = 'Profile Update successful';
                        $this->Flash->success(__('Profile update successful'));
                    }

                }

        }else {
            $response['success'] = 0;
            $response['message'] = 'Required Fields Missings';
        }
        echo json_encode($response,true);die();

    }
}