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
        $this->load->view('search.html');
        $keword = $this->input->get('keyword');
//        p($keword);
    }

    // 购物车
    public function bag() {
        $gid = $this->input->get('gid');

        if (!isset($_SESSION)) {
            session_start();
        }

        $this->load->model('User_model', 'user');
//        $this->user->
        $_SESSION['shopingbag'][$gid] = '';
    }
}

