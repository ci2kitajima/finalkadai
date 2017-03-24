<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * Carts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Carts
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Items
 *
 * @method \App\Model\Entity\Cart get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cart newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cart[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cart|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cart patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cart[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cart findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CartsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('carts');
        $this->setDisplayField('cart_id');
        $this->setPrimaryKey('cart_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Carts', [
            'foreignKey' => 'cart_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Items', [
            'foreignKey' => 'item_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('num')
            ->allowEmpty('num');

        $validator
            ->allowEmpty('delete_flg');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['cart_id'], 'Carts'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['item_id'], 'Items'));
        return $rules;
    }

    public function registerCart($requestData, $sessionData,$price)
    {
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('insert into ec.carts(user_id,item_id,num,price,delete_flg) values ('.$sessionData .',' . $requestData . ',1,'.$price .',\'0\');');
        return $results;
    }

    public function getCartList($sessionData)
    {
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('select items.item_id,items.picture, items.price,items.name , 
                                carts.num from items  inner join carts 
                                on (items.item_id = carts.item_id) where carts.user_id =' .$sessionData)->fetchAll('assoc');
        return $results;
    }

    public function deleteCartItem($requestData, $sessionData)
    {
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('delete from carts where user_id = '.$sessionData . ' and item_id = ' .$requestData)->fetchAll('assoc');
        return $results;
    }

    public function deleteCart($sessionData)
    {
        $connection = ConnectionManager::get('default');
        $results = $connection->execute("delete from carts where user_id = $sessionData ");
        return $results;
    }

    public function changeCartItemNum($requestData, $sessionData ,$num)
    {
        error_log("$requestData", 3, 'img/app.log');
        $connection = ConnectionManager::get('default');
        $results = $connection->execute("update carts set  num = " . $num .' where user_id = '.$sessionData . " and item_id = " .$requestData )->fetchAll('assoc');
        return $results;
    }

    public function cartCount($sessionData )
    {
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('select  sum(num * price) as sum from carts where user_id = ' . $sessionData  .' and delete_flg = 0')->fetchAll('assoc');
        return $results;
    }


    public function buy ($sessionData)
    {

    }
}
