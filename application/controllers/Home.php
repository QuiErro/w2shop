<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 商城主页
 */

class Home extends CI_Controller {

    public function index() {
        $this->load->view('index.html');
    }
}