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

Route::get('/home', "App\Http\Controllers\HomeController@index")->name('home');
Route::get('/home_scaricaOpereSala', "App\Http\Controllers\HomeController@home_scaricaOpereSala")->name('home_scaricaOpereSala');
Route::post('/home_inserimentovalutazione', "App\Http\Controllers\HomeController@home_inserimentovalutazione")->name('home_inserimentovalutazione');



Route::get('/search', "App\Http\Controllers\SearchController@index")->name('search');
Route::post('/search_immagine', "App\Http\Controllers\SearchController@search_immagine")->name('search_immagine');
Route::post('/search_spotify', "App\Http\Controllers\SearchController@search_spotify")->name('search_spotify');
Route::post('/search_utente', "App\Http\Controllers\SearchController@search_utente")->name('search_utente');

Route::get('/gallery', "App\Http\Controllers\GalleryController@index")->name('gallery');
Route::post('/gallery_creaGalleria', "App\Http\Controllers\GalleryController@creaGalleria")->name('gallery_creaGalleria');
Route::post('/gallery_inizioAbbonamento', "App\Http\Controllers\GalleryController@gallery_inizioAbbonamento")->name('gallery_inizioAbbonamento');
Route::post('/gallery_fineAbbonamento', "App\Http\Controllers\GalleryController@gallery_fineAbbonamento")->name('gallery_fineAbbonamento');
Route::get('/gallery_scaricaSale', "App\Http\Controllers\GalleryController@gallery_scaricaSale")->name('gallery_scaricaSale');
Route::get('/gallery_cercaSale', "App\Http\Controllers\GalleryController@gallery_cercaSale")->name('gallery_cercaSale');



Route::get('/create', "App\Http\Controllers\CreateController@index")->name('create');
Route::post('/create_postaOpera', "App\Http\Controllers\CreateController@create_postaOpera")->name('create_postaOpera');
Route::get('/create_scaricaOpere', "App\Http\Controllers\CreateController@create_scaricaOpere")->name('create_scaricaOpere');

Route::get('/register', "App\Http\Controllers\RegisterController@index")->name('register');
Route::post('/register', "App\Http\Controllers\RegisterController@create");
Route::get('/register/email', "App\Http\Controllers\RegisterController@checkEmail");
Route::get("/register/username", "App\Http\Controllers\RegisterController@checkUsername")->name('checkUsername');


Route::get("/login", "App\Http\Controllers\LoginController@login")->name("login");
Route::post("/logout", "App\Http\Controllers\LoginController@logout")->name("logout");
Route::post("/login", "App\Http\Controllers\LoginController@checkLogin");