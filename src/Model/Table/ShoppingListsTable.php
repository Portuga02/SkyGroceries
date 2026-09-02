<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class ShoppingListsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('shopping_lists');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
        $this->hasMany('Items', [
            'foreignKey' => 'shopping_list_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
    }
}
