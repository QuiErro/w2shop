<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Goods_model', 'goods');
    }

    // 展示后台首页
    public function index() {
//        $search_id = $this->input->post('gid');
//        if (!empty($search_id)) {
//            $data['goods'] = $this->goods->info($search_id);
//            p($data);
//            $this->load->view('admin/test.html', $data);
//        }
        //配置项设置
        $perPage = 6;
        $config['base_url'] = site_url('admin/main/index');
        $config['total_rows'] = $this->db->count_all_results('goods');
        $config['per_page'] = $perPage;
        $config['uri_segment'] = 4;
        $config['first_link'] = '首页';
        $config['prev_link'] = '«';
        $config['next_link'] = '»';
        $config['last_link'] = '尾页';
//        $config['attributes'] = array('class' => 'pag_a');

        $this->load->library('pagination', $config);

        $data['links'] = $this->pagination->create_links();
        $offset = $this->uri->segment(4);
        $this->db->limit($perPage, $offset);

        $data['goods'] = $this->goods->read();

        $this->load->view('admin/test.html', $data);
    }

    // 增加新的商品
    public function add() {
        // 主图配置
        $config['upload_path'] = './public/uploads';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = time() . mt_rand(1000, 9999);
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);
        // 上传
        if (!$this->upload->do_upload('add_img')) {
            error($this->upload->display_errors());
        }

        $info = $this->upload->data();

        /*
        // TODO：生成缩略图
        You must specify a source image in your preferences.
        $config_['source_img'] = $info['full_path'];
        $config_['create_thumb'] = TRUE;
        $config_['maintain_ratio'] = TRUE;
        $config_['new_image'] = time() . mt_rand(1000,9999) . '.jpg';
        $config_['width'] = 120;
        $config_['height'] = 120;

        // 载入图像处理类
        $this->load->library('image_lib');
        $this->image_lib->initialize($config_);
        if (!$this->image_lib->resize()) {
            p($this->image_lib->display_errors());
        }
        */

        $good = array(
            'goods_name' => $this->input->post('add_name'),
            'goods_brief' => $this->input->post('add_brief'),
            'goods_desc' => $this->input->post('add_desc'),
            'cat_id' => $this->input->post('add_class'),
            // 品牌暂缓
            'brand_id' => '',
            'market_price' => $this->input->post('add_price'),
            'shop_price' => $this->input->post('add_price'),
            'goods_img' => $info['file_name'],
            // 缩略图暂缓
            // 'goods_thumb' => $config_['new_image'],
            'goods_thumb' => $info['file_name'],
            'goods_number' => $this->input->post('add_count'),
            'add_time' => date('Y-m-d H:i:s', time())
        );
        $status = $this->goods->add_good($good);
        if ($status) success('admin/main', '添加成功');
        else error('失败');
    }

    // 更新商品信息
    public function change() {
        $gid = $this->input->post('adapt_id');
        $sale = $this->input->post('adapt_select');
        $good = array(
            'goods_name' => $this->input->post('adapt_name'),
            'goods_brief' => $this->input->post('adapt_brief'),
            'goods_desc' => $this->input->post('adapt_desc'),
            'cat_id' => $this->input->post('adapt_class'),
            // 品牌暂缓
            'brand_id' => '',
            'market_price' => $this->input->post('adapt_price'),
            /* TODO: 图片修改
            'shop_price' => $this->input->post('adaptadd_price'),
            'goods_img' => $info['file_name'],
            'goods_thumb' => $info['file_name'],
            */
            'is_onsale' => ($sale === '上架' ? 1 : 0),
            'goods_number' => $this->input->post('adapt_count'),
        );
        if ($this->goods->change($gid, $good)) {
            success('admin/main', '修改商品信息成功');
        } else {
            error('修改失败');
        }
    }

    // 删除商品
    public function del() {
        $gid = $this->input->post('select');
        $this->goods->del($gid);
    }
}
