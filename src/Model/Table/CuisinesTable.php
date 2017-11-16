<?php
/**
 * Created by PhpStorm.
 * User: Sundar
 * Date: 10/2/2017
 * Time: 9:22 PM
 */
namespace App\Model\Table;

use Cake\ORM\Table;



class CuisinesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp');
    }
}
?>