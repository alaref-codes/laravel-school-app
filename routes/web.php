<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizationController;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

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


// Route::get('hello', function () {
//     return 'hiiii';
// });

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::resource('students', App\Http\Controllers\StudentController::class);
Route::get('students/{id}/grades', [App\Http\Controllers\StudentController::class,'studentGrades'])->name('students.studentGrades');
Route::post('students/studentGrades/{id}', [App\Http\Controllers\StudentController::class,'updateStudentGrades'])->name('students.updateStudentGrades');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('subjects', App\Http\Controllers\SubjectController::class);


Route::resource('studentSubjects', App\Http\Controllers\StudentSubjectController::class);



Route::get('index', 'App\Http\Controllers\LocalizationController@index');
Route::get('change/lang', 'App\Http\Controllers\LocalizationController@lang_change')->name('LangChange');


// Routes for mailing
Route::get('/email', function(){
    Mail::to("alarefabdo1@gmail.com")->send(new WelcomeMail());
    return new WelcomeMail();
});


