<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model', 'user');
    }

    public function index() {
        // 已登录则跳转
        $islogin = empty($_SESSION['isuser']) or 1;
        if ($islogin === 0)
            success('Home', '您已登录，无需重复登录!');
        else
            $this->load->view('login.html');
    }

    public function signin() {
        // 客户端表单验证
        $res = $this->user->info('admin');
        p($res);
        p($res[0]['password']);
    }

    /**
     * 登陆
     */
    public function login_in() {

        $username = $this->input->post('log_name');
        $passwd = $this->input->post('log_pass');

        if (!isset($_SESSION)) {
            session_start();
            error('SESSION开启');
        }

        $userData = $this->user->info(array('username' => $username));

        if (!$userData || $userData[0]['password'] !== md5($passwd)) error('用户名或者密码不正确');

        $sessionData = array(
            'uid' => $userData[0]['id'],
            'uname' => $username,
            'ulogintime' => time(),
            'isuser' => 1
        );

        $this->session->set_userdata($sessionData);

        redirect(site_url(''));
    }


    /**
     * 退出登陆
     */
    public function login_out() {
        $this->session->sess_destroy();
        success('', '注销成功');
    }
}