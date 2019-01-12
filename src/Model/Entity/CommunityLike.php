<?php
// src/Model/Entity/CommunityLike.php.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class CommunityLike extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
}
