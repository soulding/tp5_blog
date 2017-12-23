<?php

/**
 * @Author              : dzy
 * @QQ                  : 1069288356
 * @Date                : 2017-12-13 12:57:49
 * @Last Modified by    : dzy
 * @Last Modified time  : 2017-12-13 12:59:04
 */
namespace app\admin\controller;
use think\Controller;

class Base extends Controller
{
    protected $setting;
    function __construct()
    {
    	parent::__construct();
       	check_login(session('id'));
       	$this->setting = db('sysset')->find();
    }
}
