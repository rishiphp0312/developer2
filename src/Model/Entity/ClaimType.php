<?php
// src/Model/Entity/ClaimType.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class ClaimType extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
