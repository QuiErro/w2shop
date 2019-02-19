<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 商品分类
 */

class Category extends CI_Controller {

    public function __construct() {
        // $this->isNeedLogin = TRUE;
        parent::__construct();
        $this->load->model('Category_model', 'cate');
    }

    /**
     * 将数据格式化成树形结构
     * @author Xuefen.Tong
     * @param array $items
     * @return array
     */
    public function genTree9($items) {
        $tree = array(); //格式化好的树
        foreach ($items as $item)
            if (isset($items[$item['pid']]))
                $items[$item['pid']]['son'][] = &$items[$item['id']];
            else
                $tree[] = &$items[$item['id']];
        return $tree;
    }

    public function getList() {
        $cate = $this->cate->cate();
        return $cate;
//        print_r(Category::unlimitedForLevel($cate));
//        print_r(Category::unlimitedForLayer($this->items));
//        print_r(Category::getParents($cate, 0));
//        print_r(Category::getChildsId($cate, 2));
//        print_r(Category::getChilds($cate, 2));
    }

    //组合一维数组
    Static Public function unlimitedForLevel($cate, $html = '--', $pid = 0, $level = 0) {
        $arr = array();
        foreach ($cate as $k => $v) {
            if ($v['pid'] == $pid) {
                $v['level'] = $level + 1;
                $v['html'] = str_repeat($html, $level);
                $arr[] = $v;
                $arr = array_merge($arr, self::unlimitedForLevel($cate, $html, $v['id'], $level + 1));
            }
        }
        return $arr;
    }

    //组合多维数组
    Static Public function unlimitedForLayer($cate, $name = 'child', $pid = 0) {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['pid'] == $pid) {
                $v[$name] = self::unlimitedForLayer($cate, $name, $v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }

    //传递一个子分类ID返回所有的父级分类
    Static Public function getParents($cate, $id) {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['pid'] == $id) {
                $arr[] = $v;
                $arr = array_merge(self::getParents($cate, $v['pid']), $arr);
            }
        }
        return $arr;
    }

    //传递一个父级分类ID返回所有子分类ID
    Static Public function getChildsId($cate, $pid) {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['pid'] == $pid) {
                $arr[] = $v['id'];
                $arr = array_merge($arr, self::getChildsId($cate, $v['id']));
            }
        }
        return $arr;
    }

    //传递一个父级分类ID返回所有子分类
    Static Public function getChilds($cate, $pid) {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['pid'] == $pid) {
                $arr[] = $v;
                $arr = array_merge($arr, self::getChilds($cate, $v['id']));
            }
        }
        return $arr;
    }

    public function getLst(&$result = array(), $pid = 0, $spac = 0) {
        $spac = $spac + 4;
        foreach ($this->getList() as $value) {
            if ($value['pid'] == $pid) {
                $value['type'] = str_repeat(' ', $spac) . "|--" . $value['type'];
                $result[] = $value;
                $this->getLst($result, $value['id'], $spac);
            }
        }
        return $result;
    }

    public function test() {
        $arr = $this->getList();
        $res = self::getLst();
        p($res);
    }
}