<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 购物车
 */

class Cart extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('cart');
    }

    public function index() {
        $this->load->helper('form');
       $this->load->view('cart');
    }
}
