<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
    // 返回所有分类
    public function cates() {
        $this->db->select('cat_id id, parent_id pid, cat_name name');
        $this->db->from('category');
        return $this->db->get()->result_array();
    }

    // 根据 cat_id 返回此类商品信息
    public function channel($cid, $id_arr) {
        $this->db->where('cat_id', $cid);
        foreach ($id_arr as $id) {
            $this->db->or_where('cat_id', $id);
        }
        // 返回商品
        $this->db->from('goods');
        return $this->db->get()->result_array();
    }

    // 根据 cat_id 返回分类信息
    public function cate($cid) {
        $this->db->where('cat_id', $cid);
        $this->db->from('category');
        $res = $this->db->get()->result_array();
        return $res;
    }

    // 返回顶级分类信息
    public function big_cates() {
        $this->db->where('parent_id', 0);
        $this->db->from('category');
        $res = $this->db->get()->result_array();
        return $res;
    }
}