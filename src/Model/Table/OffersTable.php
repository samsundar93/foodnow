<?php
/**
 * Created by PhpStorm.
 * User: roamadmin
 * Date: 26-10-2017
 * Time: 00:37
 */
namespace App\Model\Table;

use Cake\ORM\Table;



class OffersTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');

        $this->belongsTo('Restaurants',[
            'className' => 'Restaurants',
            'foreignKey' => 'restaurant_id'
        ]);
    }
}
?>