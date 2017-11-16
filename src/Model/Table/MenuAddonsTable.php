<?php
/**
 * Created by PhpStorm.
 * User: roamadmin
 * Date: 23-10-2017
 * Time: 22:09
 */
namespace App\Model\Table;

use Cake\ORM\Table;



class MenuAddonsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');

        $this->belongsTo('RestaurantMenus',[
            'className' => 'RestaurantMenus',
            'foreignKey' => 'menu_id'
        ]);

        $this->belongsTo('Mainaddons',[
            'className' => 'Mainaddons',
            'foreignKey' => 'mainaddons_id'
        ]);

    }
}
?>