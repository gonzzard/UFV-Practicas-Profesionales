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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth', 'role:Administrador');

Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

Route::resource('user', 'UserController')->middleware(['auth', 'role:Administrador']);

Route::resource('cursoacad', 'CursoAcadController')->middleware(['auth', 'role:Administrador']);
Route::resource('directores', 'DirectorController')->middleware(['auth', 'role:Administrador']);
Route::resource('titulaciones', 'TitulacionController')->middleware(['auth', 'role:Administrador']);
Route::resource('instituciones', 'InstitucionController')->middleware(['auth', 'role:Administrador']);
Route::resource('tutoresInstitucionales', 'TutoresInstitucionalesController')->middleware(['auth', 'role:Administrador']);
Route::resource('tutoresAcademicos', 'TutoresAcademicosController')->middleware(['auth', 'role:Administrador']);