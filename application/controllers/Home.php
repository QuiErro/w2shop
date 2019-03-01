<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 商城主页
 */

class Home extends CI_Controller {

    public function index() {
        $this->load->model('Category_model', 'cate');
        $this->load->library('cart');
        $cate = $this->cate->cates();
        $data['cates'] = self::unlimitedForLayer($cate);
        $data['nums'] = $this->cart->total_items();
        $this->load->view('index.html', $data);
    }

    Static private function unlimitedForLayer($cate, $name = 'child', $pid = 0) {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['pid'] == $pid) {
                $v[$name] = self::unlimitedForLayer($cate, $name, $v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }
}