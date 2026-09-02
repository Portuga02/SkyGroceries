<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Item extends Entity
{
    protected array $_accessible = [
        'shopping_list_id' => true,
        'name' => true,
        'quantity' => true,
        'purchased' => true,
        'created' => true,
        'modified' => true,
        'shopping_list' => true,
      '*' => true,
    ];
}
