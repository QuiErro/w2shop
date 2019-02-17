<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 购物车
 */

class Shopping extends CI_Controller {
    public function index() {
        $this->load->view('shoppingBag.html');
    }

    public function search() {
        $this->load->model('Goods_model', 'goods');
        $keword = $this->input->get('keyword');
        $data['result'] = $this->goods->find($keword);
        $this->load->view('search.html', $data);
    }
}