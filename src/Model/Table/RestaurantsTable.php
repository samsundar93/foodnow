<?php

namespace App\Model\Table;

use Cake\ORM\Table;



class RestaurantsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');

        $this->hasMany('Categories',[
            'className' => 'Categories',
            'foreignKey' => 'restaurant_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

        $this->hasMany('RestaurantMenus',[
            'className' => 'RestaurantMenus',
            'foreignKey' => 'restaurant_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

        $this->hasMany('Mainaddons',[
            'className' => 'Mainaddons',
            'foreignKey' => 'restaurant_id'
        ]);

        $this->hasMany('Offers',[
            'className' => 'Offers',
            'foreignKey' => 'restaurant_id'
        ]);

        $this->hasMany('Orders',[
            'className' => 'Orders',
            'foreignKey' => 'restaurant_id'
        ]);
    }
}
?>