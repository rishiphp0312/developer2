<?php
// src/Model/Table/CommunityResponseTable.php
namespace App\Model\Table;


use App\Model\Entity\CommunityResponse;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CommunitiesResponsesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
						 $this->belongsTo('Communities');

    }
	
	public function isOwnedBy($articleId, $userId)
	{
		return $this->exists(['id' => $articleId, 'user_id' => $userId]);
	}
	
	public function validationDefault(Validator $validator){
		 $validator->requirePresence('response','create')
					 ->notEmpty('response','You must enter Response.');
					return $validator;																		
	}
}
