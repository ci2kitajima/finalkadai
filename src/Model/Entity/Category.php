<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity
 *
 * @property int $category_id
 * @property string $category_name
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $delete_flg
 *
 * @property \App\Model\Entity\Category $category
 */
class Category extends Entity
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
        'category_id' => false
    ];
}
