<?php
/**
 * Created by PhpStorm.
 * User: FoodDp
 * Date: 11/16/2017
 * Time: 12:28 PM
 */
namespace App\Model\Table;

use Cake\ORM\Table;



class StripecardsTable extends Table
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