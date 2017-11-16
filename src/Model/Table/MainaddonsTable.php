<?php
/**
 * Created by PhpStorm.
 * User: roamadmin
 * Date: 16-10-2017
 * Time: 16:28
 */
namespace App\Model\Table;

use Cake\ORM\Table;



class MainaddonsTable extends Table
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

        $this->hasMany('Subaddons',[
            'className' => 'Subaddons',
            'foreignKey' => 'mainaddons_id',
            'dependent' => true,
            'cascadeCallbacks' => true,

        ]);

        $this->hasMany('MenuAddons',[
            'className' => 'MenuAddons',
            'foreignKey' => 'mainaddons_id'
        ]);


    }
}
?>