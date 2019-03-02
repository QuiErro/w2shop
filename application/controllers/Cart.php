<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 购物车
 */

class Cart extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('Goods_model', 'goods');
    }

    // 附带删除
    public function index() {
        // 若传来 rid 则直接删除
        $rowid = $this->input->get('rid');
        if (!empty($rowid))
            $this->cart->remove($rowid);
        $data['contents'] = $this->cart->contents();
        $this->load->view('shoppingBag.html', $data);
    }

    // 添加购物车
    // TODO: 有些商品加不进去，比如 gid=7
    public function add_cart() {
        $gid = $this->input->get('gid');
        $info = $this->goods->info($gid);

        $data['result'] = array(
            'id' => $info['goods_id'],
            'qty' => 1,
            'price' => $info['shop_price'],
            'name' => $info['goods_name'],
            'img' => $info['goods_thumb'],
            'desc' => $info['']
        );

        $this->cart->insert($data['result']);
        // 中转界面
        $this->load->view('cart_tmp.html', $data);
    }

    // 修改购物车
    public function ch_cart() {

    }
}