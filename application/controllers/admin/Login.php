<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: wywwzjj
 * Date: 2019/2/4
 * Time: 19:09
 */
class Login extends CI_Controller {
    public function index() {
//        $set = array("a", "A", "b", "B", "c", "C", "d", "D", "e", "E", "f", "F",
//                     "g", "G", "h", "H", "i", "I", "j", "J", "k", "K", "l", "L",
//                     "m", "M", "n", "N", "o", "O", "p", "P", "q", "Q", "r", "R",
//                     "s", "S", "t", "T", "u", "U", "v", "V", "w", "W", "x", "X",
//                     "y", "Y", "z", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9");
//
//        $str = '';
//        for ($i = 1; $i <= 4; ++$i) {
//            $ch = mt_rand(0, count($set) - 1);
//            $str .= $set[$ch];
//        }
//
//        $vals = array(
////            'word' => 'Random word',
//            'word' => $str,
//            'expiration' => 60,
//            'img_path' => 'public/captcha/',
//            'img_url' => base_url('public/captcha/'),
//            'weight' => 80,
//            'height' => 50,
//            'word_length' => 6
//        );
//        $cap = create_captcha($vals);
//        $data['captcha'] = $cap['image'];
////        p($data);
//        $this->load->view('admin/login.html', $data);

      // 已登录则跳转
        if (isset($this->session->userdata['isadmin']))
            success('admin/main', '您已登录，无需重复登录!');
        else
             $this->load->view('admin/login.html');
    }

    public function code() {
        $config = array(
            'width' => 150,
            'height' => 40,
            'codeLen' => 4,
            'fontSize' => 20
        );
        $this->load->library('code', $config);

        $this->code->show();
    }

    public function signin() {
        // 客户端表单验证
        $this->load->model('User_model', 'user');
        $res = $this->user->info('admin');
        p($res);
        p($res[0]['password']);
    }

    /**
     * 登陆
     */
    public function login_in() {

        $username = $this->input->post('admin_name');
        $passwd = $this->input->post('admin_pass');
        $code = $this->input->post('admin_captcha');

        if (strtoupper($code) != $_SESSION['code']) error('验证码错误');

        $this->load->model('User_model', 'user');
        $userData = $this->user->info(array('username' => $username));

        if (!$userData || $userData[0]['password'] !== md5($passwd) || !$userData[0]['isadmin']) error('用户名或者密码不正确');

        $sessionData = array(
            'aid' => $userData[0]['id'],
            'aname' => $username,
            'isadmin' => $userData[0]['isadmin'],
            'alogintime' => time()
        );

        $this->session->set_userdata($sessionData);

        redirect(site_url('admin/main'));
//        success('admin/main/index', '登陆成功');
    }


    /**
     * 退出登陆
     */
    public function login_out() {
        $this->session->sess_destroy();
        success('admin/login', '退出成功');
    }
}
