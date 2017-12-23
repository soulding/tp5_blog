<?php

/**
 * @Author              : dzy
 * @QQ                  : 1069288356
 * @Date                : 2017-11-24 16:00:28
 * @Last Modified by    : dzy
 * @Last Modified time  : 2017-12-13 12:39:20
 */
namespace app\admin\controller;
class Index extends Base
{
	function __construct(){
		parent::__construct();
	}
    public function index()
    {

       
    /*$salt = 'random(16)';
        $data = array('name' => 'gmdns', 'pwd' => md5('guomuApps.2015'.$salt), 'salt' => $salt);
    	db('admin')->insert($data);*/
        return $this->fetch('index',['set'=>$this->setting]);
    }
    
    
   
}