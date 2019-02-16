<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Admin_Controller {
    // 展示后台首页
    public function index() {
        $this->load->view('admin/test.html');
    }
}
