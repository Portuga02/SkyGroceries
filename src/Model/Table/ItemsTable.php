<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Items Model
 *
 * @property \App\Model\Table\ShoppingListsTable&\Cake\ORM\Association\BelongsTo $ShoppingLists
 *
 * @method \App\Model\Entity\Item newEmptyEntity()
 * @method \App\Model\Entity\Item newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Item> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Item get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Item findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Item patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Item> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Item|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Item saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Item>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Item>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Item>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Item> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Item>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Item>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Item>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Item> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
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

        $this->setTable('items');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ShoppingLists', [
            'foreignKey' => 'shopping_list_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('shopping_list_id')
            ->notEmptyString('shopping_list_id');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('category')
            ->maxLength('category', 100)
            ->allowEmptyString('category');

        $validator
            ->decimal('price')
            ->allowEmptyString('price');

        $validator
            ->boolean('is_purchased')
            ->notEmptyString('is_purchased');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['shopping_list_id'], 'ShoppingLists'), ['errorField' => 'shopping_list_id']);

        return $rules;
    }
}
