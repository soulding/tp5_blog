<?php
namespace app\index\controller;
class Index extends Base
{
    protected $category;
	protected $articleCharts;
    function __construct(){
        parent::__construct();
        $this->category = db('articles_category')->order('sort','desc')->select();
		$this->articleCharts = db('articles')->field('id,title')->order('count desc')->limit(5)->select();
    }
    public function index()
    {
        
        $categorys = $this->category;
        if(!empty(input('get.wd'))){
            $where = array('is_hide' => 0);
            $where['title'] = ['like','%'.input('get.wd').'%'];
            $searchs = db('articles')->where($where)->order('createtime','desc')->select();
            return $this->fetch('search',[
            'category'      =>  $categorys,
            'set'           => $this->setting,
            'searchs'       => $searchs,
            'article_charts'=> $this->articleCharts
        ]);
        }
        $pindex = max(1, intval(input('get.page')));
        $psize = 10;
        $total = db('articles')->count('id');
        $where = array('is_hide' => 0);
        $categoryname = trim(input('get.category'));
        if(!empty($categoryname)){
            $category = db('articles_category')->where('name',$categoryname)->find();
            if(!empty($category)){
               $total = db('articles')->where('category',$category['id'])->count('id');
               $total = empty($total) ? 1:$total;
               $where['category'] = $category['id'];
            }
        }
        if($pindex > ceil($total/$psize)){
            $pindex = ceil($total/$psize);
        }
        $article_list = db('articles')->where($where)->limit((($pindex - 1) * $psize),$psize)->order('createtime','desc')->select();

        
        $pager = pageinate($total, $pindex, $psize,$categoryname);
        foreach ($article_list as &$vo) {
           foreach($categorys as $row){
                if($vo['category'] == $row['id']){
                    $vo['category'] = $row['name'];
                }
           }
        }
        unset($vo);
        return $this->fetch('index',[
            'category'      =>  $categorys,
            'article_list'  =>  $article_list,
            'pageinate'     =>  $pager,
            'set'           => $this->setting,
            'article_charts'=> $this->articleCharts 
        ]);
    }
    public function article($id)
    {
        $data = array();
        $data['category'] = $this->category;
        $data['set'] = $this->setting;
		$data['article_charts'] = $this->articleCharts;
        if(!empty($id)){
            $article = db('articles')->where('id',$id)->find();
            foreach($data['category'] as $vo){
                if($vo['id'] == $article['category']){
                    $article['category'] = $vo['name'];
                    break;
                }
            }
            $data['article'] = $article;
            //处理下方随机文章导航
            $ids = db('articles')->where('id','neq',$id)->where('is_hide',0)->column('title','id');
            $randarticle = array();
            if(!empty($ids)){
                if(count($ids)>1){
                    $key = array_rand($ids,2);
                    $randarticle = db('articles')->where('id',$key[0])->whereor('id',$key[1])->select();
                }else{
                    $key = array_rand($ids,1);
                    $randarticle = db('articles')->where('id',$key)->select();
                }                
            }
            if(count($randarticle) == 1){
                $randhtml = '<li class="am-pagination-next"><a href="'.url('/article/'.$randarticle[0]['id']).'">'.$randarticle[0]['title'].' &raquo;</a></li>';
            }else{
                $randhtml = '<li class="am-pagination-prev"><a href="'.url('/article/'.$randarticle[0]['id']).'" class="">&laquo; '.$randarticle[0]['title'].'</a></li>
          <li class="am-pagination-next"><a href="'.url('/article/'.$randarticle[1]['id']).'">'.$randarticle[1]['title'].' &raquo;</a></li>';
            }
            $data['randhtml'] = $randhtml;
        }
        
    	return $this->fetch('article',$data);
    }
    public function timeline()
    {
        $articles = db('articles')->where('is_hide',0)->order('createtime','desc')->select();
        foreach ($articles as &$vo) {
           foreach($this->category as $row){
                if($vo['category'] == $row['id']){
                    $vo['category'] = $row['name'];
                }
           }
        }
        unset($vo);
        $data = array();
        foreach($articles as &$v){
            $data[date('Y',$v['createtime'])][date('m',$v['createtime'])][] = $v;
        }
        /*for($i = 0; $i < count($data); $i++){
            $arr[date('Y',$data[$i]['createtime'])][date('m',$data[$i]['createtime'])][] = $data[$i];
        }
        var_dump($arr);*/
    	return $this->fetch('timeline',[
            'category'  => $this->category,
            'set'       => $this->setting ,
            'data'      => $data,
            'article_charts'=> $this->articleCharts 
        ]);
    }
   
}
