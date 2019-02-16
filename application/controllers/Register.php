<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
    public function index() {
        $this->load->view('register.html');
    }

    // 注册用户
    public function reg() {
        $this->load->model('User_model', 'user');

        $data = array(
            'username' => $this->input->post('reg_name'),
            'password' => md5($this->input->post('reg_pass')),
            'email' => $this->input->post('reg_email'),
            'reg_time' => date("Y-m-d H:i:s", time())
        );

        $name_isexist = $this->user->info(array('username' => $data['username']));
        $email_isexist = $this->user->info(array('email' => $data['email']));

        if ($name_isexist) {
            error('注册失败，用户名已存在');
        } else if ($email_isexist) {
            error('注册失败，邮箱已被使用');
        } else if ($this->user->add_user($data)) {
            success('login', '注册成功，前往登录');
        }
    }
}