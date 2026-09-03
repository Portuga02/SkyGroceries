<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Item Entity
 *
 * @property int $id
 * @property int $shopping_list_id
 * @property string $name
 * @property string|null $category
 * @property string|null $price
 * @property bool $is_purchased
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\ShoppingList $shopping_list
 */
class Item extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'shopping_list_id' => true,
        'name' => true,
        'category' => true,
        'price' => true,
        'is_purchased' => true,
        'created' => true,
        'modified' => true,
        'shopping_list' => true,
    ];
}
