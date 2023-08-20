<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// StudentAPIController;
// use App\Http\Controllers\API\SubjectAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('students', StudentAPIController::class);
// Route::get('students', function($q){
//     return 'ggg';
// });
Route::get("grades",[App\Http\Controllers\API\StudentAPIController::class,'indexGrades']);
Route::post("grades",[App\Http\Controllers\API\StudentAPIController::class,'storeGrades']);
Route::get("grades/{id}",[App\Http\Controllers\API\StudentAPIController::class,'showStudentGrades']);


Route::resource('subjects', SubjectAPIController::class);


