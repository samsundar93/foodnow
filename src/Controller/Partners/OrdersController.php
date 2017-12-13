<?php
/**
 * Created by PhpStorm.
 * User: Sundar
 * Date: 12/10/2017
 * Time: 7:18 PM
 */
namespace App\Controller\Partners;
use Cake\Event\Event;
use App\Controller\AppController;


class OrdersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('partner');

        $this->loadModel('Mainaddons');
        $this->loadModel('Subaddons');
        $this->loadModel('Categories');
        $this->loadModel('Restaurants');
        $this->loadModel('Users');
        $this->loadModel('Orders');
    }

    public function index() {

    }


    public function getOrderDetails() {

        $orderBy = '';
        if(isset($this->request->getData('search')['value']) && !empty($this->request->getData('search')['value'])) {
            $conditions = [
                "OR" => [
                    "Orders.order_number LIKE" => "%".$this->request->getData('search')['value']."%",
                    "Orders.customer_name LIKE" => "%".$this->request->getData('search')['value']."%"
                ],
                'Orders.status !=' => 'completed'
            ];
        }else {
            $conditions = [
                'Orders.id IS NOT NULL',
                'Orders.status !=' => 'completed'
            ];
        }

        if(isset($this->request->getData('order')[0]['column']) && !empty($this->request->getData('order')[0]['column'])) {

            $fieldName = (($this->request->getData('order')[0]['column'] == '1') ? 'Orders.order_number' : (($this->request->getData('order')[0]['column'] == '2') ? 'Orders.restaurant_id' : (($this->request->getData('order')[0]['column'] == '3') ? 'Orders.delivery_date' : (($this->request->getData('order')[0]['column'] == '4') ? 'Orders.created' : '' ))));

            if($fieldName != '') {
                $orderBy = [
                    $fieldName => $this->request->getData('order')[0]['dir']
                ];
            }

        }
        if($orderBy == '') {
            $orderBy = [
                'Orders.id' => 'DESC'
            ];
        }
        //echo "<pre>";print_r($conditions);die();
        $orderDetails = $this->Orders->find('all', [
            'conditions' => $conditions,
            'contain' => [
                'Restaurants'
            ],
            'order' => $orderBy
        ])->hydrate(false)->toArray();

        $Response['draw']            = $this->request->data['draw'];
        $Response['recordsTotal']    = count($orderDetails);
        $Response['recordsFiltered'] = count($orderDetails);

        $url = 'orders/ajaxaction';
        $action = 'custstatuschange';
        $field = 'status';

        if(!empty($orderDetails)) {
            foreach($orderDetails as $key => $value) {
                $activestatusChange = $value['id'].',"0"'.',"'.$field.'"'.',"'.$url.'"'.',"'.$action.'"';
                $deActiveStatusChange = $value['id'].',"1"'.',"'.$field.'"'.',"'.$url.'"'.',"'.$action.'"';
                $field = 'status';
                $Response['data'][$key]['Id']                = $key+1;
                $Response['data'][$key]['Order ID']              = "<a href='".ADMIN_BASE_URL."orders/view/".$value['id']."' >".$value['order_number']."</a>";
                $Response['data'][$key]['Customer Name']        = $value['customer_name'];
                $Response['data'][$key]['Restaurant Name']      = $value['restaurant']['restaurant_name'];
                $Response['data'][$key]['Delivery Date']        =$value['delivery_date'];
                //$Response['data'][$key]['Order Date']      = $value['created'];
                if($value['status'] == 'Pending') {
                    $Response['data'][$key]['Status']            = "<select id='currentStatus_".$value['id']."' onchange='changeOrderStatus(".$value['id'].");'><option value='pending'>Pending</option><option value='Accept'>Accept</option><option value='Failed'>Reject</option></select> ";
                }else if($value['status'] == 'Accept') {
                    $Response['data'][$key]['Status']            = "<select id='currentStatus_".$value['id']."' onchange='changeOrderStatus(".$value['id'].");'><option value='Accept'>Accepted</option><option value='completed'>Delivered</option><option value='Failed'>Failed</option></select> ";
                }else {
                    $Response['data'][$key]['Status'] = $value['status'];
                }


                $Response['data'][$key]['Order Date']        = date('Y-m-d h:i A', strtotime($value['created']));
            }
        }else {
            $Response['data'] = '';
        }
        echo json_encode($Response);die();
    }

    public function changeStatus() {

        if($this->request->getData('id') != '' && $this->request->getData('status') != '') {
            $orderEntity = $this->Orders->newEntity();
            $orderPatch  = $this->Orders->patchEntity($orderEntity,$this->request->getData());
            $orderSave   = $this->Orders->save($orderPatch);
            if($orderSave) {
                echo '1';die();
            }
        }else {
            echo '0';die();
        }
    }
}