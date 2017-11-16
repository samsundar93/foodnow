<?php
/**
 * Created by PhpStorm.
 * User: roamadmin
 * Date: 25-10-2017
 * Time: 22:15
 */
namespace App\Model\Table;

use Cake\ORM\Table;



class AddressbooksTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers',[
            'className' => 'Customers',
            'foreignKey' => 'customer_id'
        ]);
    }
}
?>