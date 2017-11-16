<?php

namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class UsersTable extends Table
{
	public function initialize(array $config)
	{
		$this->table('users');			
        $this->addBehavior('Timestamp');

        $this->hasOne('Customers', [
            'className' => 'Customers',
            'foreignKey' => 'user_id',
            'dependent' => true
        ]);
	}
}

?>