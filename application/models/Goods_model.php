<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods_model extends CI_Model {
    // 表名
    private $mytable = 'goods';

    // 增加商品
    public function add_good($arr) {
        return $this->db->insert($arr);
    }

    // 下架商品
    public function del_good($gid) {

    }

    // 修改商品信息
    public function change() {

    }

    // 商品信息
    public function info($gid) {
        $res = $this->db->get_where($this->mytable, array('goods_id' => $gid))->result_array();
        return $res[0];
    }
}
