<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $order_id
 * @property int $user_id
 * @property int $payment
 * @property \Cake\I18n\Time $order_date
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $delete_flg
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\User $user
 */
class Order extends Entity
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
        'order_id' => false
    ];
}
