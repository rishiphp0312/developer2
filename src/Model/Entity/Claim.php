<?php
// src/Model/Entity/Claim.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Claim extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
}
