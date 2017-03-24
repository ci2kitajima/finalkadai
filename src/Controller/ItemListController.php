<?php
namespace App\Controller;

use App\Model\Entity\Cart;
use Cake\ORM\TableRegistry;

class ItemListController extends AppController
{
    public function initialize()
    {
        $this->viewBuilder()->autoLayout(false);
        parent::initialize();
        $this->Session = $this->request->session();
        $this->loadComponent('RequestHandler');
        $sessionData = $this->Session->read('userId');
        if (isset($sessionData)) {
            $this->set('loginFlg' ,true);
        }else {
            $this->set('loginFlg' ,false);
        }
    }

    public function index()
    {
        $this->loadModel('Items');
        $this->loadModel('Categories');

        //$param = $this->request->query['genre'];


        if(!isset($this->request->query['genre'])){


            $word = $this->request->query['word'];
            $this->set('title_item', '検索結果');

            $data = TableRegistry::get('Items');

            $this->set('itemList', $data->searchName($word));

        }else {
            $param = $this->request->query['genre'];
            // いまいちだけど二発行
            $data_title = $this->Categories->find()
                ->where(['category_id' => $param])
                ->toArray();
            $this->set('title_item', $data_title[0]->category_name);

            $data = $this->Items->find()
                ->where(['category_id' => $param]);
            $this->set('itemList', $data);
        }


    }



}