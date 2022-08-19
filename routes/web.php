<?php

use App\Http\Controllers\AdmController;
use App\Http\Controllers\AdmLoginController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LoginController;
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

//administration

Route::get('/adm', [AdmLoginController::class,"layout"] );
Route::post('/adm', [AdmLoginController::class,"login"] );

Route::get('/painel', [AdmController::class,"layout"] );


//logins

Route::get('/login', [LoginController::class, "layout"]);
Route::post('/login', [LoginController::class,"login"]);



//layouts
Route::get('/header',[LayoutController::class, "header"]);

Route::get('/footer',[LayoutController::class, "footer"]);