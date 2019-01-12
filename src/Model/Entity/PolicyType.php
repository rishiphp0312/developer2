<?php
// src/Model/Entity/PolicyType.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class PolicyType extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
