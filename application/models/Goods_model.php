<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods_model extends CI_Model {
    // 表名
    private $mytable = 'goods';

    // 增加商品
    public function add_good($arr) {
        return $this->db->insert($this->mytable, $arr);
    }

    // 修改商品信息
    public function change($id, $arr) {
        $this->db->where('goods_id', $id);
        $res = $this->db->update($this->mytable, $arr);
        return $res;
    }

    // 由 gid 查询商品信息
    public function info($gid) {
        $res = $this->db->get_where($this->mytable, array('goods_id' => $gid))->result_array();
        return is_array($res) ? $res[0] : 0;
    }

    // 显示所有商品
    public function read() {
        $this->db->join('category', 'category.cat_id = goods.cat_id', 'left');
        return $this->db->get($this->mytable)->result_array();
    }

    // 根据商品名模糊搜索
    public function find($name) {
        $this->db->like('goods_name', $name);
        $this->db->from('goods');
        $res = $this->db->get()->result_array();
        return $res;
    }

    /*
     * 根据 gid 删除商品
     * 删除成功返回 0，不成功的返回 gid
     */
    public function del($arr) {
        foreach ($arr as $a) {
            if (self::info($a) !== 0 ) {  // 如果存在此商品才删
                $this->db->delete($this->mytable, array('goods_id' => $a));
            } else {
                return $a;
            }
        }
        return 0;
    }
}
