<?php
/**
 * Created by PhpStorm.
 * User: roamadmin
 * Date: 25-10-2017
 * Time: 22:10
 */
namespace App\Controller\Eatadmin;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\Table;
use Excel\Controller\ExcelReaderController;

class AddressController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('backend');

        $this->loadModel('Customers');
        $this->loadModel('Addressbooks');
    }

    //Index
    public function index($process = null) {
        $addessList = $this->Addressbooks->find('all', [
            'conditions' => [
                'Addressbooks.id IS NOT NULL',
                'Addressbooks.delete_status' => 'N'
            ],
            'contain' => [
                'Customers'
            ]
        ])->hydrate(false)->toArray();

        $this->set(compact('addessList'));

        if($process == 'Address' ){
            $value = array($addessList);
            return $value;
        }

    }

    //AddEdit Section
    public function addedit($id = null) {

        if($this->request->is('post')) {

            $prepAddr = str_replace(' ','+',$this->request->getData('address'));


            $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.
                '&sensor=false');

            $output= json_decode($geocode);

            $sourcelatitude = $output->results[0]->geometry->location->lat;
            $sourcelongitude = $output->results[0]->geometry->location->lng;


            $addressEntity = $this->Addressbooks->newEntity();
            $addressPatch = $this->Addressbooks->patchEntity($addressEntity,$this->request->getData());
            if($this->request->getData('editedId') != '') {
                $addressPatch->id = $this->request->getData('editedId');
            }
            $addressPatch->latitude = $sourcelatitude;
            $addressPatch->longitude = $sourcelongitude;
            $addressSave = $this->Addressbooks->save($addressPatch);
            if($addressSave) {
                if($this->request->getData('editedId') != '') {
                    $this->Flash->success(__('Address updated successful'));
                }else {
                    $this->Flash->success(__('Address added successful'));
                }

                return $this->redirect(ADMIN_BASE_URL.'address');
            }
        }

        //Customer List
        $customerList = $this->Customers->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
            'conditions' => [
                'status' => '1',
                'delete_status' => 'No'
            ]
        ])->hydrate(false)->toArray();

        $addressDetails = $this->Addressbooks->find('all', [
            'conditions' => [
                'id' => $id
            ]
        ])->hydrate(false)->first();

        $this->set(compact('customerList','id','addressDetails'));
    }

    //AjaxAction Section
    public function ajaxaction() {

        if($this->request->getData('action') == 'checktitle') {
            if($this->request->getData('id') != '') {
                $conditions = [
                    'id !=' => $this->request->getData('id'),
                    'title' => $this->request->getData('title'),
                    'customer_id' => $this->request->getData('customer_id')
                ];
            }else {
                $conditions = [
                    'title' => $this->request->getData('title'),
                    'customer_id' => $this->request->getData('customer_id')
                ];
            }

            $addressCount = $this->Addressbooks->find('all', [
                'conditions' => $conditions
            ])->count();

            if($addressCount > 0) {
                echo '0';die();
            }else {
                echo '1';die();
            }
            die();
        }

        if($this->request->is('ajax')){
            if($this->request->data['action'] == 'addressstatuschange'){

                $category         = $this->Addressbooks->newEntity();
                $category         = $this->Addressbooks->patchEntity($category,$this->request->getData());
                $category->id     = $this->request->data['id'];
                $category->status = $this->request->data['changestaus'];
                $this->Addressbooks->save($category);

                $this->set('id', $this->request->data['id']);
                $this->set('action', 'addressstatuschange');
                $this->set('field', $this->request->data['field']);
                $this->set('status', (($this->request->data['changestaus'] == 0) ? 'deactive' : 'active'));
            }
        }

    }

    public function deleteaddress(){

        if($this->request->is('ajax')){
            if($this->request->data['action'] == 'address' && $this->request->data['id'] != ''){

                $id       = $this->request->data['id'];

                $entity = $this->Addressbooks->get($id);
                $result = $this->Addressbooks->delete($entity);

                list($addessList) = $this->index('Address');
                if($this->request->is('ajax')) {
                    $action         = 'Address';
                    $this->set(compact('action', 'addessList'));
                    $this->render('ajaxaction');
                }
            }
        }
    }
}