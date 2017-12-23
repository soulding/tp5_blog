<?php

/**
 * @Author				: dzy
 * @QQ    				: 1069288356
 * @Date  				: 2017-12-12 22:38:58
 * @Last Modified by	: dzy
 * @Last Modified time	: 2017-12-14 18:30:11
 */

namespace app\admin\controller;
use think\Controller;
class User extends Controller
{
	public function login(){
		if(request()->isAjax()){
			
			$data = input('post.');
			if(empty($data['name']) || empty($data['pwd'])){
				return show_json(0,'不要搞事情哦！');
			}
			$user = db('admin')->where('name',$data['name'])->find();
			if(empty($user)){
				return show_json(0,'不要搞事情哦！');
			}
			if (md5($data['pwd'] . $user['salt']) !== $user['pwd']) {
				return show_json(0, '用户或密码错误');
			}
			set_login($user);
			return show_json(2,url('/admin'));
		}
		return $this->fetch('login');
	}
	public function login_out(){
		cookie('SESSIONID',null);
		session(null);
		header('location: ' . url('/login'));
	}
}

