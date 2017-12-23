<?php

/**
 * @Author				: dzy
 * @QQ    				: 1069288356
 * @Date  				: 2017-12-13 13:09:48
 * @Last Modified by	: dzy
 * @Last Modified time	: 2017-12-21 11:21:04
 */
namespace app\admin\controller;
use think\Controller;

class Articles extends Base
{
	protected $category;
	function __construct(){
		parent::__construct();
		$this->category = db('articles_category')->select();
	}
    public function index()
    {
    	$article_list = db('articles')->order('createtime','desc')->select();
        return $this->fetch('index',[
        	'category'		=>	$this->category,
        	'article_list'	=>	$article_list,
            'set'           =>  $this->setting
        ]);
    }
    public function form($id)
    {

    	$data = array();
    	if(!empty($id)){
    		$article = db('articles')->where('id',$id)->find();
    		$data['article'] = $article;
    	}
    	$data['category'] = $this->category;
        $data['set'] = $this->setting;
    	if(request()->isPost()){
    		$insert = array();
    		$insert['title'] = input('post.title');
			$insert['author'] = input('post.author');
			$insert['category'] = input('post.category');
			$insert['abstract'] = input('post.abstract');
			$insert['content'] = input('post.content');
			$insert['is_hide'] = !empty(input('post.is_hide')) ? 1 : 0;
			if(empty($id)){
				$insert['createtime'] = time();
				$file = request()->file('illustration');
				if(empty($file)){
					show_message(0,'图片不能为空！');
					return $this->fetch('form',$data);
				}
				$img_url = $this->upload($file);
				if(empty($img_url)){
					show_message(0,'上传图片失败！');
					return $this->fetch('form',$data);
				}
				$insert['illustration'] = $img_url;
				db('articles')->insert($insert);
				show_message(1,'添加成功！',url('/articlelist'));
			}else{
				$file = request()->file('illustration');
				if(!empty($file)){
					$img_url = $this->upload($file);
					if(empty($img_url)){
						show_message(0,'上传图片失败！');
						return $this->fetch('form',$data);
					}
                    $image = \think\Image::open(ROOT_PATH.'wwwroot'.$img_url);
                    $image->thumb(333,150,\think\Image::THUMB_FIXED)->text('@碎念博客','simkai.ttf',10,'#FFFFFF')->save('.'.$img_url);
					$insert['illustration'] = $img_url;
				}
                @unlink('.'.$article['illustration']);
				db('articles')->where('id',$id)->update($insert);
				show_message(1,'更新成功！',url('/articlelist'));				
			}
    	}
        return $this->fetch('form',$data);
    }
    public function upload($file)
    {
        $config = [
            'size' => 5097152,
            'ext'  => 'jpg,gif,png,bmp,txt,zip'
        ];
        $upload_path = str_replace('\\', '/', ROOT_PATH . 'wwwroot/uploads/article');
        $save_path   = '/uploads/article/';
        $info        = $file->validate($config)->move($upload_path);

        if ($info) {
            $result = str_replace('\\', '/', $save_path . $info->getSaveName());
        } else {
            $result = '';
        }

        return $result;
    }
    public function is_hide(){
    	$id = input('post.id');
    	$item = db('articles')->where('id',$id)->find();
    	if(empty($item['is_hide'])){
    		db('articles')->where('id',$id)->update(['is_hide'=>1]);
    	}else{
    		db('articles')->where('id',$id)->update(['is_hide'=>0]);
    	}
    	return show_json(1);
    }
    public function del(){
        $id = input('post.id');
        $item = db('articles')->where('id',$id)->find();
        if(empty($item)){
            return show_json(0,'文章不存在！');
        }
        @unlink('.'.$item['illustration']);
        db('articles')->where('id',$id)->delete();        
        return show_json(1);
    }
    
    
   
}