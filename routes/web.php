<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TimetableController;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Method1
// Route::get('/students', 'StudentController@index')->name('students.index');
// Route::get('/students/create', 'StudentController@create')->name('students.create');
// Route::post('/students', 'StudentController@store')->name('students.store');
// Route::get('/students/{student}', 'StudentController@show')->name('students.show');
// Route::get('/students/{student}/edit', 'StudentController@edit')->name('students.edit');
// Route::put('/students/{student}', 'StudentController@update')->name('students.update');
// Route::delete('/students/{student}', 'StudentController@destroy')->name('students.destroy');
Route::resource('students',  StudentController::class);
//Method2
Route::resource('subjects', SubjectController::class);
Route::resource('halls', HallController::class);
Route::resource('groups', GroupController::class);
// Route::get('/subjects', 'SubjectController@index')->name('subjects.index');
// Route::get('/subjects/create', 'SubjectController@create')->name('subjects.create');
// Route::post('/subjects', 'SubjectController@store')->name('subjects.store');
// Route::get('/subjects/{subject}', 'SubjectController@show')->name('subjects.show');
// Route::get('/subjects/{subject}/edit', 'SubjectController@edit')->name('subjects.edit');
// Route::put('/subjects/{subject}', 'SubjectController@update')->name('subjects.update');
// Route::delete('/subjects/{subject}', 'SubjectController@destroy')->name('subjects.destroy');


// Route::get('/halls', 'HallController@index')->name('halls.index');
// Route::get('/halls/create', 'HallController@create')->name('halls.create');
// Route::post('/halls', 'HallController@store')->name('halls.store');
// Route::get('/halls/{hall}', 'HallController@show')->name('halls.show');
// Route::get('/halls/{hall}/edit', 'HallController@edit')->name('halls.edit');
// Route::put('/halls/{hall}', 'HallController@update')->name('halls.update');
// Route::delete('/halls/{hall}', 'HallController@destroy')->name('halls.destroy');





// Route::get('/groups', 'GroupController@index')->name('groups.index');
// Route::get('/groups/create', 'GroupController@create')->name('groups.create');
// Route::post('/groups', 'GroupController@store')->name('groups.store');
// Route::get('/groups/{group}', 'GroupController@show')->name('groups.show');
// Route::get('/groups/{group}/edit', 'GroupController@edit')->name('groups.edit');
// Route::put('/groups/{group}', 'GroupController@update')->name('groups.update');
// Route::delete('/groups/{group}', 'GroupController@destroy')->name('groups.destroy');

Route::resource('timetables',TimetableController::class);
Route::resource('/days', 'DayController');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');