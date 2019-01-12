<?php
// src/Model/Entity/CommunityResponse.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class CommunityResponse extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
}
