<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * 购物车控制器
 */

class Cart_ extends Home_Controller {
    private $info = array();    #前台提交数据
    private $specData = array();  #规格信息
    private $prodData = array();  #货品组合信息
    private $cartData = array();  #购物车入库数据

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('goodsModel', 'goods');
        $this->load->model('productModel', 'product');
        $this->load->model('goodsAttrModel', 'goodsAttr');
    }

    /**
     * [购物车]数据添加
     */
    public function cartAdd() {
        #接收购物车提交数据
        $this->info = $this->input->post();
        // $this->ajaxReturn($this->info);
        #1.验证商品库存、货品库存
        $this->checkGoodsNumber();
        #2.查询规格名称、价格
        $this->getSpecData();
        #3.组装购物车添加de数据
        $cartData = $this->setCartData();
        p(json_decode($this->input->cookie('cart'), true));
        # 一、判断是否登录
        if (!UID) {
            //未登录 数据存入Cookie中
            //1:获取cookie中的购物车数据
            $cookieCartData = $this->input->cookie('cart');
            //2:判断cookie中数据是否为空
            if (empty($cookieCartData)) {
                //2-1:为空则表示用户没有添加过购物车
                //2-1-1.设置Key-->生成购物车数据
                $key = $cartData['goods_id'] . '-' . $cartData['product_id'];
                $cookieCart = array($key => $cartData);
                //2-1-2.设置购物车返回值(商品数量、总价)
                $this->setCartReturn(1, $cartData['goods_price']);
                //2-1-3.设置Cookie存储购物车数据
            } else {
                //2-2:不为空 表示用户添加过购物车
                //2-2-1.追加购物数据
                $cookieCart = $this->addCartData($cartData, json_decode($cookieCartData, true));
                //2-2-2.设置购物车返回值(商品数量、总价)
                $this->setCartReturn(count($cookieCart), array_sum(array_column($cookieCart, 'goods_price')));
            }
            //3:设置Cookie存储购物车数据
            setCookie('cart', json_encode($cookieCart), LEFT_TIME, '/');
        } else {
            //已登录 数据存入数据库
        }
        //返回购物车提示数据
        $this->ajaxReturn($this->msg);
    }

    /**
     * 验证商品库存
     */
    public function checkGoodsNumber() {
        $this->goods->map = array(
            'goods_id' => $this->info['goods_id'],
            'goods_number >=' => $this->info['buy_number'],
        );
        $this->goods = $this->goods->find('goods_id,goods_name,goods_sn,goods_img,shop_price');
        if (!$this->goods) {
            $this->msg['msg'] = "商品库存不足";
            $this->ajaxReturn($this->msg);
        }
        #验证货品库存
        $this->product->map = array(
            'goods_id' => $this->info['goods_id'],
            'product_attr' => $this->info['prod_attr'],
            'product_number >=' => $this->info['buy_number'],
        );
        $this->prodData = $this->product->find();
        if (!$this->prodData) {
            $this->msg['msg'] = "货品库存不足";
            $this->ajaxReturn($this->msg);
        }
        return true;
    }

    /**
     * 组合规格名称、价格
     */
    public function getSpecData() {
        $this->goodsAttr->map = inToType(explode("|", $this->info['prod_attr']), 'goods_attr_id');
        $goodsAttrInfo = $this->goodsAttr->select('goods_attr_value,goods_attr_price');
        $this->specData['product_attr_value'] = implode("|", array_column($goodsAttrInfo, 'goods_attr_value'));
        $this->specData['product_price'] = array_sum(array_column($goodsAttrInfo, 'goods_attr_price'));
        # 返回规格信息 $this->specData
    }

    /**
     * 组装购物车添加的数组
     */
    public function setCartData() {
        $this->cartData = array(
            'product_id' => $this->prodData['product_id'],
            'product_attr' => $this->prodData['product_attr'],
            'buy_number' => $this->info['buy_number'],
            'goods_price' => $this->info['shop_price'],
            'goods_sum' => $this->info['shop_price'] * $this->info['buy_number'],
            'product_price' => '',
            'product_attr_value' => '',
            'uid' => UID,
        );
        $this->cartData = array_merge($this->cartData, $this->goods);
        #若存在规格【添加规格信息】
        if (!empty($this->info['prod_attr'])) {
            $this->cartData['product_price'] = $this->specData['product_price'];
            $this->cartData['product_attr_value'] = $this->specData['product_attr_value'];
        }
        return $this->cartData;
        # 购物车 添加的总数据 $this->cartData;
    }

    /**
     * 设置购物车返回提示数据
     * @param [商品数量,总价]
     */
    public function setCartReturn($number, $prices) {
        $this->msg['code'] = self::STATUS_ON;
        $this->msg['data'] = array(
            'number' => $number,
            'prices' => $prices,
        );
    }

    /**
     * 购物车 新添加数据
     * @param [新数据,原购物车数据]
     */
    public function addCartData($newData, $oldData) {
        #组合Key
        $key = $newData['goods_id'] . '-' . $newData['product_id'];
        // #判断购物车中是否有该商品
        if (isset($oldData[$key])) {
            //1.有 合并商品数量、价格
            $oldData[$key]['buy_number'] = $oldData[$key]['buy_number'] + $newData['buy_number'];
            $oldData[$key]['goods_price'] = $newData['goods_price'];
            $oldData[$key]['goods_sum'] = $oldData[$key]['buy_number'] * $oldData[$key]['goods_price'];
        } else {
            //2.没有 追加新商品
            $oldData[$key] = $newData;
        }
        #返回购物车数据
        return $oldData;
    }
}
