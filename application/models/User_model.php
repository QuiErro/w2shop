<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    // 添加用户
    public function add_user($arr) {
        $res = $this->db->insert('users', $arr);
        return $res;
    }

    // 查询用户信息
    public function info($arr) {
        $arr = $this->db->get_where('users', $arr)->result_array();
//        p($arr);
        return $arr;
    }
}