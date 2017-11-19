<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/19/2017
 * Time: 3:25 PM
 */
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\Table;
use Cake\Network\Session;
use Cake\Utility\Hash;

class CustomersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('default');
        $this->loadModel('Customers');
        $this->loadModel('Addressbooks');
        $this->loadModel('Orders');
        $this->loadComponent('Common');
    }

    public function beforeFilter(Event $event)
    {
        // Before Login , these are the function we can access
        $this->Auth->allow([
            //'index'
        ]);
    }

    public function myaccount() {
        $customerId = $this->Auth->user('user_id');

        $customerDetails = $this->Customers->find('all', [
            'conditions' => [
                'Customers.id' => $customerId
            ],
            'contain' => [
                'Addressbooks',
                'Orders'
            ]
        ])->hydrate(false)->first();
        pr($customerDetails);die();
    }
}