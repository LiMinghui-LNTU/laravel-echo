<?php

use App\Events\PublicMessageEvent;
use App\Events\PrivateMessageEvent;

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

Route::get('/', function () {
    return redirect('home');
});
Auth::routes();

//前台登录路由
Route::group(['namespace' => 'Home'], function () {
    Route::get('login', 'SelfController@getLogin');
    Route::post('login', 'SelfController@postLogin');
    Route::post('reg', 'SelfController@postReg');
    Route::get('logout', 'SelfController@getLogout');
});

Route::group(['namespace' => 'Home'], function () {
    Route::resource('home', 'HomeController');
    Route::post('upload-file', 'HomeController@uploadFile');
    Route::post('send-msg', 'HomeController@sendValidateCode');
    Route::post('check-code', 'HomeController@checkValidateCode');
    Route::resource('designer', 'DesignerController');
    Route::resource('display', 'DisplayController');
    Route::resource('knowledge', 'KnowledgeController');
    Route::resource('activity', 'ActivityController');
    Route::resource('member', 'MemberController');
    Route::resource('recruit', 'RecruitController');
    Route::resource('about', 'AboutController');
    Route::resource('self', 'SelfController')->middleware('member');
    Route::post('check-reg', 'SelfController@checkReg');
    Route::post('get-service', 'SelfController@postTimeAndPrice');
    Route::post('get-schedule', 'SelfController@postThisDesignerSchedule');
    Route::post('to-shopowner', 'SelfController@sendMsg2Shopowner');
    Route::post('from-shopowner', 'SelfController@getMsgFromShopowner');
    Route::post('order-cancel', 'SelfController@doCancel'); //取消订单
    Route::post('make-comments', 'SelfController@makeComments'); //评价订单
    Route::post('order-pay', 'SelfController@orderPay'); //订单支付
    Route::post('ticket-id', 'SelfController@getIdArr'); //获取使用的卡券id
    Route::post('handle-member', 'PayController@handleMember'); //办理会员
    Route::post('pay-order', 'PayController@payOrder'); //办理会员
    Route::get('check', 'PayController@checkData'); //回调验签
    Route::get('register/activate', 'MailController@accountActivate'); //邮箱激活
});

//后台登录路由
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('login', 'UserController@getLogin')->name('admin.login');
    Route::post('login', 'UserController@postLogin');
    Route::get('logout', 'UserController@getLogout');
});

//后台用户路由
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('/', 'UserController');
    Route::post('edit-info', 'UserController@editInfo');
    Route::get('my-message', 'UserController@myMessage');
    Route::post('admin-reply', 'UserController@adminReply');
    Route::resource('shopowner', 'ShopownerController'); //店长
    Route::post('reply-message', 'ShopownerController@replyMessage'); //店长回复消息
    Route::resource('message', 'MessageController');//消息列表
    Route::post('get-message', 'MessageController@getMessageToMe');//ajax获取自己的消息
    Route::resource('case', 'CaseController');//发型展示
    Route::resource('article', 'ArticleController');//养护文章
    Route::resource('recruit', 'RecruitController');//招聘启事
    Route::resource('resume', 'ResumeController');//应聘简历
    Route::resource('clerk', 'ClerkController'); //店员
    Route::resource('calendar', 'CalendarController');//日程安排
    Route::resource('sowmap', 'SowmapController');//轮播图
    Route::resource('customer', 'CustomerController');//我的顾客
    Route::resource('service', 'ServiceController');//店铺服务
    Route::resource('ticket', 'TicketController');//票券管理
    Route::resource('vip', 'VipController');//会员卡管理
    Route::get('search-ticket', 'TicketController@isExist');//查询该类型票券
    Route::post('insert-file', 'ServiceController@insertExcelData');//插入Excel数据到数据库
    Route::post('upload-photo', 'UploadController@uploadFile'); //上传文件
    Route::post('change-order-status', 'ClerkController@changeOrderStatus'); //店员改变订单状态
    Route::get('achievement-statistic', 'DataStatistics@achievementsStatistic');//店员业绩统计
    Route::get('type-statistic', 'DataStatistics@customersTypeStatistic');//顾客类型统计
    Route::get('visitors-num', 'DataStatistics@statisticVisitors');//顾客流量统计
});