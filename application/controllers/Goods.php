<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *  商品详情页
 */

class Goods extends CI_Controller {
    public function item() {
        $this->load->model('Goods_model', 'good');

        $id = $this->input->get('id');
        $data['info'] = $this->good->info($id);
        if (empty($data['info']))
            error('该商品不存在');
        $this->load->view('pro_show.html', $data);
    }
}