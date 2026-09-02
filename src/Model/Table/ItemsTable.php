<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class ItemsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);
        parent::initialize($config);
        $this->setTable('items');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('ShoppingLists', [
            'foreignKey' => 'shopping_list_id',
            'joinType' => 'INNER',
        ]);
    }
}
