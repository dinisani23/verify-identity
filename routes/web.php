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
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
//Route::post('logout', 'LoginController@logout')->name('logout');
//Route::group(['middleware' => 'SessionExpiredMiddleware'], function() {
    //Route::get('/dashboard', 'HomeController@index')->name('dashboard');
//});
//Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function () {
    //Route::get('/verification_ic/list', 'ListIcController@index')->name('verification_ic.list');;
//});


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::resource('/input_ic', 'App\Http\Controllers\InputIcController@create');
Route::get('/input_ic/create', 'InputIcController@create')->name('input_ic.create');
Route::post('/input_ic', 'InputIcController@store')->name('input_ic.store');

Route::resource('/images_ic', 'App\Http\Controllers\ImageIcController@create');
Route::get('/images_ic/create', 'ImageIcController@create')->name('images_ic.create');
Route::post('/images_ic', 'ImageIcController@store')->name('images_ic.store');

Route::get('/verification_ic/verify', 'ExtractedIcController@extract')->name('verification_ic.extract');
Route::get('/verification_ic/show', 'ExtractedIcController@show')->name('verification_ic.show');
Route::get('/verification_ic/verify_spr', 'semakSPRController@verify_spr')->name('verification_ic.verify_spr');
Route::get('/verification_ic/show_spr', 'semakSPRController@show_spr')->name('verification_ic.show_spr');
Route::get('/verification_ic/list', 'ListIcController@index')->name('verification_ic.list');
Route::get('/verification_ic/{inputIC}/edit', 'InputIcController@edit')->name('verification_ic.edit');
Route::put('/verification_ic/{inputIC}', 'InputIcController@update')->name('verification_ic.update');
Route::delete('/verification_ic/{inputIC}', 'InputIcController@destroy')->name('verification_ic.destroy');
//Route::get('/verification/result', 'ExtractedController@show')->name('verification.result');
//
Route::resource('/input_dl', 'App\Http\Controllers\InputDlController@create');
Route::get('/input_dl/create', 'InputDlController@create')->name('input_dl.create');
Route::post('/input_dl', 'InputDlController@store')->name('input_dl.store');

Route::resource('/images_dl', 'App\Http\Controllers\ImageDlController@create');
Route::get('/images_dl/create', 'ImageDlController@create')->name('images_dl.create');
Route::post('/images_dl', 'ImageDlController@store')->name('images_dl.store');

Route::get('/verification_dl/verify', 'ExtractedDlController@extract')->name('verification_dl.extract');
Route::get('/verification_dl/show', 'ExtractedDlController@show')->name('verification_dl.show');
Route::get('/verification_dl/verify_jpj', 'semakJPJController@verify_jpj')->name('verification_dl.verify_jpj');
Route::get('/verification_dl/show_jpj', 'semakJPJController@show_jpj')->name('verification_dl.show_jpj');
Route::get('/verification_dl/list', 'ListDlController@index')->name('verification_dl.list');
Route::get('/verification_dl/{inputDL}/edit', 'InputDlController@edit')->name('verification_dl.edit');
Route::put('/verification_dl/{inputDL}', 'InputDlController@update')->name('verification_dl.update');
Route::delete('/verification_dl/{inputDL}', 'InputDlController@destroy')->name('verification_dl.destroy');
//Route::get('/verification_dl/result')->name('verification_dl.result');

Route::get('/dashboard', 'NewsController@news')->name('dashboard');

Route::resource('/input_ic','InputIcController');
Route::resource('/images_ic', 'ImageIcController');
Route::resource('/verification_ic','ExtractedIcController');
Route::resource('/input_dl','InputDlController');
Route::resource('/images_dl', 'ImageDlController');
Route::resource('/verification_dl','ExtractedDlController');