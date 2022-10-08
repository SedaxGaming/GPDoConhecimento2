<?php

use App\Http\Controllers\AdmController;
use App\Http\Controllers\AdmLoginController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\JuriController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerguntasController;
use App\Http\Controllers\UsuarioController;
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

//gerais

Route::get('/', function () {return view('welcome');});
Route::get('/index', function () {return view('index');});
Route::get('/logout',function(){return view('logout');});
Route::get('/mainmenu', [GameController::class, "mainmenu"]);

//logins

Route::get('/login', [LoginController::class, "layout"]);
Route::post('/login', [LoginController::class,"login"]);

//administration

Route::get('/adm', [AdmLoginController::class,"layout"] );
Route::post('/adm', [AdmLoginController::class,"login"] );

Route::get('/painel', [AdmController::class,"layout"] );

Route::get('/painel/cadastros', [AdmController::class,"menuCadastros"] );
Route::get('/painel/juri', [AdmController::class,"menuJuri"] );

Route::get('/placar', [AdmController::class,"placar"] );
Route::get('/cronometro', [AdmController::class,"cronometro"] );

//tabelas

Route::get('/painel/cadastros/usuarios', [UsuarioController::class, "show"]);
Route::get('/painel/cadastros/administradores', [AdmController::class, "show"]);
Route::get('/painel/cadastros/perguntas', [PerguntasController::class, "show"]);

//cadastros

Route::get('/painel/cadastros/usuarios/novo', [UsuarioController::class,"create"] );
Route::post('/painel/cadastros/usuarios/novo', [UsuarioController::class,"insert"]);

Route::get('/painel/cadastros/administradores/novo', [AdmController::class,"create"]);
Route::post('/painel/cadastros/administradores/novo', [AdmController::class,"insert"]);

Route::get('/painel/cadastros/perguntas/novo', [PerguntasController::class,"create"] );
Route::post('/painel/cadastros/perguntas/novo', [PerguntasController::class,"insert"]);


//edições

Route::get('/painel/cadastros/perguntas/{pergunta}', [PerguntasController::class,"edit"])->name('perguntas.edit');
Route::put('/painel/cadastros/perguntas/{pergunta}', [PerguntasController::class,"editar"])->name('perguntas.editar');

Route::get('/painel/cadastros/administradores/{adm}', [AdmController::class,"edit"])->name('adm.edit');
Route::put('/painel/cadastros/administradores/{adm}', [AdmController::class,"editar"])->name('adm.editar');

Route::get('/painel/cadastros/usuarios/{usuario}', [UsuarioController::class,"edit"])->name('usuarios.edit');
Route::put('/painel/cadastros/usuarios/{usuario}', [UsuarioController::class,"editar"])->name('usuarios.editar');

//Juri -> Etapas 

Route::get('/painel/juri/EtapaAtual/', [JuriController::class,"EtapaAtualView"] );
Route::get('/painel/juri/EtapasAnteriores', [JuriController::class,"EtapaAnteriorView"] );
Route::get('/painel/juri/CriarEtapa', [JuriController::class,"CriarEtapaView"] );

Route::get('/painel/juri/etapa/criar', [JuriController::class,"criarEtapa"]);
Route::post('/painel/juri/etapa/criar', [JuriController::class,"InsertEtapa"]);
//Route::post('/painel/juri/CriarEtapa', [JuriController::class,"EditEtapa"]);
//Route::get('/painel/juri/EditarEtapa', [JuriController::class,"EditarEtapa"]);

//Juri -> Provas

Route::get('/painel/juri/ProvaAtual', [JuriController::class,"ProvaAtualView"] );
Route::get('/painel/juri/ProvasAnteriores', [JuriController::class,"ProvaAnteriorView"] );
Route::get('/painel/juri/CriarProva', [JuriController::class,"CriarProvaView"] );

Route::post('/painel/juri/CriarProva', [JuriController::class,"InsertProva"]);
Route::post('/painel/juri/CriarProva', [JuriController::class,"EditProva"]);
Route::post('/painel/juri/EditarProva', [JuriController::class,"EditarProva"]);