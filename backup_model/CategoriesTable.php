<?php
/**
 * Created by PhpStorm.
 * User: Sundar
 * Date: 10/2/2017
 * Time: 8:36 PM
 */
namespace App\Model\Table;

use Cake\ORM\Table;



class CategoriesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');

        $this->belongsTo('Restaurants',[
            'className' => 'Restaurants',
            'foreignKey' => 'restaurant_id'
        ]);

        $this->hasMany('RestaurantMenus',[
            'className' => 'RestaurantMenus',
            'foreignKey' => 'category_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);


    }
}
?>