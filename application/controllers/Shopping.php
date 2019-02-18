<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 购物车
 */

class Shopping extends CI_Controller {
    public function index() {
        $this->load->view('shoppingBag.html');
    }

    public function search() {
        $this->load->model('Goods_model', 'goods');
        $keword = $this->input->get('keyword');
        $data['result'] = $this->goods->find($keword);

        $total = count($data['result']);

        // 分页配置项
        $perPage = 1;
        $config['base_url'] = site_url('shopping/search');
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