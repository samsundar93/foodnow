<?php
/**
 * Created by PhpStorm.
 * User: Sundar
 * Date: 10/5/2017
 * Time: 11:12 PM
 */
namespace App\Model\Table;

use Cake\ORM\Table;



class CustomersTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');

        $this->hasMany('Addressbooks',[
            'className' => 'Addressbooks',
            'foreignKey' => 'customer_id'
        ]);

        $this->hasMany('Orders',[
            'className' => 'Orders',
            'foreignKey' => 'customer_id'
        ]);
    }
}
?>