<?php
// src/Model/Table/PoliciesTable.php
namespace App\Model\Table;


use App\Model\Entity\Policy;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PoliciesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
	
	public function isOwnedBy($articleId, $userId)
	{
    return $this->exists(['id' => $articleId, 'user_id' => $userId]);
	}
	
	public function validationDefault(Validator $validator){
		 $validator->requirePresence('policy_type','create')
					 ->notEmpty('policy_type','You must select one policy')
					->notEmpty('carrier','Please, enter your carrier !')
					
					->notEmpty('effective_date','Please, enter effective date  !')
					->notEmpty('policy_premium','Please, enter policy premium  !')
					->notEmpty('policy_number','Please, enter policy number  !')
										
					//->numeric('policy_number','Please, enter  valid policy number !')	
					->numeric('policy_premium','Please, enter  valid policy premium  !');
					//->date('effective_date','Please, enter valid bith date !')	;

					return $validator;																		
	}
}
