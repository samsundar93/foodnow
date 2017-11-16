<?php
/**
 * Created by PhpStorm.
 * User: roamadmin
 * Date: 23-10-2017
 * Time: 22:07
 */
namespace App\Model\Table;

use Cake\ORM\Table;



class MenuDetailsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');

        $this->belongsTo('RestaurantMenus',[
            'className' => 'RestaurantMenus',
            'foreignKey' => 'menu_id'
        ]);



        $this->hasMany('MenuAddons',[
            'className' => 'MenuAddons',
            'foreignKey' => 'menudetails_id'
        ]);

    }
}
?>