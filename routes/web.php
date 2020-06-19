<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/student', 'ProfileController@student')->name('student');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/api/lesson.request', 'ApiController@lessonRequest')->name('lesson.request');
Route::get('/api/connect.teacher', 'ApiController@connectTeacher')->name('connect.teacher');
Route::get('/api/disconnect.teacher', 'ApiController@disconnectTeacher')->name('disconnect.teacher');
