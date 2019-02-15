<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 购物车
 */

class Cart extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('cart');
    }

    public function index() {
        $data['content'] = $this->cart->contents();
        $this->load->view('shoppingBag.html', $data);
    }

    public function add_cart() {
        $arr = array();
    }

    public function del_cart() {

    }

    public function ch_cart() {

    }
}
