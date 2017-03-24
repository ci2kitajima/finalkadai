<?php
namespace App\Controller;

use App\Model\Entity\Cart;
use Cake\ORM\TableRegistry;

class LoginController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Session = $this->request->session();
        $this->viewBuilder()->autoLayout(false);
    }

    public function index()
    {
    }

    public function singIn()
    {
        $mail_address = $_POST['inputEmail'];
        $password = $_POST['inputPassword'];
        $this->loadModel('Users');
        $result = $this->Users->find()
            ->where(['mail_address' => $mail_address])
            ->andWhere(['password' => $password])
            ->toArray();

        if (count($result) !== 0) {
            //ログインが成功したのでセッションを中に入れる
            $this->Session->write('userId', $result[0]->user_id);
            $this->redirect('/top');
        }
        $this->set('check', 'メールアドレス、またはパスワードが不正です。');
    }
}