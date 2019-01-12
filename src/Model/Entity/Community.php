<?php
// src/Model/Entity/Community.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Community extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
}
