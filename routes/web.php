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

Route::get('/', function () { return view('welcome'); });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Temporary Routes To Test Mailing System
Route::get('/sendgreeting/{id}','MailsController@GreetingMail')->name('Mails.GreetingMail');
Route::get('/sendreminder/{id}','MailsController@ReminderMail')->name('Mails.ReminderMail');


Route::get('/admin', function () { return view('Admin.admin_template'); });
Route::get('/admin/index', function(){ return view('Admin.index'); });
Route::get('/admin/index2', function(){ return view('Admin.index2'); });

