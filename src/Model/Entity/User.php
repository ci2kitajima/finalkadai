<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $user_id
 * @property string $user_name
 * @property string $password
 * @property string $mail_address
 * @property string $address
 * @property string $tel
 * @property string $admin_flg
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 * @property string $delete_flg
 *
 * @property \App\Model\Entity\User $user
 */
class User extends Entity
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
        'user_id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
