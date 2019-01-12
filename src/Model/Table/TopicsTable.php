<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class TopicsTable extends Table
{
	public function initialize(array $config)
		{
		$this->addBehavior('Timestamp');
		$this->belongsTo('Users', [
		'foreignKey' => 'user_id',
		]);
	}
	public function isOwnedBy($topicId, $userId)
	{
		return $this->exists(['id' => $topicId, 'user_id' => $userId]);
	}

}
?>