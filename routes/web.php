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

Route::get('/', function () {
    return view('angular');
});

Route::get('/alunos', function () {
    return view('angular');
})->name('alunos');


Route::resource('estudantes','EstudantesController');
Route::post('estudantes/delete/','EstudantesController@delete');
Route::get('estados','EstudantesController@estados');
Route::get('estudantes/estudante/{id}','EstudantesController@estudante');
Route::get('estudantes/endereco/{id}','EstudantesController@endereco');
Route::get('estudantes/mae/{id}','EstudantesController@mae');
Route::post('estudantes/update','EstudantesController@update');
Route::post('estudantes/cadastra','EstudantesController@cadastra');
Route::get('estudantes/delete/{id}','EstudantesController@delete');
