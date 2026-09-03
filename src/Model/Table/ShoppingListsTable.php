<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class ShoppingListsTable extends Table
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
    public function beforeSave(\Cake\Event\EventInterface $event, \Cake\Datasource\EntityInterface $entity, \ArrayObject $options)
    {
        if (empty($entity->icon)) {
            $entity->icon = '🛒'; // Padrão se vier em branco
        }
    }
}
