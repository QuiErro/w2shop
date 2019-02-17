<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
    public function page() {
        $perPage = 10;
        $this->load->library('pagination');
        $config['base_url'] = site_url('Pages/page');
        $config['total_rows'] = $this->db->count_all_results('goods');
        //配置项设置
        $config['per_page'] = $perPage;
        //自定义配置
        $config['first_link'] = "首页";
        $config['prev_link'] = "上一页";
        $config['next_link'] = "下一页";
        $config['last_link'] = "尾页";
        //传入配置项，并生成链接
        $this->pagination->initialize($config);
        $data['links'] = $this->pagination->create_links();
        //设置偏移量
        $offset = $this->uri->segment(3);
        $this->db->limit($perPage, $offset);
        //加载模型类和视图
        $this->load->model("page_model", "page");
        $data['user'] = $this->page->get_page();
        $this->load->view("pages/page.html", $data);
    }
}
