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

class ThanksController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('default');
        $this->loadModel('Customers');
        $this->loadModel('Carts');
        $this->loadModel('Restaurants');
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

    public function index($id = null) {
        if($id != '') {
            echo base64_decode($id);die();
        }else {
            return $this->redirect(BASE_URL);
        }

    }
}