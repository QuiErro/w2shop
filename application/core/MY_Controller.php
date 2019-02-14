<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 定义前台总控制器
class Home_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // 开启皮肤
        // $this->load->switch_themes_on();
    }
}

// 后台总控制器
class Admin_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // 无登录则无权限进后台
        $username = $this->session->userdata['username'];
        $isadmin = $this->session->userdata['isadmin'];
        if (!$isadmin || !$username)
            redirect(site_url('admin/login'));

        // 关闭皮肤
        // $this->load->switch_themes_off();
    }
}