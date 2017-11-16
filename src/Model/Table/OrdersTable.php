<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/12/2017
 * Time: 4:27 PM
 */
namespace App\Model\Table;

use Cake\ORM\Table;



class OrdersTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');

        $this->belongsTo('Restaurants',[
            'className' => 'Restaurants',
            'foreignKey' => 'restaurant_id'
        ]);

        $this->belongsTo('Customers',[
            'className' => 'Customers',
            'foreignKey' => 'customer_id'
        ]);
    }
}
?>