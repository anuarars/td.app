<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/page', 'PageController')->names('page')->only(['show']);

Auth::routes(['verify'=>true]);


Route::group(['middleware'=>['auth', 'verified']], function(){
    // ROUTES FOR COMPANIES ADDRESS DATA
    Route::get('/address', 'Auth\AddressController@index')->name('address.index');
    Route::post('/address/{id}', 'Auth\AddressController@store')->name('address.store');
});

/*---------------------------------AUTH GROUP ROUTES---------------------------------------------*/

Route::group(['middleware'=>['auth', 'verified', 'HasAddress']], function(){

    Route::get('/subscribe', 'SubscribeController@index')->name('subscribe.index');
    Route::post('/subscribe/{id}', 'SubscribeController@store')->name('subscribe.store');

    Route::post('/chat/messages', 'ChatController@old');
    Route::post('/chat/send', 'ChatController@send');
    Route::get('/chat/{order_id}', 'ChatController@show')->name('chat.show');
    Route::get('/chat/header/{order_id}', 'ChatController@order_users');
    Route::get('/chat/bid/{order_id}', 'ChatController@order_bid');

    Route::get('/profile/{id}', 'ProfileController@showProfile')->name('profile.show');
    Route::get('/profile/{id}/edit', 'ProfileController@edit')->name('profile.edit');
    Route::post('/profile/{id}/update', 'ProfileController@update')->name('profile.update');

    Route::get('/protocol/{id}', 'ProtocolController@index')->name('protocol.index');
    Route::post('/protocol/store', 'ProtocolController@store')->name('protocol.store');
    Route::post('/protocol/extract', 'ProtocolController@extract')->name('protocol.extract');
    Route::get('/protocol/download/{id}', 'ProtocolController@download')->name('protocol.download');
});

/*---------------------------------AUTH GROUP ROUTES---------------------------------------------*/







/*---------------------------------CLIENT GROUP ROUTES---------------------------------------------*/
Route::group(['middleware'=>['auth', 'verified', 'client', 'HasAddress'], 'namespace'=>'Client', 'prefix'=>'client'], function(){
    Route::get('/account', 'AccountController@index')->name('client.account.index');
    Route::get('/account/order/create', 'OrderController@create')->name('client.order.create');
    Route::post('/account/order/store', 'OrderController@store')->name('client.order.store');
    Route::get('/account/order/list', 'OrderController@index')->name('client.order.index');
    Route::get('/account/order/requests', 'OrderController@requests')->name('client.order.requests');
    Route::get('/account/order/show/{id}', 'OrderController@show')->name('client.order.show');
    Route::post('/account/order/request/{worker_id}/{order_id}/destroy', 'OrderController@destroyRequest')->name('client.order.request.destroy');
    Route::post('/account/order/request/{worker_id}/{order_id}/accept', 'OrderController@acceptRequest')->name('client.order.request.accept');
    Route::post('/account/protocol/store/{id}', 'AccountController@protocolStore')->name('client.protocol.store');
    Route::get('/chat', 'AccountController@chat')->name('client.chat.index');
});
/*---------------------------------CLIENT GROUP ROUTES---------------------------------------------*/







/*---------------------------------WORKER GROUP ROUTES---------------------------------------------*/
Route::group(['middleware'=>['auth', 'verified', 'isWorker', 'HasAddress'], 'namespace'=>'Worker', 'prefix'=>'worker'], function(){
    Route::get('/account', 'AccountController@index')->name('worker.account.index');
    Route::get('/account/category', 'CategoryController@index')->name('worker.category.index');
    Route::get('/account/category/create', 'CategoryController@create')->name('worker.category.create');
    Route::post('/account/category/store', 'CategoryController@store')->name('worker.category.store');
    Route::post('/account/category/destroy/{id}', 'CategoryController@destroy')->name('worker.category.destroy');
    Route::get('/account/orders', 'AccountController@orders')->name('worker.account.orders');
    Route::get('/account/offers', 'AccountController@offers')->name('worker.account.offers');
    Route::get('/chat', 'AccountController@chat')->name('worker.chat.index');
    Route::get('/order/{id}', 'OrderController@show')->name('order.show');
    Route::post('/order/{id}/request', 'OrderController@request')->name('order.request');
    Route::post('/product/update', 'OrderController@productUpdate')->name('client.product.update');
    Route::get('/protocol/{order_id}/{worker_id}', 'ProtocolController@index')->name('worker.protocol.index');
    Route::get('/protocol/{order_id}/{worker_id}/download', 'ProtocolController@download')->name('worker.protocol.download');
    Route::post('/protocol/upload/{order_id}', 'ProtocolController@upload')->name('worker.protocol.upload');
    Route::get('/protocol/list', 'ProtocolController@list')->name('worker.protocol.list');
});
/*---------------------------------WORKER GROUP ROUTES---------------------------------------------*/







/*---------------------------------ADMIN GROUP ROUTES---------------------------------------------*/ 

Route::group(['middleware'=>['auth', 'verified', 'admin'], 'namespace'=>'Admin', 'prefix'=>'admin'], function(){
    Route::resource('/user', 'UserController')->names('admin.user')->except(['create', 'store']);
    Route::resource('/category', 'CategoryController')->names('admin.category')->except(['show']);
    Route::resource('/order', 'OrderController')->names('admin.order')->except(['create', 'store']);
    Route::resource('/page', 'PageController')->names('admin.page')->except(['show']);
    Route::resource('/subscribe', 'SubscribeController')->names('admin.subscribe');
    Route::resource('/protocol', 'ProtocolController')->names('admin.protocol');
});

/*---------------------------------ADMIN GROUP ROUTES---------------------------------------------*/