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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/company','CompanyController');

Route::resource('/project','ProjectController');

Route::post('/project/addmember','ProjectController@addmember')->name('project.addmember');

Route::resource('/role','RoleController');

Route::resource('/task','TaskController');

Route::resource('/user','UserController');

Route::resource('/comment','CommentController');
