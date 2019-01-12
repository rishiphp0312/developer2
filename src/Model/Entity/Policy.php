<?php
// src/Model/Entity/Policy.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Policy extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
}
