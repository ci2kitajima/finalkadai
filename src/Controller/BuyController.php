<?php
namespace App\Controller;

use App\Model\Entity\Cart;
use Cake\ORM\TableRegistry;

class BuyController extends AppController {
    public function initialize(){
        $this->viewBuilder()->autoLayout(false);
    }

    public function index(){
        $data = TableRegistry::get('Items');
        $this->set('rank',$data->getRank());
}

}