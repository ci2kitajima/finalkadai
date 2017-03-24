<?php
namespace App\Controller;

use App\Model\Entity\Cart;
use Aura\Intl\Exception;
use Cake\ORM\TableRegistry;

class RestApiController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Session = $this->request->session();
        $this->loadComponent('RequestHandler'); // これを追加
    }

    public function registerCart()
    {
        $this->response->type('json');
        $sessionData = $this->Session->read('userId');
        if (!isset($sessionData)) {
            $this->redirect('/top');
        }

        $this->autoRender = false;
        $requestData = $_POST['item_id'];
        $price = $_POST['price'];

        // 今回はJSONのみを返すためViewのレンダーを無効化
        $this->autoRender = false;
        // Ajax以外の通信の場合
        $data = TableRegistry::get('Carts');

        try {
            // カートに登録する
            $data->registerCart($requestData, $sessionData, $price);
        } catch (Exception $e) {
            $this->response->body(json_encode(array('code' => 404)));
            return $this->response;
        }
        $this->response->body(json_encode(array('code' => 200)));
        return $this->response;
    }

    public function deleteCartItem()
    {


        $this->response->type('json');
        $sessionData = $this->Session->read('userId');
        if (!isset($sessionData)) {
            $this->redirect('/top');
        }


        // 今回はJSONのみを返すためViewのレンダーを無効化
        $this->autoRender = false;
        // Ajax以外の通信の場合
        $data = TableRegistry::get('Carts');
        $json = $this->request->data;
        try {
            // 削除
            $data->deleteCartItem($json['item_id'], $sessionData);
        } catch (Exception $e) {
            $this->response->body(json_encode(array('code' => 404)));
            return $this->response;
        }
        $this->response->body(json_encode(array('code' => 200)));
        return $this->response;
    }

    public function changeCartItemNum()
    {
        $this->response->type('json');
        $sessionData = $this->Session->read('userId');
        if (!isset($sessionData)) {
            $this->redirect('/top');
        }

        $this->autoRender = false;
        $json = $this->request->data;
        $sss = $json['item_id'];
        error_log("$sss", 3, 'img/app.log');


        // 今回はJSONのみを返すためViewのレンダーを無効化
        $this->autoRender = false;
        // Ajax以外の通信の場合
        $data = TableRegistry::get('Carts');

        try {
            $data->changeCartItemNum($json['item_id'], $sessionData, $json['num']);
        } catch (Exception $e) {
            $this->response->body(json_encode(array('code' => 404)));
            return $this->response;
        }

        $this->response->body(json_encode(array('code' => 200)));
        return $this->response;

    }

    public function logout()
    {
        $this->Session->delete('userId');
        $this->response->type('json');
        $this->response->body(json_encode(array('code' => 200)));
        return $this->response;
    }

    public function buy()
    {
        $sessionData = $this->Session->read('userId');
        $dataCarts = TableRegistry::get('Carts');

        // カウント取得
        $dataCartsCount = $dataCarts->cartCount($sessionData);

        error_log($dataCartsCount[0]['sum'], 3, 'img/app.log');
        $dataOrders = TableRegistry::get('Orders');
        $dataOrders->insert($sessionData,$dataCartsCount);
        $dataCarts->deleteCart($sessionData);


        $this->response->type('json');
        $this->response->body(json_encode(array('code' => 200)));
        return $this->response;
    }
}