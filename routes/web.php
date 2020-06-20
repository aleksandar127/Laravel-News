<?php

use Illuminate\Support\Facades\Auth;
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

Route::resource('article', 'ArticleController');
Route::get('/myarticles', 'ArticleController@myarticles');
Auth::routes();

Route::get('/category/{category}', 'CategoryController@index')->name('category');
Route::get('/currency', 'CurrencyController@index')->name('currency');
Route::get('/weather', 'WeatherController@index')->name('weather');

Route::post('/ajax', 'ArticleController@ajax');
