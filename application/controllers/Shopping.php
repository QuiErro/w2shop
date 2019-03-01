<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 搜索页
 */

class Shopping extends CI_Controller {

    public $keyword;

    public function search() {
        $this->load->model('Goods_model', 'goods');
        $keyword = $this->input->post('keyword');
        $data['keyword'] = $keyword;
        $data['result'] = $this->goods->find($keyword);

        $total = count($data['result']);

        // 分页配置项
        $perPage = 12;
        $config['base_url'] = site_url('shopping/search?keyword=' . $keyword . 'page/');
        $config['total_rows'] = $total;
        $config['per_page'] = $perPage;
        $config['uri_segment'] = 4;
        $config['first_link'] = '首页';
        $config['prev_link'] = '«';
        $config['next_link'] = '»';
        $config['last_link'] = '尾页';

        $this->load->library('pagination', $config);

        $data['links'] = $this->pagination->create_links();
        $offset = $this->uri->segment(4);
        $this->db->limit($perPage, $offset);

        $this->load->view('search.html', $data);
    }
}