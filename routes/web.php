<?php
use App\Http\Controllers\ClientAppointmentController;
use App\Http\Controllers\CounselorAppointmentController;
use App\Http\Controllers\CounselorClientController;
use App\Http\Controllers\CounselorReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\UserController;
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
Route::get('/', [LandingController::class, 'index'])->name('landing');

Auth::routes();
//client
Route::middleware(['auth', 'user-role:client'])->group(function () {
    Route::get("/home", [HomeController::class, 'clientHome'])->name('home.client');
});
//counsellor
Route::middleware(['auth', 'user-role:counselor'])->group(function () {
    Route::get("/counselor/home", [HomeController::class, 'counselorHome'])->name('home.counselor');
});
//admin
Route::middleware(['auth', 'user-role:admin'])->group(function () {
    Route::get("/admin/home", [HomeController::class, 'adminHome'])->name('home.admin');
});
// Route::group(['middleware' => 'auth'], function () {
//     Route::resource('appointments', AppointmentController::class);
// });
Route::middleware(['auth'])->group(function () {
    Route::middleware(['user-role:counselor'])->prefix('counselor')->group(function () {
        Route::resource('appointments', CounselorAppointmentController::class)->names([
            'index' => 'counselor.appointments.index',
            'create' => 'counselor.appointments.create',
            'store' => 'counselor.appointments.store',
            'show' => 'counselor.appointments.show',
            'edit' => 'counselor.appointments.edit',
            'update' => 'counselor.appointments.update',
            'destroy' => 'counselor.appointments.destroy',
        ]);
        Route::put('/appointments/{appointment}/change-status/{status}', [CounselorAppointmentController::class, 'changeStatus'])
            ->name('counselor.appointments.changeStatus');
    });

    Route::middleware(['user-role:client'])->prefix('client')->group(function () {
        Route::resource('appointments', ClientAppointmentController::class)->names([
            'index' => 'client.appointments.index',
            'create' => 'client.appointments.create',
            'store' => 'client.appointments.store',
            'show' => 'client.appointments.show',
            'edit' => 'client.appointments.edit',
            'update' => 'client.appointments.update',
            'destroy' => 'client.appointments.destroy',
        ]);
        Route::put('/appointments/{appointment}/change-status/{status}', [ClientAppointmentController::class, 'changeStatus'])
            ->name('client.appointments.changeStatus');
    });

    Route::middleware(['user-role:counselor'])->prefix('counselor')->group(function () {
        Route::resource('reports', CounselorReportController::class)->names([
            'index' => 'counselor.reports.index',
            'create' => 'counselor.reports.create',
            'store' => 'counselor.reports.store',
            'show' => 'counselor.reports.show',
            'edit' => 'counselor.reports.edit',
            'update' => 'counselor.reports.update',
            'destroy' => 'counselor.reports.destroy',
        ]);
    });

    Route::middleware(['user-role:counselor'])->prefix('counselor')->group(function () {
        Route::resource('clients', CounselorClientController::class)->names([
            'index' => 'counselor.clients.index',
            'create' => 'counselor.clients.create',
            'store' => 'counselor.clients.store',
            'show' => 'counselor.clients.show',
            'edit' => 'counselor.clients.edit',
            'update' => 'counselor.clients.update',
            'destroy' => 'counselor.clients.destroy',
        ]);
    });
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route::get('/home', 'HomeController@index')->name('home');

//Method1
// Route::get('/students', 'StudentController@index')->name('students.index');
// Route::get('/students/create', 'StudentController@create')->name('students.create');
// Route::post('/students', 'StudentController@store')->name('students.store');
// Route::get('/students/{student}', 'StudentController@show')->name('students.show');
// Route::get('/students/{student}/edit', 'StudentController@edit')->name('students.edit');
// Route::put('/students/{student}', 'StudentController@update')->name('students.update');
// Route::delete('/students/{student}', 'StudentController@destroy')->name('students.destroy');
// Route::resource('students', StudentController::class);
//Method2
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

Route::resource('timetables', TimetableController::class);
Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', UserController::class);
});
Route::group(['middleware' => 'auth'], function () {
    Route::resource('inspections', InspectionController::class);
});
Route::group(['middleware' => 'auth'], function () {
    Route::resource('reports', ReportController::class)->parameters([
        'reports' => 'inspection',
    ]);
});
Route::get('/reports/{id}/pdf', [ReportController::class, 'generatePDF'])->name('reports.pdf');

// Route::resource('/days', 'DayController');
Auth::routes();
// Route::post('/search-patient', 'PatientController@search')->name('searchPatient');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
