<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Good_model extends CI_Model {
    // 增加商品
    public function add_good($arr) {

    }

    // 下架商品
    public function del_good($gid) {

    }

    // 商品信息
    public function info($gid) {
        $res = $this->db->get_where('goods', array('goods_id' => $gid))->result_array();
        return $res;
    }
}
