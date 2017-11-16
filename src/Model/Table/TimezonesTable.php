<?php

namespace App\Model\Table;

use App\Model\Entity\Timezone;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class TimezonesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

    }
}
