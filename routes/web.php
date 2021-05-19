<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/home', 'HomeController@home')->name('home');

Route::group(['prefix'=>'cursos','as'=>'cursos.'], function() {
    Route::get('/', 'Curso\CursoController@index')->name('index');
    Route::get('/novo', 'Curso\CursoController@novo')->name('novo');
    Route::post('/novo', 'Curso\CursoController@novo')->name('novo');
    Route::get('/editar/{id}', 'Curso\CursoController@editar')->name('editar');
    Route::post('/editar/{id}', 'Curso\CursoController@editar')->name('editar');
    Route::get('/delete/{id}', 'Curso\CursoController@remover')->name('delete');
});

Route::group(['prefix'=>'alunos','as'=>'alunos.'], function() {
    Route::get('/', 'Aluno\AlunoController@index')->name('index');
    Route::get('/novo', 'Aluno\AlunoController@novo')->name('novo');
    Route::post('/novo', 'Aluno\AlunoController@novo')->name('novo');
    Route::get('/editar/{id}', 'Aluno\AlunoController@editar')->name('editar');
    Route::post('/editar/{id}', 'Aluno\AlunoController@editar')->name('editar');
    Route::get('/delete/{id}', 'Aluno\AlunoController@remover')->name('delete');
});
