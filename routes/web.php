<?php

use App\Http\Controllers\LayoutController;
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

Route::get('/', function () {return view('welcome');});

Route::get('/index', function () {return view('index');});

Route::get('/adm', function () {return view('adm/login');});

Route::get('/login', function () {return view('login');});

Route::get('/header',[LayoutController::class, "header"]);

Route::get('/footer',[LayoutController::class, "footer"]);