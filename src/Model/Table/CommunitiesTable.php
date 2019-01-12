<?php
// src/Model/Table/CommunitiesTable.php
namespace App\Model\Table;


use App\Model\Entity\Policy;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CommunitiesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
		 $this->hasMany('CommunitiesResponses');
    }
	
	public function isOwnedBy($articleId, $userId)
	{
		return $this->exists(['id' => $articleId, 'user_id' => $userId]);
	}
	
	public function validationDefault(Validator $validator){
		 $validator->requirePresence('subject','create')
					 ->notEmpty('subject','You must enter Subject.')
					->notEmpty('details','Please, enter Details');
					return $validator;																		
	}
}
