<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
    // 返回所有分类
    public function cate() {
        $this->db->select('cat_id id, parent_id pid, cat_name name');
        $this->db->from('category');
        return $this->db->get()->result_array();
    }
}