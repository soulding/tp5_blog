<?php

/**
 * @Author				: dzy
 * @QQ    				: 1069288356
 * @Date  				: 2017-12-18 16:04:39
 * @Last Modified by	: dzy
 * @Last Modified time	: 2017-12-18 17:24:34
 */
namespace app\index\controller;
class Error extends Base
{
	protected $category;
    function __construct(){
        parent::__construct();
        $this->category = db('articles_category')->order('sort','desc')->select();
    }
	public function index(){
		return $this->fetch('index',[
            'category'      =>  $this->category,
            'set'           => $this->setting 
        ]);
	}
}