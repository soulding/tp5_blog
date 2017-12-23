<?php

/**
 * @Author				: dzy
 * @QQ    				: 1069288356
 * @Date  				: 2017-12-14 15:20:03
 * @Last Modified by	: dzy
 * @Last Modified time	: 2017-12-14 16:18:38
 */
namespace app\admin\controller;
class Sysset extends Base
{
	function __construct(){
		parent::__construct();
	}
    public function index()
    {
    	$set = db('sysset')->find();
        return $this->fetch('index',['set'=>$set]);
    }
    public function post(){
    	$data = input('post.');
    	$set = db('sysset')->find();
    	if(empty($set)){
    		db('sysset')->insert($data);
    	}else{
    		db('sysset')->where('id',$set['id'])->update($data);
    	}
    	return show_json(1);
    }
    
    
   
}