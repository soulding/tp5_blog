<?php

/**
 * @Author				: dzy
 * @QQ    				: 1069288356
 * @Date  				: 2017-12-14 10:38:39
 * @Last Modified by	: dzy
 * @Last Modified time	: 2017-12-14 16:21:50
 */
namespace app\index\controller;
use think\Controller;

class Base extends Controller
{
    protected $setting;
    function __construct()
    {
    	parent::__construct();
    	$this->setting = db('sysset')->find();
    }
}
