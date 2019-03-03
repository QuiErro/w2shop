<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 搜索页
 */

class Shopping extends CI_Controller {

    public function search() {
        $this->load->model('Goods_model', 'goods');

        /*
        * TODO 搜索页添加顶级分类
        $this->load->model('Category_model', 'cate');
        $data['cates'] = $this->cate->big_cates();  // 返回顶级分类信息
        */

        $keyword = $this->input->get('keyword');
        $data['keyword'] = $keyword;
        $result = $this->goods->find($keyword);

        $total = count($result);

        // 分页配置项
        $perPage = 12;
        $config['base_url'] = site_url('shopping/search/');
        $config['total_rows'] = $total;
        $config['per_page'] = $perPage;
        $config['uri_segment'] = 3;
        $config['first_link'] = '首页';
        $config['prev_link'] = '«';
        $config['next_link'] = '»';
        $config['last_link'] = '尾页';

        $this->load->library('pagination', $config);

        $data['links'] = $this->pagination->create_links();
        $offset = $this->uri->segment(3);

        $this->db->limit($perPage, $offset);

        $data['result'] = $this->goods->find($keyword);

        $this->load->view('search.html', $data);
    }
}