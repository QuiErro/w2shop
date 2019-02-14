<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: wywwzjj
 * Date: 2019/2/4
 * Time: 11:29
 */

class Main extends Admin_Controller {
    // 展示后台首页
    public function index() {
        $this->load->view('admin/test.html');
    }

    public function url() {
        echo base_url() . 'public/css';
    }

    public function top() {
        $this->load->view('admin/top.html');
    }

    public function menu(){
        $this->load->view("admin/menu.html");
    }

    public function drag(){
        $this->load->view("admin/drag.html");
    }

    public function content(){
        $this->load->view("admim/main.html");
    }
}
