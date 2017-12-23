<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


function pageinate($total, $pageIndex, $pageSize = 10, $category = ''){
	$num = ceil($total/$pageSize);
	$html = '<ul class="am-pagination">';
	if(!empty($category)){
		$category = '&category='.$category;
	}
	if($pageIndex-1 >0){
		$html .= '<li class="am-pagination-prev"><a href="?page='.($pageIndex-1).$category.'">&laquo; Prev</a></li>';
	}
  	if($pageIndex+1 <= $num){
  		$html .= '<li class="am-pagination-next"><a href="?page='.($pageIndex+1).$category.'">Next &raquo;</a></li>';
  	}
	$html .= '</ul>';
	return $html;
}