<?php

/**
 * @Author				: dzy
 * @QQ    				: 1069288356
 * @Date  				: 2017-08-25 10:46:46
 * @Last Modified by	: dzy
 * @Last Modified time	: 2017-12-12 23:35:15
 */
// 应用公共函数
/**
 * [getip 获取客户端IP]
 * @return [type] [ip地址]
 */
function getip()
{
    static $ip = '';
    $ip = $_SERVER['REMOTE_ADDR'];
    if(isset($_SERVER['HTTP_CDN_SRC_IP'])) {
        $ip = $_SERVER['HTTP_CDN_SRC_IP'];
    } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
        foreach ($matches[0] AS $xip) {
            if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                $ip = $xip;
                break;
            }
        }
    }
    return $ip;
}
/**
 * [show_json 返回json数据]
 * @param  integer $status [状态码]
 * @param  [type]  $return [描述信息]
 * @param  [type]  $data   [数据]
 * @return [type]          [json数据]
 */
function show_json($status = 0, $return = NULL, $data = NULL)
{
	return json(['status'=>$status,'msg'=>$return,'data'=>$data]);
}

/**
 * [random 生成随机字符串或数字]
 * @param  [type]  $length  [生成字符长度]
 * @param  boolean $numeric [是否生成数字字符串]
 * @return [type]           [字符串]
 */
function random($length, $numeric = FALSE)
{
	$seed = base_convert(md5(microtime() . $_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
	$seed = $numeric ? (str_replace('0', '', $seed) . '012340567890') : ($seed . 'zZ' . strtoupper($seed));
	if ($numeric) {
		$hash = '';
	} else {
		$hash = chr(rand(1, 26) + rand(0, 1) * 32 + 64);
		$length--;
	}
	$max = strlen($seed) - 1;
	for ($i = 0; $i < $length; $i++) {
		$hash .= $seed{mt_rand(0, $max)};
	}
	return $hash;
}
/**
 * [checkLogin 检测是否登陆]
 * @return [type] [跳转到登陆页]
 */
function checkLogin()
{
	if(empty(session('uid')) && empty(cookie('member_session_'))){
    $backurl = base64_encode(urlencode(request()->path()));
		header('location: ' . url('/login',array('backurl'=>$backurl)));
	}
}
 /**
  * [encrypt aes加密]
  * @param [type]     $input [要加密的数据]
  * @param [type]     $key [加密key]
  * @return [type]       [加密后的数据]
  */
 function encrypt($input, $key)
 {
  $data = openssl_encrypt($input, 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
  $data = base64_encode($data);
  return $data;
 }

 /**
  * [decrypt aes解密]
  * @param [type]     $sStr [要解密的数据]
  * @param [type]     $sKey [加密key]
  * @return [type]       [解密后的数据]
  */
function decrypt($sStr, $sKey)
 {
  $decrypted = openssl_decrypt(base64_decode($sStr),'AES-128-ECB', $sKey, OPENSSL_RAW_DATA);
  return $decrypted;
 }