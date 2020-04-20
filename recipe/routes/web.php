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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/base', function () {
    return view('base');
});

Route::get('categories', 'RecipeController@categories')->name('categories');
Route::post('add_category', 'RecipeController@add_category')->name('add_category');
Route::get('edit_cat', 'RecipeController@edit_cat')->name('edit_cat');
Route::post('update_cat', 'RecipeController@update_cat')->name('update_cat');
Route::post('delete_cat/{id}', 'RecipeController@delete_cat')->name('delete_cat');


Route::get('recipe', 'RecipeController@recipe')->name('recipe');
Route::post('add_recipe', 'RecipeController@add_recipe')->name('add_recipe');
Route::get('edit_rec', 'RecipeController@edit_rec')->name('edit_rec');
Route::post('update_rec', 'RecipeController@update_rec')->name('update_rec');
Route::post('delete_rec/{id}', 'RecipeController@delete_rec')->name('delete_rec');

Route::get('/news', 'NewsController@news')->name('news');
Route::post('/add_news', 'NewsController@add_news')->name('add_news');

Route::get('/', 'PagesController@menu')->name('menu');
Route::get('/index', 'PagesController@index')->name('index');
Route::get('/get_recipes/{id}', 'PagesController@get_recipes')->name('get_recipes');
Route::get('/single_recipe/{id}', 'PagesController@single_recipe')->name('single_recipe');
