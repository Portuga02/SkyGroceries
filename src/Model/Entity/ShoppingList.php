<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class ShoppingList extends Entity
{
    protected array $_accessible = [
        'name' => true,
        'items' => true,
        'created' => true,
        'modified' => true,
    ];
}
