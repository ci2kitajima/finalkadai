<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Datasource\ConnectionManager;


/**
 * Item Entity
 *
 * @property int $item_id
 * @property int $category_id
 * @property int $price
 * @property string $name
 * @property int $stock
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $delete_flg
 * @property string $picture
 *
 * @property \App\Model\Entity\Item $item
 * @property \App\Model\Entity\Category $category
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
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'item_id' => false
    ];
    public function getRank(){

        $connection = ConnectionManager::get('default');
        $results = $connection->execute('
          select items.item_id, items.name ,count(*) as count from  carts
          inner join items on (carts.item_id = items.item_id)
          group by items.item_id order by count desc limit 5')
            ->fetchAll('assoc');

        return $results;
    }

}
