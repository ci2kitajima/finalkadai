<?php
namespace App\Controller;

use App\Model\Entity\Cart;
use Cake\ORM\TableRegistry;

class TopController extends AppController {
    public function initialize(){
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

    public function index(){
        $data = TableRegistry::get('Items');
        $this->set('rank',$data->getRank());
}

}