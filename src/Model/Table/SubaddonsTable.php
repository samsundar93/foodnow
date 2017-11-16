<?php
/**
 * Created by PhpStorm.
 * User: roamadmin
 * Date: 16-10-2017
 * Time: 19:17
 */

namespace App\Model\Table;

use Cake\ORM\Table;



class SubaddonsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');

        $this->belongsTo('Restaurants',[
            'className' => 'Restaurants',
            'foreignKey' => 'restaurant_id'
        ]);

        $this->belongsTo('Categories',[
            'className' => 'Categories',
            'foreignKey' => 'category_id'
        ]);

        $this->hasMany('Mainaddons',[
            'className' => 'Mainaddons',
            'foreignKey' => 'mainaddons_id'
        ]);

        $this->hasMany('MenuAddons',[
            'className' => 'MenuAddons',
            'foreignKey' => 'subaddons_id'
        ]);


    }
}
?>