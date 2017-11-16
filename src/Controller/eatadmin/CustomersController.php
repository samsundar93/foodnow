<?php
/**
 * Created by PhpStorm.
 * User: Sundar
 * Date: 9/29/2017
 * Time: 10:51 PM
 */
namespace App\Controller\Eatadmin;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\Table;
use Excel\Controller\ExcelReaderController;

class CustomersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('backend');

        $this->loadModel('Users');
        $this->loadModel('Customers');
        $this->loadModel('Sitesettings');
        $this->loadModel('Timezones');
    }

    public function index($process = null) {

        $custList = $this->Customers->find('all', [
            'conditions' => [
                'id IS NOT NULL',
                'delete_status' => 'No'
            ]
        ])->hydrate(false)->toArray();

        $this->set(compact('custList'));

        if($process == 'custManage') {
            $values = array($custList);
            return $values;
        }
    }

    public function addedit($id = null) {

        if($this->request->is('post')) {           

            if($this->request->getData('editedId') != '') {

                $users = $this->Users->find('all', [
                    'conditions' =>[
                        'user_id' => $this->request->getData('editedId')
                    ]
                ])->hydrate(false)->first();
                //$this->request->getData('id') = $this->request->getData('editedId');
                $customerPatch['id'] = $this->request->getData('editedId');
            }

            $customers = $this->Customers->newEntity();
            $customerPatch = $this->Customers->patchEntity($customers, $this->request->getData());
            $saveCustomer = $this->Customers->save($customerPatch);

            if($saveCustomer) {
                $user = $this->Users->newEntity();
                $userDetails['id'] = (isset($users['id'])) ? $users['id'] : '';
                $userDetails['username'] = $this->request->getData('phone_number');
                $userDetails['password'] = $this->request->getData('password');
                $userDetails['user_id'] = $saveCustomer->id;
                $userDetails['role_id'] = '3';
                $usersPatch = $this->Users->patchEntity($user, $userDetails);
                $saveuser = $this->Users->save($usersPatch);
                if($this->request->getData('editedId') != '') {
                    $this->Flash->success(__('Customer edit successful'));
                }else {
                    $this->Flash->success(__('Customer add successful '));
                }
                return $this->redirect(ADMIN_BASE_URL.'customers');
            }
        }else {
            $customerList  = $this->Customers->find('all', [
                'fields'     => [
                    'id',
                    'user_id',
                    'name',
                    'username',
                    'phone_number',
                    'profile_photo'
                ],
                'conditions' => [
                    'id =' => $id
                ]
            ])->hydrate(false)->first();

            $this->set(compact('customerList','id'));
        }

        $this->set(compact('id'));

    }

    public function ajaxaction() {

        if($this->request->getData('action') == 'custstatuschange'){

            $usersEnty         = $this->Customers->newEntity();
            $usersEnty         = $this->Customers->patchEntity($usersEnty,$this->request->data);
            $usersEnty->id     = $this->request->getData('id');
            $usersEnty->status = $this->request->getData('changestaus');
            $this->Customers->save($usersEnty);

            $this->set('id', $this->request->getData('id'));
            $this->set('action', 'custstatuschange');
            $this->set('field', $this->request->getData('field'));
            $this->set('status', (($this->request->getData('changestaus') == 0) ? 'deactive' : 'active'));
        }
    }

    public function checkCustomer() {

        if($this->request->getData('id') != '') {
            $conditions = [
                'id!=' => $this->request->getData('id'),
                'OR' => [
                    'username' => $this->request->getData('username'),
                    'phone_number' => $this->request->getData('phone_number'),
                ]
            ];

        }else {
            $conditions = [                
                'OR' => [
                    'username' => $this->request->getData('username'),
                    'phone_number' => $this->request->getData('phone_number')
                ]
            ];
        }

        $userCount = $this->Customers->find('all', [
            'conditions' => $conditions
        ])->count();

        if($userCount == 0) {
            echo 'true';die();
        }else {
            echo 'false';exit;
        }
    }

    public function deletecust($mcatid = null){


        if($this->request->is('ajax')){
            if($this->request->getData('action') == 'customers' && $this->request->data['id'] != ''){

                $customer         = $this->Customers->newEntity();
                $customer         = $this->Customers->patchEntity($customer,$this->request->getData());
                $customer->id     = $this->request->getData('id');
                $customer->delete_status = 'Yes';
                $this->Customers->save($customer);

                list($customerList) = $this->index('customer');
                if($this->request->is('ajax')) {
                    $action         = 'custManage';
                    $this->set(compact('action', 'customerList'));
                    $this->render('ajaxaction');
                }
            }
        }
    }
}