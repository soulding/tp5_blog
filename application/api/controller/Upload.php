<?php

/**
 * @Author				: dzy
 * @QQ    				: 1069288356
 * @Date  				: 2017-12-13 21:27:36
 * @Last Modified by	: dzy
 * @Last Modified time	: 2017-12-13 21:36:28
 */
use think\Controller;
use think\Session;

/**
 * 通用上传接口
 * Class Upload
 * @package app\api\controller
 */
class Upload extends Controller
{
	function __construct(){
		check_login(session('id'));
	}
    /**
     * 通用图片上传接口
     * @return \think\response\Json
     */
    public function upload()
    {
        $config = [
            'size' => 2097152,
            'ext'  => 'jpg,gif,png,bmp,txt,zip'
        ];
        $file = $this->request->file('file');
        $upload_path = str_replace('\\', '/', ROOT_PATH . 'wwwroot/uploads');
        $save_path   = '/uploads/';
        $info        = $file->validate($config)->move($upload_path);

        if ($info) {
            $result = [
                'error' => 0,
                'url'   => str_replace('\\', '/', $save_path . $info->getSaveName())
            ];
        } else {
            $result = [
                'error'   => 1,
                'message' => $file->getError()
            ];
        }

        return json($result);
    }
}