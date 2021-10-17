<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// For Assessment
Route::post('assessment',                                           'App\Http\Controllers\AssessmentController@create');
Route::get('assessments',                                           'App\Http\Controllers\AssessmentController@index');
Route::get('assessment/{assessment}',                               'App\Http\Controllers\AssessmentController@showSingleAssessment');
Route::put('update/{assessment}',                                   'App\Http\Controllers\AssessmentController@update');
Route::delete('delete/{assessment}',                                'App\Http\Controllers\AssessmentController@destroy');


// For Question
Route::post('question',                                                 'App\Http\Controllers\QuestionController@create');



