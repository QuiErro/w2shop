<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods_model extends CI_Model {
    // 表名
    private $mytable = 'goods';

    // 增加商品
    public function add_good($arr) {
        return $this->db->insert($this->mytable, $arr);
    }

    // 上/下架商品
    public function sale($gid) {
        $res = $this->info($gid);
        if (empty($res)) error('不存在该商品');
        $status = $res['is_onsale'];
        $this->change($gid, array('is_onsale' => !$status));
    }

    // 修改商品信息
    public function change($id, $arr) {
        $this->db->where('goods_id', $id);
        $res = $this->db->update($this->mytable, $arr);
        return $res;
    }

    // 商品信息
    public function info($gid) {
        $res = $this->db->get_where($this->mytable, array('goods_id' => $gid))->result_array();
        return $res[0];
    }

    // 根据商品名模糊搜索
    public function find($name) {
        $this->db->like('goods_name', $name);
        $this->db->from('goods');
        $res = $this->db->get()->result_array();
        return $res;
    }
}
