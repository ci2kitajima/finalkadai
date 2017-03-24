<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cart Entity
 *
 * @property int $cart_id
 * @property int $user_id
 * @property int $item_id
 * @property int $num
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $delete_flg
 *
 * @property \App\Model\Entity\Cart $cart
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Item $item
 */
class Cart extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'cart_id' => false
    ];
}
