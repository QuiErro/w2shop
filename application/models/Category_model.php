<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
    // 返回所有分类
    public function cates() {
        $this->db->select('cat_id id, parent_id pid, cat_name name');
        $this->db->from('category');
        return $this->db->get()->result_array();
    }

    // 根据 cat_id 返回此类商品
    public function channel($cid) {
        $this->db->where('cat_id', $cid);
        $this->db->from('goods');
        return $this->db->get()->result_array();
    }

    // 根据 cat_id 返回分类信息
    public function cate($cid) {
        $this->db->where('cat_id', $cid);
        $this->db->from('category');
        return $this->db->get()->result_array();
    }
}