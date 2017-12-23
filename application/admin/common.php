<?php
// 应用公共文件

function set_login($user)
{
	if (!empty($user)) {
		$content = md5($user['pwd'] . $user['id']);
		$key = 'SESSIONID';
		$cookie = base64_encode(json_encode($content));
		session('id',$user['id']);
		session('name',$user['name']);
		cookie($key,$cookie);
	}
}

function check_login($id){
	$user = db('admin')->where('id',$id)->find();
	$content = md5($user['pwd'] . $user['id']);
	$key = 'SESSIONID';
	$cookie = base64_encode(json_encode($content));
	if(cookie($key) === $cookie && session('id') === $id){
		return true;
	}
	session(null);
	cookie($key,null);
	header('location: ' . url('/login'));
	exit;
}

function show_message($status = 1,$msg = NULL,$url = null){
	if($status == 0){
		echo "<script>window.onload=function(){layer.msg('".$msg."')}</script>";
	}else{
		echo "<script>window.onload=function(){layer.msg('".$msg."',function(){location.href='".$url."'})}</script>";
	}

	
}