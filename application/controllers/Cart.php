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

    public function index() {
        $data['contents'] = $this->cart->contents();
        $this->load->view('shoppingBag.html', $data);
    }

    public function add_cart() {
        $gid = $this->input->get('gid');
        $info = $this->goods->info($gid);

        $data = array(
            'id' => $info['goods_id'],
            'qty' => 1,
            'price' => $info['shop_price'],
            'name' => $info['goods_name'],
            'img' => $info['goods_thumb']
        );

        $this->cart->insert($data);
        redirect(site_url('cart'));
    }

    public function del_cart() {

    }

    public function ch_cart() {

    }
}