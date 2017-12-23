<?php

use think\Route;
//前端路由
Route::get('article/[:id]','index/index/article');
Route::get('timeline','index/index/timeline');




//后端路由
Route::get('set','admin/sysset/index');
Route::get('articlelist','admin/articles/index');
Route::get('form/[:id]','admin/articles/form');
Route::post('form/[:id]','admin/articles/form');

Route::get('login','admin/user/login');
Route::get('login_out','admin/user/login_out');
Route::post('ajaxlogin','admin/user/login');




