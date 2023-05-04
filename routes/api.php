<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\CommentController;


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

Route::apiResource('projects', ProjectController::class)
    ->except('store', 'update', 'destroy');
Route::get('/type/{type_id}/projects', [ProjectController::class, 'getProjecstByType']);

// Rotte per i commenti 
Route::get('project/{project_id}/comments', [CommentController::class, 'getCommenstByProject']);
Route::post('comments', [CommentController::class, 'store']);
