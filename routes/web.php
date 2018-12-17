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
//    Auth::routes();
    //首页\登录
    Route::group(['namespace'=>'admin\index'],function (){

        Route::group(['namespace'=>'index'],function (){
            //首页
            Route::get('index','IndexController@index');
            Route::get('main','IndexController@main');
            //登录
            Route::match(['get','post'],'login','IndexController@login');
            //用户登录接口
            Route::match(['get','post'],'login_now','IndexController@login_now');
            //修改用户资料
            Route::get('info_edit/{id}','IndexController@info_edit');
            //修改用户密码
            Route::get('psw_edit/{id}','IndexController@psw_edit');
            //修改接口
            Route::post('user_edit/{id}','IndexController@user_edit');
            //用户退出接口
            Route::get('login_out','IndexController@login_out');
        });

    });

    //系统配置
    Route::group(['namespace'=>'admin\system'],function (){

        //后台用户管理
        Route::group(['namespace'=>'users','middleware' => ['permission:user_set']],function (){
            Route::resource('users', 'UsersController');
            Route::get('users_ajax_list', 'UsersController@users_ajax_list');
        });

        //后台权限管理
        Route::group(['namespace'=>'auth','middleware' => ['permission:auth_set']],function (){
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
        Route::group(['namespace'=>'category','middleware' => ['permission:cate_set']],function (){
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
        Route::group(['namespace'=>'media','middleware' => ['permission:attach_set']],function (){
            Route::resource('media', 'MediaController');
            Route::get('media_ajax_list', 'MediaController@ajax_list');
            Route::post('file_upload', 'MediaController@file_upload');
            Route::get('media_open_list', 'MediaController@open_list');
        });

        //后台站点配置
        Route::group(['namespace'=>'site','middleware' => ['permission:system_site']],function (){
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
        Route::group(['namespace'=>'log','middleware' => ['permission:user_set']],function (){
            Route::resource('log', 'LogController');
            //日志列表
            Route::get('log_ajax_list', 'LogController@log_ajax_list');
        });

    });

    //内容管理
    Route::group(['namespace'=>'admin\content'],function (){

        //文章管理
        Route::group(['namespace'=>'article','middleware' => ['permission:article_set']],function (){
            Route::resource('article', 'ArticleController');
            Route::get('article_ajax_list', 'ArticleController@ajax_list');
            Route::post('article_delAll', 'ArticleController@delAll');
        });

        //广告管理
        Route::group(['namespace'=>'banner','middleware' => ['permission:banner_set']],function (){
            Route::resource('banner', 'BannerController');
            Route::get('banner_ajax_list', 'BannerController@ajax_list');

            Route::resource('banner_place', 'BannerPlaceController');
            Route::get('banner_place_ajax_list', 'BannerPlaceController@ajax_list');
            Route::post('banner_place_delAll', 'BannerPlaceController@delAll');
        });

        //友情链接
        Route::group(['namespace'=>'link','middleware' => ['permission:friends_link_set']],function (){
            Route::resource('link', 'LinkController');
            Route::get('link_ajax_list', 'LinkController@ajax_list');
            Route::post('link_delAll', 'LinkController@delAll');
        });

        //单页管理
        Route::group(['namespace'=>'page','middleware' => ['permission:single_page_set']],function (){
            Route::resource('page', 'PageController');
            Route::get('page_ajax_list', 'PageController@ajax_list');
            Route::post('page_delAll', 'PageController@delAll');
        });
    });

    //会员管理
    Route::group(['namespace'=>'admin\member'],function (){

        //会员管理
        Route::group(['namespace'=>'member'],function (){
            Route::resource('member', 'MemberController');
            Route::get('member_ajax_list', 'MemberController@ajax_list');
        });
    });

    //互动管理
    Route::group(['namespace'=>'admin\interaction','middleware' => ['permission:message_set']],function (){

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
