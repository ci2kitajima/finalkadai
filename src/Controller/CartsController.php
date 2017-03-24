<?php
namespace App\Controller;

use App\Model\Entity\Cart;
use Cake\ORM\TableRegistry;

class CartsController extends AppController
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
        $sessionData = $this->Session->read('userId');
        if (!isset($sessionData)) {
            $this->redirect('/top');
        }
        $data = TableRegistry::get('Carts');
        $this->set('cart_list',$data->getCartList($sessionData));

        //合計値を取得する
        $cart_count = $data->cartCount($sessionData);
        $this->set('cart_count', $cart_count[0]['sum']  );


    }

}