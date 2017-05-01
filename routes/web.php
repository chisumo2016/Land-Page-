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

Route::get('/', function () {
    return view('index');
});

Route::group(['middleware'=>'web'], function(){
    Route::match(['get','post'], '/', ['uses'=>'IndexController@execute','as'=>'home']);
    Route::get('/pages/{alias}',['uses'=>'PageController@execute', 'as'=>'page']);

    Route::auth();
});

//admin/service
Route::group(['prefix'=>'admin','middleware'=>'auth'], function(){

    //admin
    Route::get('/',function(){

    });

    //admin/pages
    Route::group(['prefix'=>'pages'], function(){

        //admin/pages
        Route::get('/', ['uses'=>'PagesController@execute','as'=>'pages']);

        //admin/pages/add
        Route::match(['get','post'], '/add', ['uses'=>'PagesAddController@execute','as'=>'pagesAdd']);
        //admin/pages/edit
        Route::match(['get','post', 'delete'], '/edit/{page}', ['uses'=>'PagesEditController@execute', 'as'=>'PagesEdit']);


    });


    //admin/portfolios
    Route::group(['prefix'=>'portfolios'], function(){

        //admin/portfolios
        Route::get('/', ['uses'=>'portfoliosController@execute','as'=>'portfolios']);

        //admin/portfolios/add
        Route::match(['get','post'], '/add', ['uses'=>'portfoliosAddController@execute','as'=>'portfoliosAdd']);
        //admin/portfolios/edit
        Route::match(['get','post', 'delete'], '/edit/{portfolios}', ['uses'=>'portfoliosEditController@execute', 'as'=>'portfoliosEdit']);


    });


    //admin/portfolios
    Route::group(['prefix'=>'services'], function(){

        //admin/services
        Route::get('/', ['uses'=>'servicesController@execute','as'=>'services']);

        //admin/services/add
        Route::match(['get','post'], '/add', ['uses'=>'servicesAddController@execute','as'=>'servicessAdd']);
        //admin/services/edit
        Route::match(['get','post', 'delete'], '/edit/{services}', ['uses'=>'portfoliosEditController@execute', 'as'=>'servicesEdit']);


    });
});