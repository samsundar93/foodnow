<?php
/**
 * Created by PhpStorm.
 * User: roamadmin
 * Date: 07-10-2017
 * Time: 23:04
 */
namespace App\Model\Table;

use Cake\ORM\Table;



class RestaurantMenusTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');

        $this->belongsTo('Categories',[
            'className' => 'Categories',
            'foreignKey' => 'category_id'
        ]);

        $this->belongsTo('Restaurants',[
            'className' => 'Restaurants',
            'foreignKey' => 'restaurant_id'
        ]);

        $this->hasMany('MenuDetails',[
            'className' => 'MenuDetails',
            'foreignKey' => 'menu_id'
        ]);

        $this->hasMany('Carts',[
            'className' => 'Carts',
            'foreignKey' => 'menu_id'
        ]);

        $this->hasMany('MenuAddons',[
            'className' => 'MenuAddons',
            'foreignKey' => 'menu_id'
        ]);
    }
}
?>