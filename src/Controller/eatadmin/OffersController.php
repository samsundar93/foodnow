<?php
/**
 * Created by PhpStorm.
 * User: roamadmin
 * Date: 26-10-2017
 * Time: 00:38
 */
namespace App\Controller\Eatadmin;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\Table;
use Excel\Controller\ExcelReaderController;

class OffersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('backend');

        $this->loadModel('Restaurants');
        $this->loadModel('Offers');
    }

    public function index($process = null) {

        $offerList = $this->Offers->find('all',[
            'conditions' => [
                'id IS NOT NULL'
            ]
        ])->hydrate(false)->toArray();

        $this->set(compact('offerList'));
    }

    public function addedit($id = null) {

    }

    public function ajaxaction() {

    }
}