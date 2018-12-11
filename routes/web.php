<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/**
 * 后台路由文件
 */
Route::group(['prefix'=>'admin'],function (){
    //laravel自带的登录和注册
    Auth::routes();
    //首页\登录
    Route::group(['namespace'=>'admin\index'],function (){

        Route::group(['namespace'=>'index'],function (){
            //首页
            Route::get('index','IndexController@index');
            Route::get('main','IndexController@main');
            //登录
//            Route::match(['get','post'],'login','IndexController@login');
        });

    });

    //系统配置
    Route::group(['namespace'=>'admin\system'],function (){

        //后台用户管理
        Route::group(['namespace'=>'users'],function (){
            Route::resource('users', 'UsersController');
        });

        //后台权限管理
        Route::group(['namespace'=>'auth'],function (){
            //权限控制器
            Route::resource('auth', 'AuthController');
            //角色控制器
            Route::resource('roles', 'RolesController');
            //角色ajax列表
            Route::get('roles_ajax_list', 'RolesController@roles_ajax_list');
            //权限ajax列表
            Route::get('auth_ajax_list', 'AuthController@auth_ajax_list');
        });

        //后台分类管理
        Route::group(['namespace'=>'category'],function (){
            //分类制器
            Route::resource('category', 'CategoryController');
            Route::get('category_ajax_list', 'CategoryController@ajax_list');
            //分类类型控制器
            Route::resource('category_type', 'CategoryTypeController');
            //分类类型ajax列表
            Route::get('type_ajax_list', 'CategoryTypeController@type_ajax_list');
            Route::post('category_delAll', 'CategoryTypeController@delAll');
        });

        //后台附件管理
        Route::group(['namespace'=>'media'],function (){
            Route::resource('media', 'MediaController');
            Route::get('media_ajax_list', 'MediaController@ajax_list');
            Route::post('file_upload', 'MediaController@file_upload');
            Route::get('media_open_list', 'MediaController@open_list');
        });



        //后台站点配置
        Route::group(['namespace'=>'site'],function (){
            //站点配置
            Route::get('site', 'SiteController@site');
            //SEO配置
            Route::get('seo', 'SiteController@seo');
            //公司基本信息配置
            Route::get('basic', 'SiteController@basic');
            //联系方式配置
            Route::get('contact', 'SiteController@contact');
            //修改
            Route::post('site_edit','SiteController@edit');
        });
        //后台日志管理
        Route::group(['namespace'=>'log'],function (){
            Route::resource('log', 'LogController');
        });

    });

    //内容管理
    Route::group(['namespace'=>'admin\content'],function (){

        //文章管理
        Route::group(['namespace'=>'article'],function (){
            Route::resource('article', 'ArticleController');
            Route::get('article_ajax_list', 'ArticleController@ajax_list');
            Route::post('article_delAll', 'ArticleController@delAll');
        });

        //广告管理
        Route::group(['namespace'=>'banner'],function (){
            Route::resource('banner', 'BannerController');
        });

        //相册管理
        Route::group(['namespace'=>'photo'],function (){
            Route::resource('photo', 'PhotoController');
        });

        //友情链接
        Route::group(['namespace'=>'link'],function (){
            Route::resource('link', 'LinkController');
            Route::get('link_ajax_list', 'LinkController@ajax_list');
            Route::post('link_delAll', 'LinkController@delAll');
        });

        //单页管理
        Route::group(['namespace'=>'page'],function (){
            Route::resource('page', 'PageController');
        });
    });

    //会员管理
    Route::group(['namespace'=>'admin\member'],function (){

        //会员管理
        Route::group(['namespace'=>'member'],function (){
            Route::resource('member', 'MemberController');
        });
    });

    //互动管理
    Route::group(['namespace'=>'admin\interaction'],function (){

        //留言管理
        Route::group(['namespace'=>'messages'],function (){
            Route::resource('messages', 'MessagesController');
            Route::get('messages_ajax_list', 'MessagesController@ajax_list');
            Route::post('messages_delAll', 'MessagesController@delAll');
        });

    });
});


/**
 * 前台路由
 */

Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', 'HomeController@index')->name('home');
