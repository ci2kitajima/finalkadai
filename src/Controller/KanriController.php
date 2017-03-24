<?php
namespace App\Controller;

use App\Model\Entity\Cart;
use Cake\ORM\TableRegistry;

class KanriController extends AppController {
    public function initialize(){
        $this->viewBuilder()->autoLayout(false);
    }

    public function index(){
        $this->loadModel('Items');
        $data = $this->Items->find();
        $this->set('itemList', $data);
}

}