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



Route::resource('estudantes','EstudantesController');
Route::post('estudantes/delete/','EstudantesController@delete');
Route::get('estudantes/estudante/{id}','EstudantesController@estudante');
Route::get('estudantes/endereco/{id}','EstudantesController@endereco');
Route::get('estudantes/mae/{id}','EstudantesController@mae');
