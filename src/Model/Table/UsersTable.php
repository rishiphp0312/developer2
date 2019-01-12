<?php
// src/Model/Table/ArticlesTable.php
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
        $this->addBehavior('Timestamp');
    }
	
	public function validationDefault(Validator $validator){
		 $validator->requirePresence('email','You must enter your email.')
					->add('email', [
					'email' => [
						'rule' => ['email'],
						'message'=>" Please, enter a valid email!"
						]
					])
					->notEmpty('password','Please, enter your password !')
					->add('password', [
					'compare' => [
						'rule' => ['compareWith', 'cnfpassword'],
						'message'=>"Password mismatch password confirm !"
						]
					]);
					return $validator;																		
	}
	/**
	* Returns a rules checker object . It is used  for validating data
	* I used it her to check if email is unique 
	**/
	
	public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }
}
